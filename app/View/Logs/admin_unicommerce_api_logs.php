<?php
$title_for_layout = "Uncommerce Api Logs";
$status = array(
            '1' => "True",
            '0' => "False"
        );

?>

<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum", array("model" => $title_for_layout, "action" => "Summary")); ?>
        </div>        
    </div>
</div>
<?php echo $this->element("page_header", array("title" => $title_for_layout)); ?>

<?php echo $this->Session->flash(); ?>

<div class="data__filter">
    <div class="form__structure shadow">
        <?php 
            echo $this->Form->create($model, array(
                'type' => 'GET', 
                'class' => 'form-horizontal form-row-seperated',
                'inputDefaults' => array(
                    'label' => false, 'div' => false, 'div' => false, "escape" => false, 
                    "class" => "form-control", "type" => "text", "required" => false
                )
            ));
        ?>
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Status :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                 <?= $this->Form->input('successful', array(
                                    'type' => 'select', 
                                    "class" => "form-control select2me",
                                    'options' => $status,
                                    'empty' => DROPDOWN_EMPTY_VALUE
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons text-center">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" class="btn blue">Search</button>
                        <a class="btn grey" href="<?= $this->Html->url(array("action" => "clearSearchCache", "admin" => false, $action)) ?>">Clear</a>
                    </div> 
                </div>
            </div>
        </div>
        </form>
    </div>
</div>

<div id="page-summary">
    <?= $this->element("$controller/$action") ?> 
</div>