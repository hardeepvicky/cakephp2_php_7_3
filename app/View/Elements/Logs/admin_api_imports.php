<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 20%;"> Api </th>
                    <th><?php echo $this->Paginator->sort('api_count',  'Api Count'); ?></th>
                    <th><?php echo $this->Paginator->sort('save_count',  'Save Count'); ?></th>
                    <th style="width : 12%;">Exec Time</th>
                    <th style="width : 20%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= isset($types[$record[$model]['type']]) ? $types[$record[$model]['type']] : "-"; ?></td>
                    <td><?= $record[$model]["api_count"] ?></td>
                    <td><?= $record[$model]["save_count"] ?></td>
                    <td><?= Util::niceTime($record[$model]["exec_time"]); ?></td>
                    <td><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>