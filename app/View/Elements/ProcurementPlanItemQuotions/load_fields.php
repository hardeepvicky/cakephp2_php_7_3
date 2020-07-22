<?php
    $disabled = $action == "admin_view" ? "disabled" : "";
?>
<?php foreach($records as $i => $record): ?>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-4 col-xs-12">
        <?= $record["ProcurementItemParam"]["name"] ?> 
        <span>*</span> :
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <?php 
            if ($record['ProcurementPlanItemQuotionParam'])
            {
                echo $this->Form->hidden("ProcurementPlanItemQuotionParam.$i.id", array("value" => $record['ProcurementPlanItemQuotionParam'][0]["id"]));
            }
            echo $this->Form->hidden("ProcurementPlanItemQuotionParam.$i.procurement_item_param_id", array("value" => $record["ProcurementItemParam"]["id"]));
            
            echo $this->Form->hidden("ProcurementItemParam.$i.id", array("value" => $record["ProcurementItemParam"]["id"]));
            echo $this->Form->hidden("ProcurementItemParam.$i.procurement_item_id", array("value" => $record["ProcurementItemParam"]["procurement_item_id"]));
            echo $this->Form->hidden("ProcurementItemParam.$i.name", array("value" => $record["ProcurementItemParam"]["name"]));
            echo $this->Form->hidden("ProcurementItemParam.$i.type", array("value" => $record["ProcurementItemParam"]["type"]));
            
            $type = $record["ProcurementItemParam"]["type"];
            $cls = "form-control";
            switch($type)
            {
                case "number":
                    $type = "text";
                    $cls = "form-control validate-float";
                    break;                
            }
            
            $value = $record['ProcurementPlanItemQuotionParam'] ? $record['ProcurementPlanItemQuotionParam'][0]['value'] : "";
            
            $in_arr = array(
                "type" => $type, 
                "class" => $cls, 
                "label" => false, 
                "div" => false, 
                "escape" => false,
                "required" => true,
                "value" => $value
            );
            
            echo $this->Form->input("ProcurementPlanItemQuotionParam.$i.value", $in_arr);
        ?>
    </div>
</div>

<?php endforeach; ?>