<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th style="width : 10%;" data-search-clear="1"> # </th>
                    <?php if (isset($show_report_name)) : ?>
                        <th data-search="1" data-sort="alpha"> Report </th>
                    <?php endif; ?>
                    <th data-search="1" data-sort="alpha"> Conditions </th>
                    <th data-search="1" data-sort="alpha"> Status </th>
                    <th> Actions </th>
                    <th data-search="1" data-sort="alpha"> Created  </th>
                    <th data-search="1" data-sort="alpha"> Created By </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                    <tr class="odd gradeX center">
                        <td><?= $record[$model]['id']; ?></td>
                        <?php if (isset($show_report_name)) : ?>
                            <td><?= Report::$list[$record[$model]['type']]; ?></td>
                        <?php endif; ?>
                        <td><?= $record[$model]['search_params']; ?></td>
                        <td>
                            <?php if ($record[$model]["status"] == 0): ?>
                                <label class="label label-info">In Progress</label>
                            <?php elseif ($record[$model]["status"] == 1): ?>
                                <label class="label label-success">Success</label>
                                <br/>
                                
                            <?php elseif ($record[$model]["status"] == -1): ?>
                                <label class="label label-danger">Error</label>
                            <?php endif; ?>                        
                        </td>
                        <td>
                            <?php if ($record[$model]['file'] && file_exists($record[$model]['file'])): ?>
                                <a href="/<?= $record[$model]['file']; ?>">Download</a>
                            <?php endif; ?>
                        </td>
                        <td><?= DateUtility::getDate($record[$model]["created"], DateUtility::DATETIME_OUT_FORMAT) ?></td>
                        <td><?= $user_list[$record[$model]['created_by']]; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

