<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th style="width : 10%;" data-search-clear="1"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 10%;">Actions</th>
                    <th style="width : 15%;" data-search="1"> Type </th>
                    <th style="width : 15%;" data-search="1"> From User </th>
                    <th style="width : 15%;" data-search="1"> To User </th>
                    <th data-search="1"> Title </th>
                    <th data-search="1"> Detail </th>
                    <th style="width : 10%;"> Sent </th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $record[$model]['id']; ?></td>
                    <td class="text-center">
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
                    <td class="text-center"><?= isset($types[$record[$model]['type']]) ? $types[$record[$model]['type']] : "-"; ?></td>
                    <td class="text-center"><?= isset($user_list[$record["Notification"]['from_user_id']]) ? $user_list[$record["Notification"]['from_user_id']] : "-"; ?></td>
                    <td class="text-center"><?= isset($user_list[$record["Notification"]['to_user_id']]) ? $user_list[$record["Notification"]['to_user_id']] : "-"; ?></td>
                    <td><?= $record[$model]['title']; ?></td>
                    <td><?= $record[$model]['detail']; ?></td>
                    <td class="text-center">
                        <i class="fa <?= $record[$model]['is_sent'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                    </td>
                    <td class="text-center"><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>
                </tr>
                <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="5">
                        <div>
                            <b>GCM No. : </b> <?= $record[$model]['gcm_no']?>
                        </div><br/>
                        <div>
                            <b>Sent JSON : </b> <?= $record[$model]['sent_json']?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>