<?php
class State extends AppModel
{
    public $model_cache_config = "month", $model_cache_key = 'State';
    public $modal_list_cache_fields = array("id", "name", "country_id");
    
    public $hasMany = array(
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'state_id'
        ),
    );
    
    public $validate = array(
        'name' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'State is required.'),
            'isUnique' => array('rule' => 'isUnique', 'message' => "State alredy exist"),
        ),
    );
    
    public function isDiffrentState($state_id)
    {
        $state = $this->find("first", [
            "conditions" => [
                "name" => "punjab"
            ]
        ]);
        
        if (!$state)
        {
            throw new Exception("Punjab state not found");
        }
        
        if ($state["State"]["id"] == $state_id)
        {
            return false;
        }
        
        return true;
    }
}
