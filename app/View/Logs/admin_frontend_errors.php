<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
        </div>        
    </div>
</div>

<?php echo $this->element("page_header", array("title" => "Frontend Error Log")); ?>

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
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Url :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('url', array(
                                    'value' => ${$model . "url"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Error Code :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('error_code', array(
                                    'value' => ${$model . "error_code"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">From Date :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('from_date', array(
                                    "id" => "from_date",
                                    'class' => "form-control date-picker",
                                    'value' => ${$model . "from_date"}, 
                                    "data-date-end" => "input#to_date",
                                    "autocomplete" => "off"
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">To Date :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('to_date', array(
                                    "id" => "to_date",
                                    'class' => "form-control date-picker",
                                    'value' => ${$model . "to_date"},
                                    "data-date-start" => "input#from_date",
                                    "autocomplete" => "off"
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