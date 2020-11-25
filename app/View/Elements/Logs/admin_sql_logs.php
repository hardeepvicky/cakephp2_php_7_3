<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th style="width : 10%;" data-search-clear="1"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 20%;" >Actions</th>
                    <th data-search="1"> Controller  </th>
                    <th data-search="1"> Action  </th>
                    <th> Url  </th>
                    <th style="width : 8%;"><?php echo $this->Paginator->sort('sql_count',  'Sql Count'); ?></th>
                    <th style="width : 8%;"><?php echo $this->Paginator->sort('sql_exec_time',  'Sql Exec Time'); ?></th>
                    <th style="width : 10%;"><?php echo $this->Paginator->sort('created',  'Created'); ?></th>
                    <th style="width : 10%;">Created By</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>                        
                        <a class="btn btn-default" href="/Logs/downloadSqlLog/<?= $record[$model]['id'] ?>/post_data/txt" target="_blank">Download Post Data</a>
                        <br/>
                        <a class="btn btn-default" href="/Logs/downloadSqlLog/<?= $record[$model]['id'] ?>/sql_log/txt" target="_blank">Download SQL Log</a>
                        <br/>
                        <?php if ($record[$model]['have_heavy_query']): ?>
                            <a class="btn btn-default" href="/Logs/downloadSqlLog/<?= $record[$model]['id'] ?>/sql_log/txt" target="_blank">Download SQL Log</a>
                            <br/>
                        <?php endif; ?>
                        <a class="btn btn-default" href="/Logs/downloadSqlLog/<?= $record[$model]['id'] ?>/dml_sql_log/txt" target="_blank">Download DML SQL Log</a>
                        <br/>
                        <a class="btn btn-default" href="/Logs/downloadSqlLog/<?= $record[$model]['id'] ?>/response/json" target="_blank">Download Response</a>
                    </td>
                    <td><?= $record[$model]["controller"] ?></td>
                    <td><?= $record[$model]["action"] ?></td>
                    <td><?= $record[$model]["url"] ?></td>
                    <td><?= $record[$model]["sql_count"] ?></td>
                    <td><?= $record[$model]["sql_exec_time"] ?></td>
                    <td><?php echo DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td><?= if_exist($user_list, $record[$model]["created_by"]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>