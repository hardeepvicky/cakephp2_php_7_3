<?php

$title_for_layout = isset($title_for_layout) ? $title_for_layout : (ucfirst($model) . " Manager");

$disabled = $action == "admin_edit" ? "disabled" : "";

$action_title = $action == "admin_add" ? "Add Department" : "Edit Department";
?>

<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum", array("model" => $title_for_layout, "action" => $action_title)); ?>
        </div>
        <div class="col-md-3 pull-right" style="text-align: right; margin-top: 4px;">
            <a href="<?= $this->Html->url(array("action" => "admin_index")); ?>" class="btn btn-circle blue-madison">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>
    </div>
</div>

<?= $this->element("page_header", array("title" => $title_for_layout)); ?>

<?php echo $this->Session->flash(); ?>

<div class="form__structure">
    <?php
        echo $this->Form->create($model, array(
            'type' => 'file',
            "class" => "form-horizontal form-row-seperated",
            'inputDefaults' => array(
                'label' => false, 'div' => false, 'div' => false, "escape" => false,
                "class" => "form-control invalid-sql-char", "type" => "text"
            )
        ));

        echo $this->Form->hidden('id');
    ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Shift Name <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('name', array('placeholder' => 'Shift Name')); ?>
                </div>
            </div>
        
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">From Time <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('from_time', array('placeholder' => 'From Time', "class" => "form-control time-picker")); ?>
                </div>
            </div>
        
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">To Time <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('to_time', array('placeholder' => 'To Time', "class" => "form-control time-picker")); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Days :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="mt-checkbox-list">
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('sunday', array('type' => 'checkbox')); ?> Sunday
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('monday', array('type' => 'checkbox')); ?> Monday
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('tuesday', array('type' => 'checkbox')); ?> Tuesday
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('wednesday', array('type' => 'checkbox')); ?> Wednesday
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('thursday', array('type' => 'checkbox')); ?> Thursday
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('friday', array('type' => 'checkbox')); ?> Friday
                            <span></span>
                        </label>
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('saturday', array('type' => 'checkbox')); ?> Saturday
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
                <button type="submit" href="javascript:;" class="btn blue">Submit</button>
                <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>
