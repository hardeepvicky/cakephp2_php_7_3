<?php
    foreach($records as $i => $record):
        $record = isset($record['TaskTemplateField']) ? $record['TaskTemplateField'] : $record['TaskFieldValue'];
        if (!$record['edit_by_assignee']):
    ?>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-4 col-xs-12"><?= $record["field_name"] ?> 
        <?= $record["is_mandatory"] ? "<span>*</span>" : ""; ?>
        :
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <?php 
            echo $this->Form->hidden("TaskFieldValue.$i.field_name", array("value" => $record["field_name"]));
            echo $this->Form->hidden("TaskFieldValue.$i.field_type", array("value" => $record["field_type"]));
            echo $this->Form->hidden("TaskFieldValue.$i.field_options", array("value" => $record["field_options"]));
            echo $this->Form->hidden("TaskFieldValue.$i.is_mandatory", array("value" => $record["is_mandatory"]));;
            echo $this->Form->hidden("TaskFieldValue.$i.edit_by_assignee", array("value" => $record["edit_by_assignee"]));
            
            $type = $record["field_type"];
            $cls = "form-control";
            switch($type)
            {
                case "date":
                    $type = "text";
                    $cls = "form-control date-picker";
                    break;
                
                case "checkbox":
                    $cls = "checkbox";
                    break;
            }
            
            $required = $record["is_mandatory"];
            $value = isset($record['value']) ? $record['value'] : "";
            
            $in_arr = array(
                "type" => $type, 
                "class" => $cls, 
                "label" => false, 
                "div" => false, 
                "escape" => false,
            );
            
            $checked = "";
            if ($type == "checkbox")
            {
                $required = false;
                if ($value)
                {
                    $in_arr['checked'] = "true";
                }
                
                $value = "1";
            } 
            else if ($type == "select")
            {
                $temp = explode(",", $record['field_options']);
                
                foreach($temp as $k => $v)
                {
                    $in_arr['options'][$v] = $v;  
                }
                
                $in_arr['empty'] = DROPDOWN_EMPTY_VALUE;
            }
            
            $input_disabled = false;
            if (isset($task))
            {
                if ($task['assigner_user_id'] != $auth_user['id'])
                {
                    $input_disabled = true;
                }
            }
            
            $in_arr["required"] = $required;
            $in_arr["disabled"] = $input_disabled;
            $in_arr['value'] = $value;
            
            echo $this->Form->input("TaskFieldValue.$i.value", $in_arr);
        ?>
    </div>
</div>

<?php endif; endforeach; ?>

<script type="text/javascript">
$(document).ready(function()
{
    $(".date-picker").datepickerExtend();
});
</script>