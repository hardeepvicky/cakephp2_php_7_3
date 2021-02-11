<?php
class EmailTemplate extends AppModel
{
    public $sanitize = false;
    public $model_cache_config = "month", $model_cache_key = 'EmailTemplate';
    
    public $hasMany = array(
        'EmailTemplatePlaceholder' => array(
            'className' => 'EmailTemplatePlaceholder',
            'foreignKey' => 'email_template_id'
        ),
    );
    
    public $validate = array(
        'code' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'Code is required.'),
            'isUnique' => array('rule' => 'isUnique', 'message' => "Code alredy exist"),
        ),
        'subject' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'Subject is required.'),
        ),
        'body' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'Body is required.'),
        ),
    );
}
