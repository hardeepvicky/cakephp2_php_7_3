<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th colspan="3">Actions</th>
                    <th style="width : 25%;"> Api </th>
                    <th>Api Count</th>
                    <th>Save Count</th>
                    <th>Report Id</th>
                    <th style="width : 12%;">Exec Time</th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>
                        <a href="/Logs/downloadCronJobLog/<?= $record[$model]['cron_log_id'] ?>/sql_log/txt" target="_blank">Download Sql Log</a>
                    </td>
                    <td>
                        <a href="/Logs/downloadCronJobLog/<?= $record[$model]['cron_log_id'] ?>/response/html" target="_blank">Download Response</a>
                    </td>
                    <td>                        
                        <a href="javascript:void(0);" class="css-toggler ajax-loader" 
                           data-toggler-class="hidden" 
                           data-toggler-target="tr#<?= $record[$model]['id']; ?>" 
                           data-loader-target="tr#<?= $record[$model]['id']; ?> .api_detail:first" 
                           data-loader-href="/Logs/ajaxApiImportSummary/<?= $record[$model]['id']; ?>">
                            Details
                        </a>
                    </td>
                    <td><?= isset($types[$record[$model]['type']]) ? $types[$record[$model]['type']] : "-"; ?></td>
                    <td><?= $record[$model]["api_count"] ?></td>
                    <td><?= $record[$model]["save_count"] ?></td>
                    <td><?= $record[$model]["response"] ?></td>
                    <td><?= Util::niceTime($record[$model]["exec_time"]); ?></td>
                    <td><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>                    
                </tr>
                 <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="8" style="background-color:#EEF2F5;">
                        <div class="api_detail"></div>
                    </td>
                 </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>