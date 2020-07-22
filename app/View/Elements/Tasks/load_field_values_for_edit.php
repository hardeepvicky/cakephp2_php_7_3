<?php foreach($records as $i => $record):
        if ($record['edit_by_assignee']):
    ?>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-4 col-xs-12"><?= $record["field_name"] ?> 
        <?= $record["is_mandatory"] ? "<span>*</span>" : ""; ?>
        :
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <?php 
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
                $temp = explode(",", $record['field_options']);
                
                foreach($temp as $k => $v)
                {
                    $in_arr['options'][$v] = $v;  
                }
                
                $in_arr['empty'] = DROPDOWN_EMPTY_VALUE;
            }
            
            $input_disabled = "";
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
            
            echo $this->Form->hidden("TaskFieldValue.$i.id");
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