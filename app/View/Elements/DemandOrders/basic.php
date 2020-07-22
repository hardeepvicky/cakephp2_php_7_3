<?php
$disabled = $this->request->data[$model]["is_disable"] ? "disabled" : "";
?>

<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Location <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?=
            $this->Form->input('location_id', array(
                "type" => "select",
                "class" => "form-control select2me",
                "options" => $location_list,
                "empty" => DROPDOWN_EMPTY_VALUE
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Supplier <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?=
            $this->Form->input('supplier_legder_account_id', array(
                "type" => "select",
                "class" => "form-control select2me",
                "options" => $legder_account_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            ));
            ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Demand Order No. :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('demand_order_no', array("readOnly" => true)); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Comments :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('comments', array('placeholder' => 'Comments', 'type' => 'textarea', 'rows' => 2)); ?>
        </div>
    </div>
</div>

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue">Save & Next</button>
    </div>
</div>