<?php
$disabled = $action == "admin_edit" ? "disabled" : "";
?>

<?= $this->element("page_header", array("title" => "Email Placeholder Manager")); ?>

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
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Name <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('name', array('placeholder' => 'Name')); ?>
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
