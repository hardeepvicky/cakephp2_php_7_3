<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 4%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th> Month - Year </th>
                    <th> User </th>
                    <th> Department </th>
                    <th> Salary Payment Mode </th>
                    <th> Working </th>
                    <th> Ignore </th>
                    <th> Holidays </th>
                    <th> Leave </th>
                    <th> One Hour Salary </th>
                    <th> Basic Salary </th>
                    <th> HRA </th>
                    <th> Others </th>
                    <th> ESI </th>
                    <th> PF </th>
                    <th> TDS </th>
                    <th> Payable Amount </th>
                    <th> Adjust Amount </th>
                    <th> Paid Amount </th>
                    <th> <?= $this->Paginator->sort('is_paid', __('Paid')); ?> </th>
                    <th>Paid DateTime</th>
                    <th style="width : 8%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= StaticArray::$months[$record[$model]['month']]. "-" . $record[$model]['year']; ?></td>
                    <td><?= $user_list[$record[$model]['user_id']] ?></td>
                    <td><?= $dept_list[$record["User"]['dept_id']] ?></td>
                    <td><?= User::$payment_modes[$record[$model]['salary_payment_mode']]?></td>
                    <td><?= $record[$model]['working_hours'] . "H, " . $record[$model]['working_days'] . "D" ?></td>
                    <td><?= $record[$model]['ignore_hours'] . "H, " . $record[$model]['ignore_days'] . "D" ?></td>
                    <td><?= $record[$model]['holiday_hours'] . "H, " . $record[$model]['holidays'] . "D" ?></td>
                    <td><?= $record[$model]['leave_hours'] . "H, " . $record[$model]['leave_days'] . "D" ?></td>
                    <td><?= $record[$model]['one_hour_salary']; ?></td>
                    <td><?= $record[$model]['salary_basic']; ?></td>
                    <td><?= $record[$model]['salary_hra']; ?></td>
                    <td><?= $record[$model]['salary_others']; ?></td>
                    <td><?= $record[$model]['esi']; ?></td>
                    <td><?= $record[$model]['pf']; ?></td>
                    <td><?= $record[$model]['tds']; ?></td>
                    <td><?= $record[$model]['payable_amount']; ?></td>
                    <td><?= $record[$model]['adjust_amount']; ?></td>
                    <td><?= $record[$model]['paid_amount']; ?></td>
                    <td><?= $record[$model]['is_paid'] ? '<span class="label label-success">Yes<span>' : ''; ?></td>
                    <td><?= $record[$model]['is_paid'] ? DateUtility::getDate($record[$model]['paid_datetime'], DateUtility::DATETIME_OUT_FORMAT) : ''; ?></td>
                    <td>
                        <?php if (!$record[$model]['is_import']): ?> 
                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>