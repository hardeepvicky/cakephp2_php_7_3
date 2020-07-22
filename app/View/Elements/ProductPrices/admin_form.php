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
                "class" => "form-control invalid-sql-char", "type" => "text"
            )
        ));

        echo $this->Form->hidden('id');
    ?>
        <div class="form-body">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Category :</label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px">
                    <?= $product['Category']['name'] ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Product :</label>
                <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px">
                    <?= $product['Product']['sku'] ?>
                </div>
            </div>
    
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Date <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('date', array(
                        'placeholder' => 'dd-MMM-yyyy', 
                        "class" => "form-control date-picker",
                        'data-date-start' => isset($product[$model][0]['date']) ? DateUtility::diff($product[$model][0]['date'], date("Y-m-d"), DateUtility::DAYS) + 1 : "",
                        "autocomplete" => "off"
                    )); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Price <span>*</span> :</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <?= $this->Form->input('price', array('placeholder' => 'Price', "class" => "form-control validate-float")); ?>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    Per <?= $product["Category"]['MeasurementUnit']['name'] ?> ( <?= $product["Category"]['MeasurementUnit']['name'] ?> )
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