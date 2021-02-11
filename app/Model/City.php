<?php
class City extends AppModel
{
    public $model_cache_config = "month", $model_cache_key = 'City';
    public $modal_list_cache_fields = array("id", "name", "state_id");
    
    public $belongsTo = array(
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'state_id'
        ),
    );
    
    public $hasMany = [
        'CustomerAddress' => [
            'className' => 'CustomerAddress',
            'foreignKey' => 'city_id'
        ],
        'Location' => [
            'className' => 'Location',
            'foreignKey' => 'city_id'
        ],
        'MeeshoOrder' => [
            'className' => 'MeeshoOrder',
            'foreignKey' => 'city_id'
        ],
        'Order' => [
            'className' => 'Order',
            'foreignKey' => 'city_id'
        ],
        'Pincode' => [
            'className' => 'Pincode',
            'foreignKey' => 'city_id'
        ],
    ];
    
    public $validate = array(
        'state_id' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'State is required.'),
        ),
        'name' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'City is required.'),
            'comboUnique' => array('rule' => 'comboUnique', 'uniqueWith' => ['state_id'], 'message' => "City already exist"),
        ),
    );
}
