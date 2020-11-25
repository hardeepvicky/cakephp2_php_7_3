<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th style="width : 10%;" data-search-clear="1"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th data-search="1"> User </th>
                    <th data-search="1"> Activity </th>
                    <th data-search="1"> Detail </th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $record[$model]['id']; ?></td>
                    <td class="text-center"><?= isset($user_list[$record[$model]['created_by']]) ? $user_list[$record[$model]['created_by']] : $record[$model]['created_by']; ?></td>
                    <td><?= $record[$model]['activity']; ?></td>
                    <td><?= $record[$model]['detail']; ?></td>
                    <td class="text-center"><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>