<?php
    $disabled = $action == "admin_view" ? "disabled" : "";
?>
<?php foreach($records as $i =>$record):
        $record = isset($record['TaskTemplateField']) ? $record['TaskTemplateField'] : $record['TaskFieldValue'];
    ?>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-4 col-xs-12"><?= $record["field_name"] ?> 
        <?= $record["is_mandatory"] ? "<span>*</span>" : ""; ?>
        :
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <?php 
            if (isset($records[$i]['TaskFieldValue']))
            {
                echo $this->Form->hidden("SubTask.$index.TaskFieldValue.$i.id", array("value" => $record["id"]));
            }
            echo $this->Form->hidden("SubTask.$index.TaskFieldValue.$i.field_name", array("value" => $record["field_name"]));
            echo $this->Form->hidden("SubTask.$index.TaskFieldValue.$i.field_type", array("value" => $record["field_type"]));
            echo $this->Form->hidden("SubTask.$index.TaskFieldValue.$i.field_options", array("value" => $record["field_options"]));
            echo $this->Form->hidden("SubTask.$index.TaskFieldValue.$i.is_mandatory", array("value" => $record["is_mandatory"]));;
            echo $this->Form->hidden("TaskFieldValue.$i.edit_by_assignee", array("value" => $record["edit_by_assignee"]));;
            
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
            
            $required = $record["is_mandatory"] ? "required" : "";
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
                $required = "";
                if ($value)
                {
                    $in_arr['checked'] = "true";
                }
                
                $value = "1";
            } 
            else if ($type == "select")
            {
                $in_arr['options'] = explode(",", $record['field_options']);
                $in_arr['empty'] = DROPDOWN_EMPTY_VALUE;
            }
            
            $input_disabled = "";
            if ($disabled)
            {
                $input_disabled = "disabled";
            }
            
            if (isset($task))
            {
                if ($task['assigner_user_id'] != $auth_user['id'])
                {
                    $input_disabled = "disabled";
                }
            }
            
            $in_arr[] = $required;
            $in_arr[] = $input_disabled;
            $in_arr['value'] = $value;
            
            echo $this->Form->input("SubTask.$index.TaskFieldValue.$i.value",$in_arr);
        ?>
    </div>
</div>

<?php endforeach; ?>

<script type="text/javascript">
$(document).ready(function()
{
    $(".date-picker").datepickerExtend();
});
</script>