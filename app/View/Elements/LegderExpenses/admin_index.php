<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th> Party Ledger Account </th>
                    <th> Voucher No. </th>
                    <th style="width : 10%"> Party Voucher No. / Inventory Challan No. </th>
                    <th> Paid Amount </th>
                    <th> Expect Amount </th>
                    <th><?php echo $this->Paginator->sort('is_verified',  'Verified'); ?></th>
                    <th>Verified By</th>
                    <th><?php echo $this->Paginator->sort('is_deleted',  'Deleted'); ?></th>
                    <th>Delete By</th>
                    <th>Created</th>
                    <th>Created By</th>
                    <th style="width : 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $record[$model]['id']; ?></td>
                    <td><?= isset($legder_account_list[$record[$model]['to_legder_account_id']]) ? $legder_account_list[$record[$model]['to_legder_account_id']] : "-"; ?></td>
                    <td class="text-center"><?= $record[$model]['voucher_no']; ?></td>          
                    <td class="text-center"><?= $record[$model]['party_voucher_no']; ?></td>          
                    <td class="text-center"><?= $record[$model]['amount']; ?></td>          
                    <td class="text-center"><?= $record[$model]['expect_amount']; ?></td>
                    <td class="text-center"><?= $record[$model]['is_verified'] ? '<span class="label label-success">Yes</span>' : ""; ?></td>          
                    <td class="text-center"><?= isset($user_list[$record[$model]['verify_by']]) ? $user_list[$record[$model]['verify_by']] : "-"; ?></td>
                    <td class="text-center"><?= $record[$model]['is_deleted'] ? '<span class="label label-success">Yes</span>' : ""; ?></td>          
                    <td class="text-center"><?= $record[$model]['is_deleted'] && isset($user_list[$record[$model]['modified_by']]) ? $user_list[$record[$model]['modified_by']] : "-"; ?></td>
                    <td class="text-center"><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td class="text-center"><?= isset($user_list[$record[$model]['created_by']]) ? $user_list[$record[$model]['created_by']] : "-"; ?></td>
                    <td class="text-center">
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>