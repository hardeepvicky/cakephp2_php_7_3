<?php
class EmailPlaceholdersController extends AppController
{
    public function admin_index()
    {
        //Converts querystring to named parameter
        $this->Redirect->urlToNamed();

        // Sets Search Parameters
        $conditions = $this->getSearchConditions(array(
            array('model' => $this->modelClass, 'field' => array('name'), 'type' => 'string', 'view_field' => 'name')
        ));

        $records = $this->paginate($this->modelClass, $conditions);
        
        //setting variables
        $this->set(compact('records'));
        
        $this->afterIndex();
    }

    public function admin_add()
    {
        parent::add(array("action" => "admin_index"));

        $this->render('admin_form');
    }

    public function admin_edit($id)
    {
        parent::edit($id, array("action" => "admin_index"));

        $this->render('admin_form');
    }

    public function admin_delete($id)
    {
        $this->delete($id, array("action" => "admin_index"));
    }
}