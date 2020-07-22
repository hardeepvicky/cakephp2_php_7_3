<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
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
                "type" => "text"
            )
        ));
    ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">File <span>*</span> :</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <?= $this->Form->input("file", array("type" => "file")); ?>
                </div>
                <div class="col-md-3">
                    <a href="/<?= $sample ?>" download>Download Sample</a>
                </div>
            </div>
        </div>
        <div class="action-buttons">
            <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
                <button type="submit" href="javascript:;" class="btn blue">Submit</button>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>

<?php if (isset($errors)): ?>
<h3 class="section">
    Errors
    <?php if (isset($import_log_id)): ?>
        <a class="btn btn-default" href="<?= $this->Html->url(array("controller" => "Logs", "action" => "admin_download_import_error_log", $import_log_id)) ?>">Download Error Log</a>
    <?php endif; ?>
</h3>

<ol>
    <?php foreach($errors as $error): ?>
        <li>
            <span class="error-message"><?= $error ?></span>
        </li>
    <?php endforeach; ?>
</ol>
<?php endif; ?>