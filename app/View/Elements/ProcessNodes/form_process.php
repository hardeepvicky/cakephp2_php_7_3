<?php $disabled = in_array($action, array("admin_add")) ? "" : "disabled" ?>
<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Name <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('name'); ?>
        </div>                
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Type<span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('type', array(
                'id' => 'type',
                "type" => "select",
                "class" => "form-control select2me", 
                "options" => StaticArray::$process_types,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            )); ?>
        </div>                
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Process State <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('process_state_id', array(
                'id' => 'type',
                "type" => "select",
                "class" => "form-control select2me", 
                "options" => $process_state_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
            )); ?>
        </div>                
    </div>

    <div class="form-group category">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Category <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input("category_id", array(
                "type" => "select",
                "class" => "form-control select2me",
                "options" => $category_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            )); ?>
        </div>
    </div>
    
    <div class="form-group product">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Product <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input("product_id", array(
                "type" => "select",
                "class" => "form-control select2me",
                "options" => $sku_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            )); ?>
        </div>
    </div>
</div>
<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" href="javascript:;" class="btn blue">Submit</button>
        <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#type").change(function()
        {
            var v = $(this).val();
            
            $(".category select").removeAttr("required").attr("disabled", true);
            $(".category").hide();
            
            $(".product select").removeAttr("required").attr("disabled", true);
            $(".product").hide();
            
            if (v == "1")
            {
                $(".category select").removeAttr("disabled").attr("required", true);
                $(".category").show();
            }
            else if (v == "2")
            {
                $(".product select").removeAttr("disabled").attr("required", true);
                $(".product").show();
            }
        });
        
        $("#type").trigger("change");
    })
</script>
