<?php $month_required = isset($month_required) ? "required" : ""; ?>
<div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">Month :</label>
            <div class="col-md-5 col-sm-6 col-xs-12">
                <?=
                $this->Form->input('month_year', array(
                    'class' => "form-control date-month-picker",
                    'value' => ${$model . "month_year"},
                    "data-date-end" => 0,
                    "autocomplete" => "off",
                    $month_required
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-6 col-xs-12">Department :</label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <?=
                $this->Form->input('dept_id', array(
                    "type" => "select",
                    "class" => "form-control select2me dept_id cascade-list",
                    'cascade-href' => '/Designations/getList/{{v}}',
                    'cascade-target' => '.desg_id',
                    'value' => ${"dept_id"},
                    "options" => $dept_list,
                    "empty" => DROPDOWN_EMPTY_VALUE
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-6 col-xs-12">Designation :</label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <?=
                $this->Form->input('desg_id', array(
                    "type" => "select",
                    "class" => "form-control select2me desg_id cascade-list",
                    'cascade-href' => '/Users/getList/0/{{v}}',
                    'cascade-target' => '.user_id',
                    'cascade-auto-load' => 1,
                    'data-value' => ${"desg_id"},
                    "empty" => DROPDOWN_EMPTY_VALUE
                ));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-6 col-xs-12">User :</label>
            <div class="col-md-5 col-sm-5 col-xs-12">
                <?=
                $this->Form->input('user_id', array(
                    "type" => "select",
                    "class" => "form-control select2me user_id submit-search-on-change",
                    'cascade-auto-load' => 1,
                    'value' => ${"user_id"},
                    'data-value' => ${"user_id"},
                    "options" => $user_list,
                    "empty" => DROPDOWN_EMPTY_VALUE
                ));
                ?>
            </div>
        </div>
    </div>
</div>