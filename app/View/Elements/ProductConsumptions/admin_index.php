<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Sku</th>
                    <th>Operation Type</th>
                    <th>Sub Location</th>
                    <th>Qty</th>
                    <th> <?= $this->Paginator->sort('date_time', __('Date Time')); ?> </th>
                    <th> <?= $this->Paginator->sort('is_return', __('Return')); ?> </th>
                    <th>User</th>
                    <th style="width : 12%;">Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $sku_list[$record[$model]['product_id']]; ?></td>
                    <td><?= $record[$model]['is_return'] ? "" : $operation_type_list[$record[$model]['operation_type_id']]; ?></td>
                    <td><?= $record["SubLocation"]['name']; ?></td>
                    <td><?= abs($record[$model]['qty']); ?></td>
                    <td><?= $record[$model]['date_time']; ?></td>
                    <td><?= $record[$model]['is_return'] ? '<span class="label label-success"> Return </span>' : '' ?></td>
                    <td><?= isset($user_list[$record[$model]['user_id']]) ? $user_list[$record[$model]['user_id']] : ""; ?></td>
                    <td><?= $record[$model]['comments']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
