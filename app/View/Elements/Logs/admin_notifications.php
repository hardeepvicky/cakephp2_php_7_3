<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true, "ajax" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th style="width : 8%;" data-search-clear="1"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 10%;" data-search="1"> Type </th>
                    <th style="width : 12%;" data-search="1"> From User </th>
                    <th style="width : 12%;" data-search="1"> To User </th>
                    <th data-search="1"> Title </th>
                    <th data-search="1"> Details </th>
                    <th data-search="1"> Push Notification Type </th>
                    <th data-search="1"> Push Notification Sent </th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= isset($types[$record[$model]['type']]) ? $types[$record[$model]['type']] : "-"; ?></td>
                    <td><?= isset($user_list[$record[$model]['from_user_id']]) ? $user_list[$record[$model]['from_user_id']] : "-"; ?></td>
                    <td><?= isset($user_list[$record[$model]['to_user_id']]) ? $user_list[$record[$model]['to_user_id']] : "-"; ?></td>
                    <td><?= $record[$model]['title']; ?></td>
                    <td><?= $record[$model]['detail']; ?></td>
                    
                    <td><?= $record["PushNotificationLog"]["type"] ? $push_noti_types[$record["PushNotificationLog"]["type"]] : "-" ?></td>
                    <td>
                        <?php if ($record["PushNotificationLog"]["type"]): ?>
                            <i class="fa <?= $record["PushNotificationLog"]['is_sent'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination", array("ajax" => true)) ?>
</div>