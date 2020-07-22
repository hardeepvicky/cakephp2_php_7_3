<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Reason Type</th>
                    <th>Assign By</th>
                    <th>Reason</th>
                    <th style="width : 12%;">Created</th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): $tr_cls = $record[$model]["is_deleted"] ? "strike-through" : ""; ?>
                <tr class="odd gradeX center <?= $tr_cls ?>">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $strike_point_type_list[$record[$model]['strike_point_type_id']]; ?></td>
                    <td><?= $user_list_cache[$record[$model]['assign_by_user_id']]; ?></td>
                    <td><?= $record[$model]['reason']; ?></td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td>
                        <a href="javascript:void(0);" class="css-toggler"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr class="hidden" id="record-<?= $record[$model]["id"] ?>">
                    <td></td>
                    <td colspan="4" style="background-color: #EEE">
                        <?= $this->element("StrikePoints/detail", ["record" => $record]) ?>
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
