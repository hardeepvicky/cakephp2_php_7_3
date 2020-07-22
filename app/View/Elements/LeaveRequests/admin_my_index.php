<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('start_date', __('Start Date')); ?> </th>
                    <th> <?= $this->Paginator->sort('end_date', __('End Date')); ?> </th>
                    <th> No. of Days </th>
                    <th> Leave Reason </th>
                    <th> <?= $this->Paginator->sort('is_paid', __('Paid Leave')); ?> </th>
                    <th> Status </th>
                    <th> Remarks </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['start_date']; ?></td>
                    <td><?= $record[$model]['end_date']; ?></td>
                    <td><?= $record[$model]['leave_count']; ?></td>
                    <td><?= $record[$model]['leave_reason']; ?></td>
                    <td class="is_paid"><?= $record[$model]['is_paid'] ? '<span class="label label-info">Yes</span>' : 'No'; ?></td>
                    <td><?= LeaveRequest::$status_list[$record[$model]['status']]; ?></td>
                    <td><?= $record[$model]['remarks']; ?></td>
                    <td>
                        <?php if ($record[$model]['status'] == 0) : ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>
                        <?php endif; ?>
                        
                        <?php $url = $this->Html->url(array("action" => "admin_view", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-eye icon green-haze"></i>
                        </a>
                        
                        <?php if ($record[$model]['status'] != LeaveRequest::APPROVE) : ?>
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
