<?php
App::uses('BaseController', 'Controller');

class AppController extends BaseController
{
    public $authUser, $accountGroups, $voucherTypes;
    //Includes global components array
    public $components = array("Acl", 'Auth', 'Session', 'Redirect');

    //Includes global helper array
    var $helpers = array('Html', 'Form',
        'AclLink' => array(
            'userModel' => 'Group', //overide default userModel "User"
            'primaryKey' => 'id' //overide default primaryKey "id"
          )
    );

    //Changes the view extension name from .ctp to .php
    public $ext = '.php';

    //Sets default pagination for all controllers
    public $paginate = array(
        'limit' => 20,
        'order' => array(
            'id' => 'DESC'
        )
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        
        if ( Configure::read("debug") == -1 || HALT_WEB)
        {
            if ($this->params['controller'] != "Dashboards" || $this->params['action'] != "maintence")
            {
                $this->redirect(array("controller" => 'Dashboards', 'action' => 'maintence', 'admin' => false));
            }
        }
        
        $model = $this->modelClass;
        $controller = Inflector::camelize($this->params['controller']);
        $action = $this->params['action'];
        
        $this->Auth->authorize = 'Actions';
        $this->Auth->actionPath = 'Controllers/';
        $this->Auth->authError = 'You are not allowed to visit that url.';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', "admin" => false);
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login', "admin" => false);
        $this->Auth->loginRedirect = array('controller' => 'companies', 'action' => 'index', "admin" => true);
        $is_ajax = $this->request->is("ajax") ? 1 : 0;
        $this->Auth->unauthorizedRedirect = array("controller" => "errors", "action" => "methodNotAllowed", $is_ajax, $controller, $action);

        $this->authUser = AppModel::$authUser = $auth_user = $this->Auth->user();
        
        if($this->authUser)
        {
            $this->load_model("User");            
            $this->User->id = $this->authUser["id"];
            $is_active = $this->User->field("is_active");
            
            if (!$is_active)
            {
                $this->Auth->logout();
                $this->Session->setFlash('User is deactivated.', 'flash_failure');
                $this->redirect(array("controller" => 'Users', 'action' => 'login', 'admin' => false));
            }
        }

        $this->set(compact('auth_user', 'model', 'controller', 'action'));

        if ($this->request->is("ajax"))
        {
            $this->layout = "ajax";
        }
        else
        {
            $title_for_layout = Inflector::humanize(str_replace("_", " " ,Inflector::tableize($controller))) . " | " . str_replace("Admin ", "" , Inflector::humanize($action));
            $this->set(compact('title_for_layout'));
        }

        $this->Auth->allow(array("clearSearchCache"));
    }
    
    public function afterIndex()
    {
        if ($this->request->is("ajax"))
        {
            $this->render("/Elements/" . ucfirst($this->params['controller']) . "/" . $this->params['action']);
        }
    }
    
    public function beforeRender() 
    {
        parent::beforeRender();
        
        if ($this->authUser && isset($this->authUser['group_id']) && !$this->request->is("ajax") && $this->layout != "ajax")
        {
            $menus = Cache::read("menus_" . $this->authUser['group_id'], 'acl_config');
            
            if (!$menus)
            {
                $menus = Menu::get(Menu::$default, $this->Acl, $this->authUser['group_id']);
                Cache::write("menus_" . $this->authUser['group_id'], $menus, 'acl_config');
            }

            $home_link = Menu::getDefaultLink($menus);
            
            $breadcum = Menu::getBreadcum($menus, $this->params['controller'], $this->params['action']);
            
            $notifications = $this->_getNotifications($this->authUser['id']);
            
            $total_count = $this->Notification->find("count", array("conditions" => array("to_user_id" => $this->authUser['id'], "will_shown" => 1)));
        
            $notification_total_pages = ceil($total_count/20);
            
            $notification_unseen_count = $this->Notification->find("count", array(
                "conditions" => array("is_seen" => 0, "will_shown" => 1, "to_user_id" => $this->authUser['id'])
            ));

            $this->set(compact("home_link", "menus", "breadcum", "notifications", "notification_total_pages", "notification_unseen_count"));
        }
    }

    /**
     *  Common add record action
     */
    protected function add($redirect = array())
    {
        //Checks if request is post
        if ($this->request->is('post'))
        {
            $this->{$this->modelClass}->create();
            //Saves the record
            if ($this->{$this->modelClass}->save($this->request->data))
            {
                if ($redirect)
                {
                    $this->Session->setFlash('Record has been saved.', 'flash_success');
                    $this->redirect($redirect);
                }
                else
                {
                    return true;
                }
            }
            else if ($redirect) //Save error
            {
                $this->Session->setFlash('Unable to add new record', 'flash_failure');
            }
        }
        return false;
    }

    /**
     *  Common edit record action
     */
    protected function edit($id, $redirect = array())
    {
        //Checks if no ID is passed to the action
        if (!$id)
        {
            throw new NotFoundException(__('Missing id '));
        }

        //Gets record from database
        $record = $this->{$this->modelClass}->findById($id);

        //Checks if no record exists in the database
        if (!$record)
        {
            throw new NotFoundException(__('Invalid ' . $this->modelClass));
        }

        //Checks if request is POST or PUT
        if ($this->request->is('post') || $this->request->is('put'))
        {
            //Points the model to specific record
            $this->{$this->modelClass}->id = $id;

            //Save the record
            if ($this->{$this->modelClass}->save($this->request->data))
            {
                if($redirect)
                {
                    $this->Session->setFlash('Record has been updated.', 'flash_success');
                    $this->redirect($redirect);
                }
                else
                {
                    return true;
                }
            }
            else if ($redirect)  //Save error
            {
                $this->Session->setFlash('Unable to update the record', 'flash_failure');
            }
        }

        //Handles GET request
        if (!$this->request->data)
        {
            $this->request->data = $record;
        }

        return false;
    }
    
    /**
     *  Common edit record action
     */
    protected function copy($id, $redirect = array())
    {
        //Checks if no ID is passed to the action
        if (!$id)
        {
            throw new NotFoundException(__('Invalid ' . $this->modelClass));
        }

        //Gets record from database
        $record = $this->{$this->modelClass}->findById($id);

        //Checks if no record exists in the database
        if (!$record)
        {
            throw new NotFoundException(__('Invalid ' . $this->modelClass));
        }

        //Checks if request is POST or PUT
        if ($this->request->is('post') || $this->request->is('put'))
        {
            unset($this->request->data[$this->modelClass]['id']);
            
            //Points the model to specific record
            $this->{$this->modelClass}->create();

            //Save the record
            if ($this->{$this->modelClass}->save($this->request->data))
            {
                if($redirect)
                {
                    $this->Session->setFlash('Record has been saved.', 'flash_success');
                    $this->redirect($redirect);
                }
                else
                {
                    return true;
                }
            }
            else  //Save error
            {
                $this->Session->setFlash('Unable to save the record ', 'flash_failure');
            }
        }

        //Handles GET request
        if (!$this->request->data)
        {
            $this->request->data = $record;
        }

        return false;
    }

    /*
     * Common action for delete record
     */
    protected function delete($id, $redirect = array())
    {
        //Checks if no ID is passed to the action
        if (!$id)
        {
            throw new NotFoundException(__('Invalid ' . $this->modelClass));
        }

        $this->{$this->modelClass}->recursive = -1;
        $record = $this->{$this->modelClass}->find("first", array(
            "fields" => "id",
            "conditions" => array("id" => $id),
            "recursive" => -1,
            "contain" => array()
        ));
        
        //Checks if no ID is passed to the action
        if (!$record)
        {
            throw new NotFoundException(__('Invalid ' . $this->modelClass));
        }

        //Points model to specific record
        $this->{$this->modelClass}->id = $id;

        $result = true;
        //Checks if record can be deleted or it has not associated data
        if (!$this->{$this->modelClass}->preventDeleteAndInactive($id))
        {
            $result = false;
        }
        
        if ($result)
        {
            $this->{$this->modelClass}->id = $id;

            if ($this->{$this->modelClass}->hasField('is_deleted'))
            {
                $result = $this->{$this->modelClass}->softDelete();
            }
            else
            {
                $result = $this->{$this->modelClass}->delete($id);
            }
        }
        
        if ($result)
        {
            if($redirect)
            {
                $this->Session->setFlash('The record deleted Successfully', 'flash_success');
                $this->redirect($redirect);
            }
            else
            {
                return true;
            }
        }
        else //Error otherwise
        {
            if($redirect)
            {
                $this->Session->setFlash('The record cannot be deleted, as it has associated data', 'flash_failure');
                $this->redirect($redirect);
            }
            else
            {
                return false;
            }
        }

        return false;
    }

    protected function getSearchConditions($inputs, $cache = true)
    {
        $conditions = $searchArray = array();
        $search_key = "search-" . $this->params['controller'] . "-" . $this->params['action'] . "-" . $this->authUser['id'];
        $old_params = Cache::read($search_key, "month");        
        $params = $this->params['named'];
        
        //Looping the input data
        foreach ($inputs as $i => $input)
        {
            //Setting value in local variables
            $model = isset($input['model']) ? $input['model'] : "";
            $fields = $input['field'];
            $type = strtolower($input['type']);
            $view_field = $input['view_field'];
            
            if ($cache && !empty($old_params) && empty($this->params['named']) && isset($old_params[$view_field]))
            {
                $params[$view_field] = $old_params[$view_field];
            }
            
            //Checking data type and constructing conditions array
            if (isset($params[$view_field]) && 
                    (
                        (is_array($params[$view_field]) && $params[$view_field])
                        || (!is_array($params[$view_field]) && strlen(trim($params[$view_field])) > 0)
                    )
                )
            {
                
                if (is_array($params[$view_field]))
                {
                    if ($type == 'string' || $type == 'string_exact')
                    {
                        foreach($params[$view_field] as $k => $v)
                        {
                            if (substr($v, 0, 1) != "'")
                            {
                                $params[$view_field][$k] = json_encode($v);
                            }
                        }
                        
                        //change type
                        $type = "int";
                    }
                }
                else
                {
                    $params[$view_field] = trim($params[$view_field]);
                }

                if (is_array($fields))
                {
                    foreach($fields as $field)
                    {
                        $model_field = $field;
                        if ($model)
                        {
                            $model_field = $model . "." . $field;
                        }
                        
                        if ($type == 'string')
                        {
                            $conditions[$i]["OR"][$model_field . " LIKE"] = "%" . $params[$view_field] . "%";
                        }
                        else if ($type == 'string_exact')
                        {
                            $conditions[$model_field] = "'" . $params[$view_field] . "'";
                        }
                        else if ($type == 'integer' || $type == 'int')
                        {
                            $conditions[$i]["OR"][$model_field] = $params[$view_field];
                        }
                        else if ($type == 'from_integer' || $type == 'from_int')
                        {
                            $conditions[$i]["OR"][$model_field . " >="] = $params[$view_field];
                        }
                        else if ($type == 'to_integer' || $type == 'to_int')
                        {
                            $conditions[$i]["OR"][$model_field . " <="] = $params[$view_field];
                        }
                        else if (($type == 'boolean' || $type == 'bool') && $params[$view_field])
                        {
                            $conditions[$i]["OR"][$model_field] = 1;
                        }
                        else if ($type == 'date')
                        {
                            $conditions[$i]["OR"]["$model_field"] = DateUtility::getDate($params[$view_field], DateUtility::DATE_FORMAT);
                        }
                        else if ($type == 'from_date')
                        {
                            $conditions[$i]["OR"]["date($model_field) >="] = DateUtility::getDate($params[$view_field], DateUtility::DATE_FORMAT);
                        }
                        else if ($type == 'to_date')
                        {
                            $conditions[$i]["OR"]["date($model_field) <="] = DateUtility::getDate($params[$view_field], DateUtility::DATE_FORMAT);
                        }
                        else if ($type == 'from_datetime')
                        {
                            $conditions[$i]["OR"]["$model_field >="] = DateUtility::getDate($params[$view_field]);
                        }
                        else if ($type == 'to_datetime')
                        {
                            $conditions[$i]["OR"]["$model_field <="] = DateUtility::getDate($params[$view_field]);
                        }
                        else if ($type == 'find_in_set')
                        {
                            $conditions[$i]["OR"][] = "FIND_IN_SET(" . $params[$view_field] . ", $model_field)";
                        }
                    }
                }
                else
                {
                    $field = $fields;
                    $model_field = $field;
                    if ($model)
                    {
                        $model_field = $model . "." . $field;
                    }
                    
                    if ($type == 'string')
                    {
                        $conditions[$model_field . " LIKE"] = "%" . $params[$view_field] . "%";
                    }
                    else if ($type == 'string_exact')
                    {
                        $conditions[$model_field] = "'" . $params[$view_field] . "'";
                    }
                    else if ($type == 'integer' || $type == 'int')
                    {
                        $conditions[$model_field] = $params[$view_field];
                    }
                    else if ($type == 'from_integer' || $type == 'from_int')
                    {
                        $conditions[$model_field . " >="] = $params[$view_field];
                    }
                    else if ($type == 'to_integer' || $type == 'to_int')
                    {
                        $conditions[$model_field . " <="] = $params[$view_field];
                    }
                    else if (($type == 'boolean' || $type == 'bool') && $params[$view_field])
                    {
                        $conditions[$model_field] = 1;
                    }
                    else if ($type == 'date')
                    {
                        $conditions["$model_field"] = DateUtility::getDate($params[$view_field], DateUtility::DATE_FORMAT);
                    }
                    else if ($type == 'from_date')
                    {
                        $conditions["date($model_field) >="] = DateUtility::getDate($params[$view_field], DateUtility::DATE_FORMAT);
                    }
                    else if ($type == 'to_date')
                    {
                        $conditions["date($model_field) <="] = DateUtility::getDate($params[$view_field], DateUtility::DATE_FORMAT);
                    }
                    else if ($type == 'from_datetime')
                    {
                        $conditions["$model_field >="] = DateUtility::getDate($params[$view_field]);
                    }
                    else if ($type == 'to_datetime')
                    {
                        $conditions["$model_field <="] = DateUtility::getDate($params[$view_field]);
                    }
                    else if ($type == 'find_in_set')
                    {
                        $conditions[] = "FIND_IN_SET(" . $params[$view_field] . ", $model_field)";
                    }
                }

                if (is_array($params[$view_field]))
                {
                    $params[$view_field] = implode(",", $params[$view_field]);
                }
                
                $searchArray[$model . $view_field] = $params[$view_field];
            }
            else
            {
                $searchArray[$model . $view_field] = "";
            }
        }
        
        if ($cache && $params)
        {
            Cache::write($search_key, $params, "month");
        }
        
        $this->set($searchArray);
        $this->set("search", $params);
        
        return $conditions;
    }
    
    public function clearSearchCache($action)
    {
        $actions = explode(",", $action);
        
        foreach($actions as $action)
        {
            $search_key = "search-" . $this->params['controller'] . "-$action-" . $this->authUser['id'];
            Cache::delete($search_key, "month");
        }
        
        $action = $actions[0];
        $is_admin = strpos($action, "admin_") !== false ? true : false;
        $action = str_replace("admin_", "", $action);
        $this->redirect(array("action" => $action, "admin" => $is_admin));
    }
}
