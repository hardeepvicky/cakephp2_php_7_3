<?php
class UsersController extends AppController
{
    public function beforeFilter()
    {
        if (!in_array($this->params['action'], array('logout', "acl", "forgot_password")))
        {
            parent::beforeFilter();
        }

        $this->Auth->allow('login', 'logout', "acl", 'initDB', "forgot_password"); 
    }

    public function admin_index()
    {
        //Converts querystring to named parameter
        $this->Redirect->urlToNamed();

        // Sets Search Parameters
        $conditions = $this->getSearchConditions(array(
            array('model' => $this->modelClass, 'field' => "group_id", 'type' => 'integer', 'view_field' => 'group_id'),            
            array('model' => $this->modelClass, 'field' => array('username', "firstname", "lastname", "email"), 'type' => 'string', 'view_field' => 'username')
        ));
        
        $records = $this->paginate($this->modelClass, $conditions);
        
        $this->_setList();
        
        //setting variables
        $this->set(compact('records'));
        
        $this->afterIndex();
    }

    public function admin_add()
    {
        parent::add(["action" => "admin_index"]);
        
        $this->_setList();

        $this->render('admin_form');
    }
    
    public function admin_edit($id)
    {
        parent::edit($id, ["action" => "admin_index"]);
        
        $this->_setList();

        $this->render('admin_form');
    }
    
    public function ajaxToggleStatus($id)
    {
        if (!isset($this->request->data["is_active"]))
        {
            die("missing is_active field in post");
        }
        
        $is = (int) $this->request->data["is_active"];
        $is = (int) !$is;
        $this->{$this->modelClass}->id = $id;
        $this->{$this->modelClass}->saveField("is_active", $is);
        
        $response["status"] = 1;
        $response["is_active"] = $is;
        
        echo json_encode($response); exit;
    }
    
    public function login()
    {
        //debug($_SESSION); debug($_COOKIE); debug($this->authUser); exit;
        $this->layout = 'login';

        if ($this->request->is('post'))
        {
            if ($this->Auth->login())
            {
                $this->authUser = AppModel::$authUser = $this->Auth->user();
                
                if(!$this->authUser["is_active"])
                {
                    $this->authUser = array();
                    $this->Auth->logout();
                    $this->Session->setFlash('User is deactivated.', 'flash_failure');
                }
            }
            else
            {
                $this->Session->setFlash('Username or password was incorrect.', 'flash_failure');
            }
        }

        if ($this->authUser)
        {
            require_once(APP . "Config/Menu.php");
            $menus = Menu::get(Menu::$default, $this->Acl, $this->authUser['group_id']);
            
            $home_link = Menu::getDefaultLink($menus);
            
            $this->redirect($home_link);
        }
    }
    
    public function logout()
    {
        $this->redirect($this->Auth->logout());
    }

    public function admin_change_password()
    {
        if (!empty($this->request->data))
        {
            $cansave = true;
            $this->User->recursive = -1;
            $user = $this->User->findById($this->authUser["id"], array("fields" => "password"));

            if (!$user)
            {
                $this->User->validationErrors['username'] = 'Username not found';
                $cansave = false;
            }
            else if ($user['User']['password'] != $this->Auth->password($this->request->data['User']['old_password']))
            {
                $this->User->validationErrors['old_password'] = 'Password is incorrect';
                $cansave = false;
            }

            if ($this->request->data['User']['password'] != $this->request->data['User']['confirm_password'])
            {
                $this->User->validationErrors['confirm_password'] = "Password didn't match";
                $cansave = false;
            }

            if ($cansave)
            {
                $this->User->id = $this->authUser["id"];
                if ($this->User->save(array('password' => $this->request->data['User']['password'])))
                {
                    $this->Session->setFlash('Password changed successfully', "flash_success");
                    $this->redirect($this->referer());
                }
                else
                {
                    $this->Session->setFlash("Password could not be changed", "flash_failure");
                }
            }
        }
    }

    public function forgot_password()
    {
        $this->layout = "login";
        
        $from_email = AppModel::initSettingModel()->getValueFromName("admin_email");
        
        if (!$from_email)
        {
            //die("Setting : admin_email is not set yet");
        }
        
        if ($this->request->is('post'))
        {
            $user = $this->User->find('first', array(
                'conditions' => array(
                    "OR" => array(
                        'User.username' => $this->request->data["User"]['username'],
                    )
                ),
                "recursive" => -1
            ));

            if (empty($user))
            {
                $this->Session->setFlash('Invalid Username', 'flash_failure');
            }
            else if (empty($user["User"]["email"]))
            {
                $this->Session->setFlash('User does not have email address', 'flash_failure');
            }
            else
            {
                $status = $this->User->forgotPassword($user['User']['id']);

                if ($status)
                {
                    $this->Session->setFlash('Email has been sent successfully.', 'flash_success');
                }
                else
                {
                    $this->Session->setFlash('Failed to send Email.', 'flash_failure');
                }
            }

            $this->redirect($this->referer());
        }
    }

    private function _setList()
    {
        $group_list = $this->User->Group->findCacheList("id", "name", ["name ASC"]);
        
        $this->set(compact("group_list"));
    }
    
    public function admin_permissions()
    {
        if ($this->request->is(array("post", "put")))
        {
            set_time_limit(300);
            error_reporting(0);
            $path = APP . "tmp/cache/Acl/";
            FileUtility::deleteAll($path);
            error_reporting(E_ALL);
            
            $this->load_model('Aro');
            $aro = $this->Aro->find("first", array(
                "conditions" => array(
                    "model" => "Group",
                    "foreign_key" => $this->request->data["User"]["group_id"]
                )
            ));

            if (!$aro)
            {
                die("Aro related to group id $group_id not found");
            }
            
            $this->User->query("DELETE FROM aros_acos WHERE aro_id = " . $aro["Aro"]["id"]);

            $group = $this->User->Group;

            $group->id = $this->request->data["User"]["group_id"];
            $this->Acl->deny($group, 'controllers');

            if ($group->id == GroupType::ADMIN)
            {
                $this->Acl->allow($group, 'controllers/Users/admin_permissions');
                $this->Acl->allow($group, 'controllers/Groups');
            }

            $this->Acl->allow($group, 'controllers/Users/admin_change_password');

            foreach($this->request->data["Permissions"] as $aco => $v)
            {
                $this->Acl->allow($group, $aco);
            }
            
            $this->Session->setFlash('Permissions has been saved.', 'flash_success');
            $this->request->data = array();
        }
        
        $group_list = $this->User->Group->find("list", array("fields" => array("id", "name"), "order" => "name ASC"));
        $this->set(compact('group_list'));
    }
    
    public function ajaxGetPermissions($group_id)
    {
        $this->load_model("Aco");
        $this->Aco->recursive = -1;       
        $temp = $this->Aco->find("all");
        
        $acos = array();
        foreach($temp as $record)
        {
            if (is_null($record['Aco']['parent_id']))
            {
                $record['Aco']['parent_id'] = 0;
            }
            
            $acos[$record['Aco']['id']] = $record['Aco'];
        }
        
        $tree = Util::getTreeArray($acos, "parent_id", 0);
        
        $aco_list = Util::getTreeListArray($tree, "id", "alias", false, true, "", "/");        
        
        //debug($aco_list); exit;
        
        $this->load_model('Aro');
        $aro = $this->Aro->find("first", array(
            "conditions" => array(
                "model" => "Group",
                "foreign_key" => $group_id
            )
        ));
        
        if (!$aro)
        {
            die("Aro related to group id $group_id not found");
        }
        
        $this->load_model('ArosAco');
        $temp = $this->ArosAco->find("all", array(
            "conditions" => array(
                "aro_id" => $aro["Aro"]["id"]
            )
        ));
        
        $aro_acos_list = array();
        
        foreach($temp as $record)
        {
            if ($record['ArosAco']['_create'] == 1 && isset($aco_list[$record['ArosAco']['aco_id']]))
            {
                $aro_acos_list[] = $aco_list[$record['ArosAco']['aco_id']];
            }
        }
        
        $sections = array();
        
        $sections['Dashboard'] = array(
            'dashboard' => 'controllers/Dashboards/admin_index',
        );
        
        $sections['User'] = array(
            'Summary' => 'controllers/Users/admin_index',
            'Add' => 'controllers/Users/admin_add',
            'Edit' => 'controllers/Users/admin_edit',
            'Toggle Active' => 'controllers/Users/ajaxToggleStatus',
        );
        
        $this->set(compact("sections", "aro_acos_list"));
    }
    
    public function aclExtras()
    {
        $this->autoRender = false;

        echo 'Acl Extras : ';

        App::uses('ShellDispatcher', 'Console');
        $command = '-app '.APP.' AclExtras.AclExtras aco_sync';
        $args = explode(' ', $command);
        $dispatcher = new ShellDispatcher($args, false);

        if($dispatcher->dispatch())
        {
            echo 'done';
        }
        else
        {
            echo 'Error';
        }
    }

    public function aclClearCache()
    {
        Cache::clear(false, "acl_config");
        echo "ACL Clear Cache Run Successfully. </br>";
    }

    public function acl()
    {
        $this->autoRender = false;

        $this->aclExtras();

        echo "<br/>";

        $this->aclClearCache();

        exit;
    }
}