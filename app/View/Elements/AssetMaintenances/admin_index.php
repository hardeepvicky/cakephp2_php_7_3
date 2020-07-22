<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 7%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> Asset </th>
                    <th> Type </th>
                    <th> Payment </th>
                    <th> Mechanic Name </th>
                    <th> Remarks </th>
                    <th> <?= $this->Paginator->sort('created', __('Created')); ?> </th>
                    <th> Created By </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $asset_list[$record[$model]['asset_id']]; ?></td>
                    <td><?= AssetMaintenance::$typeList[$record[$model]['type']]; ?></td>
                    <td><?= $record[$model]['legder_expense_id'] ? $legder_expense_vocuher_list[$record[$model]['legder_expense_id']] : "-"; ?></td>
                    <td><?= $record[$model]['mechanic_name']; ?></td>
                    <td><?= $record[$model]['remarks']; ?></td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td><?= $user_list_cache[$record[$model]['created_by']]; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
