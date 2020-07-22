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
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Party Ledger Account :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('to_legder_account_id', array(
                                    'type' => 'select', 
                                    "class" => "form-control select2me",
                                    'options' => $legder_account_list,
                                    'empty' => DROPDOWN_EMPTY_VALUE,
                                    'value' => ${$model . "to_legder_account_id"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Created By :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('created_by', array(
                                    'type' => 'select', 
                                    "class" => "form-control select2me",
                                    'options' => $user_list,
                                    'empty' => DROPDOWN_EMPTY_VALUE,
                                    'value' => ${$model . "created_by"},
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Party Voucher No. :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('party_voucher_no', array(
                                    'value' => ${$model . "party_voucher_no"}, 
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Voucher No. :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('voucher_no', array(
                                    'value' => ${$model . "voucher_no"}, 
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
                        <a class="btn grey" href="<?= $this->Html->url(array("action" => "clearSearchCache", "admin" => false, "admin_index")) ?>">Clear</a>
                    </div> 
                </div>
            </div>
        </div>
        </form>
    </div>
</div>