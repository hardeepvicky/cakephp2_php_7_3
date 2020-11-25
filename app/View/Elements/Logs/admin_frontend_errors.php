<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th style="width : 10%;" data-search-clear="1"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 20%;" colspan="2"> Actions </th>
                    <th style="width : 8%;" data-search="1"> <?= $this->Paginator->sort('error_code', __('Code')); ?> </th>
                    <th data-search="1">Url</th>
                    <th data-search="1">Msg</th>
                    <th style="width : 10%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>
                        <a href="/Logs/downloadFrontendError/<?= $record[$model]['id'] ?>/error_detail/html" target="_blank">Download Log</a>
                    </td>
                    <td>
                        <a href="/Logs/downloadFrontendError/<?= $record[$model]['id'] ?>/auth/html" target="_blank">Download Auth</a>
                    </td>
                    <td><?= $record[$model]["error_code"] ?></td>
                    <td><?= $record[$model]["url"] ?></td>
                    <td><?= $record[$model]["error_msg"] ?></td>
                    <td><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>