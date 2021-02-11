<?php
class CitiesController extends AppController
{
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow("getList");
    }
    
    public function admin_index()
    {
        //Converts querystring to named parameter
        $this->Redirect->urlToNamed();

        // Sets Search Parameters
        $conditions = $this->getSearchConditions(array(
            array('model' => $this->modelClass, 'field' => 'state_id', 'type' => 'int', 'view_field' => 'state_id'),
            array('model' => $this->modelClass, 'field' => 'name', 'type' => 'string', 'view_field' => 'name'),
        ));

        $records = $this->paginate($this->modelClass, $conditions);
        
        $this->set(compact('records'));
        
        $this->_setList();
        
        $this->afterIndex();
    }
    
    public function admin_add()
    {
        parent::add(['action' => 'admin_index']);
        
        $this->_setList();
        
        $this->render("admin_form");
    }
    
    public function admin_edit($id)
    {
        parent::edit($id, ['action' => 'admin_index']);
        
        $this->_setList();
        
        $this->render("admin_form");
    }
    
    public function admin_delete($id)
    {
        $this->delete($id, ["action" => "admin_index"]);
    }
    
    private function _setList()
    {
        $state_list = $this->{$this->modelClass}->State->getListCache();
        $this->set(compact("state_list"));
    }
    
    public function getList($state_id)
    {
        $records = $this->{$this->modelClass}->find('all', array(
            'fields' => array('id', 'name'),
            "conditions" => array(
                "state_id" => $state_id
            )
        ));
        
        if($records)
        {
            $records = Set::classicExtract($records, "{n}.City");
        }
        
        echo json_encode($records); exit;
    }
}