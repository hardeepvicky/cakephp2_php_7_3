<?php
class EmailTemplatesController extends AppController
{
    public function admin_index()
    {
        //Converts querystring to named parameter
        $this->Redirect->urlToNamed();

        // Sets Search Parameters
        $conditions = $this->getSearchConditions(array(
            array('model' => $this->modelClass, 'field' => 'code', 'type' => 'integer', 'view_field' => 'code')
        ));

        $records = $this->paginate($this->modelClass, $conditions);
        
        $this->_setList();

        //setting variables
        $this->set(compact('records'));
        
        $this->afterIndex();
    }

    public function admin_add()
    {
        $saved = parent::add(false);
        
        if ($saved)
        {
            foreach($this->request->data["EmailTemplatePlaceholder"]["email_placeholder_id"] as $email_placeholder_id)
            {
                $this->{$this->modelClass}->EmailTemplatePlaceholder->create();
                $this->{$this->modelClass}->EmailTemplatePlaceholder->save(array(
                    "email_template_id" => $this->{$this->modelClass}->id,
                    "email_placeholder_id" => $email_placeholder_id
                ));
            }
            
            $this->Session->setFlash('Emial Template has been saved.', 'flash_success');
            $this->redirect(array("action" => "admin_index"));
        }

        $this->_setList();
        
        $this->render('admin_form');
    }

    public function admin_edit($id)
    {
        parent::edit($id, array("action" => "admin_index"));
        
        $q = "
            SELECT
                EP.name,
                ETP.email_placeholder_id
            FROM
                email_template_placeholders ETP
                INNER JOIN email_placeholders EP ON EP.id = ETP.email_placeholder_id AND ETP.email_template_id = $id            
            ";
        
        $temp = $this->{$this->modelClass}->query($q);
        
        $email_placeholder_list = Set::classicExtract($temp, "{n}.EP.name");
        
        $this->request->data["EmailTemplatePlaceholder"]["email_placeholder_id"] = Set::classicExtract($temp, "{n}.ETP.email_placeholder_id");
        
        $this->_setList();
        
        $this->set(compact("email_placeholder_list"));
        
        $this->render('admin_form');
    }

    public function admin_delete($id)
    {
        $this->delete($id, array("action" => "admin_index"));
    }
    
    private function _setList()
    {
        $this->load_model("EmailPlaceholder");
        $placeholder_list = $this->EmailPlaceholder->getListCache();
        $this->set(compact("placeholder_list"));
    }
}