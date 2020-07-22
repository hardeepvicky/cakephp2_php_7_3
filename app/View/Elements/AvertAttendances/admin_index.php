<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> User </th>
                    <th> Type </th>
                    <th> Start Time </th>
                    <th> End Time </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $user_list[$record[$model]['user_id']]; ?></td>
                    <td><?= AvertAttendance::$type_list[$record[$model]['type']]; ?></td>
                    <td><?= $record[$model]['start_time']; ?></td>
                    <td><?= $record[$model]['end_time']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
