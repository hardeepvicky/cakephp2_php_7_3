<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
        </div>        
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h3> Api Import Log Tree </h3>
    </div>
    <div class="col-md-6 text-right" style="margin-top: 6px;">
        <a class="btn blue" href="<?= $this->Html->url(array("action" => "api_imports", "admin" => true)) ?>">Summary Log</a>
        <a class="btn btn-default" href="<?= $this->Html->url(array("action" => "api_import_tree", "admin" => true)) ?>">Tree Log</a>
    </div>
</div>

<?php echo $this->Session->flash(); ?>

<div id="page-summary">
    <?= $this->element("$controller/$action") ?> 
</div>