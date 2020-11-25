<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 5%;"> # </th>
                    <th style="width : 10%;"> Actions </th>
                    <th>Api </th>
                    <th>Api Count</th>
                    <th>Save Count</th>
                    <th>Report Id</th>
                    <th style="width : 12%;">Exec Time</th>
                    <th style="width : 20%;">Datetime</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $k => $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $k + 1; ?></td>
                    <td>                        
                        <a href="javascript:void(0);" class="css-toggler ajax-loader" 
                           data-toggler-class="hidden" 
                           data-toggler-target="tr#<?= $record[$model]['id']; ?>" 
                           data-loader-target="tr#<?= $record[$model]['id']; ?>  .api_detail:first" 
                           data-loader-href="/Logs/ajaxApiImportSummary/<?= $record[$model]['id']; ?>"
                        >
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
                    <td colspan="7" style="background-color:#EEF2F5;">
                        <div class="api_detail"></div>
                    </td>
                 </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>