<?php
class EmailPlaceholder extends AppModel
{
    public $model_cache_config = "month", $model_cache_key = 'EmailPlaceholder';
    
    public $hasMany = array(
        'EmailTemplatePlaceholder' => array(
            'className' => 'EmailTemplatePlaceholder',
            'foreignKey' => 'email_placeholder_id'
        ),
    );
    
    public $validate = array(
        'name' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'Code is required.'),
            'isUnique' => array('rule' => 'isUnique', 'message' => "Code alredy exist"),
        ),        
    );
}
