
<div class="form__structure">
    <?php
        echo $this->Form->create($model, array(
            'type' => 'file',
            "class" => "form-horizontal form-row-seperated validate",
            'inputDefaults' => array(
                'label' => false, 'div' => false, 'div' => false, "escape" => false,
                "class" => "form-control invalid-sql-char ", "type" => "text"
            )
        ));
        
        echo $this->Form->hidden('id');
    ?>
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Return Person Name <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $this->Form->input('return_person_name', array('placeholder' => 'Name', "required")); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Return Person Mobile <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $this->Form->input('return_person_mobile', array('class' => "form-control validate-mobile", "required")); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Return Date <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $this->Form->input('return_date', array('class' => "form-control date-picker", "autocomplete" => "off", "placeholder" => "dd-MMM-YYY", "required")); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Return Comments :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $this->Form->input('return_comments', [
                    "type" => "textarea",
                    "rows" => 5  
                ]); ?>
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