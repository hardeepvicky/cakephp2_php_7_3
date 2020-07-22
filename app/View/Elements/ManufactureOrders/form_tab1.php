<?php $disabled = in_array($action, array("admin_add")) ? "" : "disabled" ?>
<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Location <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('location_id', array(
                "type" => "select",
                "class" => "form-control select2me", 
                "options" => $location_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            )); ?>
        </div>                
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Product Cluster <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('product_group_id', array(
                "type" => "select",
                "class" => "form-control select2me", 
                "options" => $product_group_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            )); ?>
        </div>                
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">No. Of Mains <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('no_of_mains', array("class" => "form-control validate-int validate-more-than", "data-more-than-from" => 0, "data-more-than-msg" => "Should be more than 0")); ?>
        </div>
    </div>
</div>
<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" href="javascript:;" class="btn blue">Submit</button>
        <button type="submit" href="javascript:;" class="btn blue" name="next" value="1" style="max-width: 150px;">Save & Next</button>
        <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
    </div>
</div>
