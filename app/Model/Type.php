<?php
class Type extends AppModel
{
    public $model_cache_config = "month", $model_cache_key = 'Type';
    public $modal_list_cache_fields = ["id", "name", "code", "name_code"];
    
    var $virtualFields = array(
        'name_code' => 'CONCAT(name, " (", code , ")")'
    );
    
    public $unique_fields = array("type", "code");
    public $non_update_fields = array("type", "code");
    
    public function __construct($id = false, $table = null, $ds = null) 
    {
        foreach(ProductAttrTypes::getFieldList() as $type => $field)
        {
            if ($type != ProductAttrTypes::COLOR)
            {
                $this->hasMany["Product" . $field] = array(
                    "className" => "Product",
                    "foreignKey" => $field
                );
            }
        }
        
        $this->hasMany["ManufactureOrderRatioColor"] = array(
            "className" => "ManufactureOrderRatioColor",
            "foreignKey" => "color_type_id"                
        );
        
        $this->hasMany["ManufactureOrderRatioSize"] = array(
            "className" => "ManufactureOrderRatioSize",
            "foreignKey" => "size_type_id"                
        );
        
        $this->hasMany["ManufactureOrderRatioBrand"] = array(
            "className" => "ManufactureOrderRatioBrand",
            "foreignKey" => "brand_type_id"                
        );
        
        $this->hasMany["ManufactureOrderExtraCut"] = array(
            "className" => "ManufactureOrderExtraCut",
            "foreignKey" => "size_type_id"                
        );
        
        parent::__construct($id, $table, $ds);
    }
    
    
    public $validate = array(
        'type' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'Type is required.'),
        ),
        'code' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'Code is required.'),
            'codeUnique' => array('rule' => array('codeUnique'), 'message' => 'Code already exist'),
        ),
        'name' => array(
            'notBlank' => array('rule' => array('notBlank'), 'message' => 'Name is required.'),
        ),
    );
    
    public function codeUnique()
    {
        $conditions = array(
            "type" => $this->data['Type']['type'],
            "code" => $this->data['Type']['code'],
        );
        
        if (isset($this->data['Type']['id']) && $this->data['Type']['id'])
        {
            $conditions["not"]['id'] = $this->data['Type']['id'];
        }
        
        $count = $this->find("count", array(
            "conditions" => $conditions,
        ));
        
        if ($count > 0)
        {
            return false;
        }
        
        return true;
    }
}
