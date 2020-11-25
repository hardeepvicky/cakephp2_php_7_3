<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
        </div>        
    </div>
</div>

<?php echo $this->element("page_header", array("title" => "Email Logs")); ?>

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
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Code :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('code', array(
                                    "type" => "select",
                                    "options" => StaticArray::$email_code_list,
                                    "empty" => DROPDOWN_EMPTY_VALUE,
                                    "class" => "form-control select2me",
                                    'value' => ${$model . "code"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">From Email :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('from_email', array(
                                    'value' => ${$model . "from_email"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">To Email :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('to_email', array(
                                    'value' => ${$model . "to_email"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Subject / Content :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('subject_body', array(
                                    'value' => ${$model . "subject_body"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
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