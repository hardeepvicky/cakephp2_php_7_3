<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 20%;"> Type </th>
                    <th> Total Count </th>
                    <th> Accept Count </th>                    
                    <th> Update Count </th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                    <th style="width : 25%;"> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $record[$model]['id']; ?></td>
                    <td class="text-center"><?= isset(ImportLogTypes::$list[$record[$model]['type']]) ? ImportLogTypes::$list[$record[$model]['type']] : "-"; ?></td>
                    <td class="text-center"><?= $record[$model]['total_count']; ?></td>
                    <td class="text-center"><?= $record[$model]['accept_count']; ?></td>
                    <td class="text-center"><?= $record[$model]['update_count']; ?></td>
                    <td class="text-center"><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>
                    <td class="text-center">
                        <a class="btn blue" href="<?= $record[$model]["file"] ?>" download>Download File</a>
                        <?php if ($record[$model]['error_log']): ?>
                            <a class="btn green-haze" href="<?= $this->Html->url(array("controller" => "Logs", "action" => "admin_download_import_error_log", $record[$model]['id'])) ?>">Download Error Log</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>