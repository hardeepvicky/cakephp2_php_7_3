<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th colspan="3">Actions</th>
                    <th style="width : 20%;"> Cron Name </th>
                    <th><?php echo $this->Paginator->sort('sql_count',  'Sql Count'); ?></th>
                    <th><?php echo $this->Paginator->sort('sql_exec_time',  'Sql Exec Time'); ?></th>
                    <th style="width : 10%;"><?php echo $this->Paginator->sort('status',  'Status'); ?></th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>
                        <a href="/Logs/downloadCronJobLog/<?= $record[$model]['id'] ?>/sql_log/txt" target="_blank">Download Sql Log</a>
                    </td>
                    <td>
                        <a href="/Logs/downloadCronJobLog/<?= $record[$model]['id'] ?>/response/html" target="_blank">Download Log</a>
                    </td>
                    <td>                        
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
                    <td><?= isset($cron_types[$record[$model]['type']]) ? $cron_types[$record[$model]['type']] : "-"; ?></td>
                    <td><?= $record[$model]["sql_count"] ?></td>
                    <td><?= $record[$model]["sql_exec_time"] ?></td>
                    <td>
                        <i class="fa <?= $record[$model]['status'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                    </td>
                    <td><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>                    
                </tr>
                 <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="9" style="background-color:#EEF2F5; text-align: left;">
                        <label><b>Description</b></label><br/>
                        <div class="portlet-body padding-5 has-margin-bottom-10">
                            <?= $record[$model]['description']; ?>
                        </div>
                    </td>
                 </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>