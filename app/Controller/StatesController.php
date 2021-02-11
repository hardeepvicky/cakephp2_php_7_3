<?php
class StatesController extends AppController
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
}
