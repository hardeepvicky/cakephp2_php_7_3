<?php if($records): ?>
    <a class="btn blue" href="<?= $this->Html->url(array_merge(array("action" => "admin_csv"), $search)); ?>">Export CSV</a>
<?php endif; ?>

<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <form method="POST" target="_blank">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width:50px;">
                        <input type="checkbox" class="chk-select-all" data-href=".child-chk" />
                    </th>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('firstname', __('First Name')); ?> </th>
                    <th> <?= $this->Paginator->sort('lastname', __('Last Name')); ?> </th>
                    <th> Group </th>
                    <th> Department </th>
                    <th> Designation </th>
                    <th> <?= $this->Paginator->sort('username', __('Username')); ?> </th>
                    <th> <?= $this->Paginator->sort('mobile_no', __('Mobile')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_active', __('Status')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_allow_out_for_work', __('Out For Work')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_attendance_by_username_allow', __('Attendance By Username')); ?> </th>
                    <th style="width : 8%;"> Watch List </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('created', __('Created')); ?> </th>
                    <th style="width : 10%;"> Created By </th>
                    <th style="width : 10%;"> Last Edit By </th>
                    <th style="width : 12%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td>
                        <input type="checkbox" class="child-chk" value="<?= $record[$model]['id']; ?>" name="user_ids[]" />
                    </td>
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['firstname']; ?></td>
                    <td><?= $record[$model]['lastname']; ?></td>
                    <td><?= $group_list[$record[$model]['group_id']]; ?></td>
                    <td><?= isset($dept_list[$record[$model]['dept_id']]) ? $dept_list[$record[$model]['dept_id']] : "-"; ?></td>
                    <td><?= isset($desg_list[$record[$model]['desg_id']]) ? $desg_list[$record[$model]['desg_id']] : "-"; ?></td>
                    <?php if (!$record[$model]['is_mobile_hide'] || in_array($auth_user["group_id"], array(GROUP_ADMIN, GROUP_SUBADMIN)) ): ?>
                        <td><?= $record[$model]['username']; ?></td>
                        <td><?= $record[$model]['mobile_no']; ?></td>
                    <?php else : ?>
                        <td>*****</td>
                        <td>*****</td>
                    <?php endif; ?>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "ajaxToggleStatus", $record[$model]['id'], "admin" => false)); ?>
                        <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_active" data-value="<?= (int) $record[$model]['is_active'] ?>">
                            <i class="fa <?= $record[$model]['is_active'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        </a>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "ajaxToggleOutForWork", $record[$model]['id'], "admin" => false)); ?>
                        <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_allow_out_for_work" data-value="<?= (int) $record[$model]['is_allow_out_for_work'] ?>">
                            <i class="fa <?= $record[$model]['is_allow_out_for_work'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        </a>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "ajaxToggleAttendanceByUsername", $record[$model]['id'], "admin" => false)); ?>
                        <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_attendance_by_username_allow" data-value="<?= (int) $record[$model]['is_attendance_by_username_allow'] ?>">
                            <i class="fa <?= $record[$model]['is_attendance_by_username_allow'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        </a>
                    </td>
                    <td>
                        <?php 
                        $cls = "";
                        if (in_array($record[$model]['id'], $my_user_watch_list))
                        {
                            $url = $this->Html->url(array("action" => "admin_remove_from_watchList", $record[$model]['id']));
                            $cls = 'fa-check-circle-o font-green-meadow icon';
                        }
                        else
                        {
                            $url = $this->Html->url(array("action" => "admin_add_to_watchList", $record[$model]['id']));
                            $cls = "fa-times-circle-o font-red-sunglo icon";
                        }
                         ?>
                        
                        <a href="<?= $url; ?>">
                            <i class="fa <?= $cls ?>"></i>
                        </a>
                    </td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td><?= isset($user_list_cache[$record[$model]['created_by']]) ? $user_list_cache[$record[$model]['created_by']] : "-"; ?></td>
                    <td><?= isset($user_list_cache[$record[$model]['modified_by']]) ? $user_list_cache[$record[$model]['modified_by']] : "-" ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        
                        <?php if ($url) : ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr class="hidden" id="tr-<?= $record[$model]['id'] ?>" style="background-color: #EEE">
                    <td colspan="11">
                        <label>
                            <h3 class="section">
                                Shifts
                                <a class="btn btn-default" target="_blank" href="<?= $this->Html->url(array("action" => "add_shift", $record[$model]['id'])) ?>">
                                    Add Shift
                                </a>
                            </h3>
                        </label>
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr>
                                    <td>Date</td>
                                    <td>Shift</td>
                                    <td>From Time</td>
                                    <td>To Time</td>
                                    <td>S</td>
                                    <td>M</td>
                                    <td>T</td>
                                    <td>W</td>
                                    <td>Th</td>
                                    <td>F</td>
                                    <td>St</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($record['UserShift'] as $user_shift): 
                                        $shift = $shifts[$user_shift['shift_id']]; 
                                ?>
                                <tr>
                                    <td><?= DateUtility::getDate($user_shift['start_date'], "M-Y") ?></td>
                                    <td><?= $shift['name'] ?></td>
                                    <td><?= DateUtility::getDate($shift['from_time'], DateUtility::TIME_OUT_FORMAT) ?></td>
                                    <td><?= DateUtility::getDate($shift['to_time'], DateUtility::TIME_OUT_FORMAT) ?></td>
                                    <td><?= $shift['sunday'] ?></td>
                                    <td><?= $shift['monday'] ?></td>
                                    <td><?= $shift['tuesday'] ?></td>
                                    <td><?= $shift['wednesday'] ?></td>
                                    <td><?= $shift['thursday'] ?></td>
                                    <td><?= $shift['friday'] ?></td>
                                    <td><?= $shift['saturday'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>      
                        
                        <?php if ($record[$model]['employee_type'] == 1): ?>
                        <label>
                            <h3 class="section">
                                Salary
                                <a class="btn btn-default" target="_blank" href="<?= $this->Html->url(array("action" => "add_salary", $record[$model]['id'])) ?>">
                                    Add Salary
                                </a>
                            </h3>
                        </label>
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr class="center">
                                    <td rowspan="2">Date</td>
                                    <td colspan="3">Per Month</td>
                                </tr>
                                <tr class="center">
                                    <td>Basic Salary</td>
                                    <td>HRA</td>
                                    <td>Others</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($record['UserSalary'] as $user_salary): ?>
                                <tr class="center">
                                    <td><?= DateUtility::getDate($user_salary['start_date'], "M-Y") ?></td>
                                    <td><?= $user_salary['basic_salary'] ?></td>
                                    <td><?= $user_salary['hra'] ?></td>
                                    <td><?= $user_salary['others'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table> 
                        <?php endif; ?>
                        
                        <label>
                            <h3 class="section">
                                Leave
                                <a class="btn btn-default" target="_blank" href="<?= $this->Html->url(array("action" => "add_leave_category", $record[$model]['id'])) ?>">
                                    Add Leave
                                </a>
                            </h3>
                        </label>
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr class="center">
                                    <td>Leave Caetgory</td>
                                    <td>Leaves Per Month</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($record['UserLeaveCategory'] as $user_leave): 
                                    $leave_category = $leave_categories[$user_leave['leave_category_id']]; 
                                ?>
                                <tr class="center">
                                    <td><?= $leave_category['name'] ?></td>
                                    <td><?= $leave_category['leaves_per_month'] ?></td>
                                    <td>
                                        <?php $url = $this->Html->url(["action" => "admin_delete_leave_category", $user_leave["id"]]); ?>
                                        <a href="<?= $url; ?>" class="summary-link delete-leave">
                                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>                         
                    </td>
                    <td colspan="5">
                        <label><b> Salary Payment Mode : </b> <?= User::$payment_modes[$record[$model]["salary_payment_mode"]] ?><br/>
                        <?php if ($record[$model]["salary_payment_mode"] == PAYMENT_MODE_BANK_TRANSFER) : ?>
                        <label><b> Bank Name : </b> <?= $record[$model]["bank_name"] ?><br/>
                        <label><b> Bank IFSC Code : </b> <?= $record[$model]["bank_ifsc_code"] ?><br/>
                        <label><b> Bank Account : </b> <?= $record[$model]["bank_account_no"] ?><br/>
                        <?php endif; ?>
                        <br/>
                        
                        <label><b> Lunch Time : </b> <?= $record[$model]["lunch_start_time"] ?> To <?= $record[$model]["lunch_end_time"] ?> </label><br/>                        
                        <br/>
                        
                        <label><b> Locations </b> </label>
                        <ol>
                            <?php foreach($record["UserLocation"] as $user_location): ?>
                            <li><?= $location_list_cache[$user_location["location_id"]] ?></li>
                            <?php endforeach; ?>
                        </ol>
                        <br/>
                        
                        <label><b> Auxllary Designation </b> </label>
                        <ol>
                            <?php foreach($record["UserDesignation"] as $user_desg): ?>
                            <li><?= $dept_desg_list[$user_desg["desg_id"]] ?></li>
                            <?php endforeach; ?>
                        </ol>
                        <br/>
                        
                        <label><b> Funds </b> </label>
                        <ol>
                            <li>
                                ESI Applicable : 
                                <?php if ($record[$model]["is_esi"]) : ?>
                                    <label class="label label-success">Yes</label>
                                <?php else : ?>
                                    <label class="label label-danger">NO</label>
                                <?php endif; ?>
                            </li>
                            <li>
                                PF Applicable : 
                                <?php if ($record[$model]["is_pf"]) : ?>
                                    <label class="label label-success">Yes</label>
                                <?php else : ?>
                                    <label class="label label-danger">NO</label>
                                <?php endif; ?>
                            </li>
                            <li>
                                TDS Applicable : 
                                <?php if ($record[$model]["is_tds"]) : ?>
                                    <label class="label label-success">Yes</label>
                                <?php else : ?>
                                    <label class="label label-danger">NO</label>
                                <?php endif; ?>
                            </li>
                        </ol>
                    </td>
                </tr>
                <?php endforeach; ?>            
            </tbody>
        </table>
        <span class="btn blue-madison form-post" data-href="<?= $this->Html->url(array("action" => "admin_barcode_pdf")); ?>">Barcode Pdf</span>
        </form>
    </div>
    <?= $this->element("pagination") ?>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $(".form-post").click(function()
    {
        var url = $(this).attr("data-href");
        
        var _form = $(this).closest("form");
        
        _form.attr("action", url);
        
        _form.trigger("submit");
    });
});
</script>