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
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">From Date :</label>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <?= $this->Form->input('from_date', array(
                                    "id" => "from_date",
                                    'class' => "form-control date-picker",
                                    'value' => ${$model . "from_date"}, 
                                    "data-date-end" => "input#to_date",
                                    "autocomplete" => "off",
                                    "required"
                                )); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">To Date :</label>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <?= $this->Form->input('to_date', array(
                                    "id" => "to_date",
                                    'class' => "form-control date-picker",
                                    'value' => ${$model . "to_date"},
                                    "data-date-start" => "input#from_date",
                                    "data-date-end" => 0,
                                    "autocomplete" => "off",
                                    "required"
                                )); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-6 col-xs-12">Department :</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <?= $this->Form->input('dept_id', array(
                                    "type" => "select",
                                    "class" => "form-control select2me dept_id cascade-list",
                                    'cascade-href' => '/Designations/getList/{{v}}',
                                    'cascade-target' => '.desg_id',
                                    'value' => ${"Userdept_id"},
                                    "options" => $dept_list,
                                    "empty" => DROPDOWN_EMPTY_VALUE
                                ));?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-6 col-xs-12">Designation :</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <?= $this->Form->input('desg_id', array(
                                    "type" => "select",
                                    "class" => "form-control select2me desg_id submit-search-on-change",
                                    'cascade-auto-load' => 1,
                                    'data-value' => ${"Userdesg_id"},
                                    "empty" => DROPDOWN_EMPTY_VALUE
                                ));?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-6 col-xs-12">Username / Name / Email :</label>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <?= $this->Form->input('username', array('value' => ${"Userusername"}));?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action-buttons text-center">
                    <div class="col-md-12">
                        <button type="submit" class="btn blue">Search</button>
                        <a class="btn grey" href="<?= $this->Html->url(array("action" => "clearSearchCache", "admin" => false, $action)) ?>">Clear</a>
                    </div> 
                </div>
            </div>
        </div>
        </form>
    </div>    
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        $(".dept_id").trigger("change", { pageLoad : true});
    });
</script>