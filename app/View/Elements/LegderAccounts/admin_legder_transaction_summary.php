<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="summary">
            <thead>
                <tr>
                    <th style="width : 10%;"> <input type="checkbox" class="chk-select-all" data-href=".child-chk" /> # </th>
                    <th> From </th>
                    <th> To </th>
                    <th>Voucher Type</th>
                    <th>Other Voucher No.</th>
                    <th>Voucher No.</th>
                    <th>Datetime</th>
                    <th>Paid / Receipt Amount</th>
                    <th>Voucher Amount</th>
                    <th>Created By</th>                    
                    <th>Verified</th>
                    <th>Verify By</th>
                    <th>Deleted</th>
                    <th>Modified By</th>
                    <th>Comments</th>
                    <th style="width : 12%;" data-csv="0"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach ($records as $record): $i++; ?>
                <tr class="odd gradeX center" data-id="<?= $record[$model]['id'] ?>" data-legder_base_voucher_type="<?= $legder_voucher_basic_voucher_list[$record[$model]["legder_voucher_type_id"]] ?>">
                    <td>
                        <label style="cursor: pointer">
                            <?php if (!$record[$model]['is_verified'] && !$record[$model]['is_deleted']) : ?>
                                <input type="checkbox" class="child-chk" value="<?= $record[$model]['id']; ?>" />
                            <?php endif; ?>
                            <?= $i ?>
                        </label>
                    </td>
                    <td><?= $legder_account_list[$record[$model]['from_legder_account_id']]; ?></td>
                    <td><?= $legder_account_list[$record[$model]['to_legder_account_id']]; ?></td>
                    <td><?= $legder_voucher_list[$record[$model]['legder_voucher_type_id']]; ?></td>
                    <td><?= $record[$model]['party_voucher_no']; ?></td>
                    <td class="voucher_no"><?= $record[$model]['voucher_no']; ?></td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td class="amount"><?= round($record[$model]['amount'], ROUND_DIGIT); ?></td>
                    <td><?= round($record[$model]['expect_amount'], ROUND_DIGIT); ?></td>
                    <td><?= $user_list[$record[$model]['created_by']]; ?></td>
                    <td class="verify-block">
                        <?php if ($record[$model]['is_verified']) : ?>
                            <span class="label label-success">Yes</span>
                        <?php elseif (!$record[$model]['is_deleted']) : ?>
                            <span class="btn btn-default verify">Verify Now</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $record[$model]['verify_by'] ? $user_list[$record[$model]['verify_by']] : "-"; ?></td>
                    <td class="delete-block">
                        <?php if ($record[$model]['is_deleted']) : ?>
                            <span class="label label-danger">Yes</span>
                        <?php elseif (!$record[$model]['is_verified']) : ?>
                            <span class="btn btn-default delete">Delete Now</span>
                        <?php endif; ?>
                    </td>
                    <td><?= $user_list[$record[$model]['modified_by']]; ?></td>
                    <td><?= $record[$model]['comments']; ?></td>
                    <td>
                        <?php if ($record[$model]['image']): ?>
                            <a href="/<?= $record[$model]['image'] ?>" class="fancybox">View Voucher</a>
                        <?php endif; ?>
                            
                        <?php
                        $key = $record[$model]['id'] . "-" .$record[$model]['legder_voucher_type_id'];
                        $basic_voucher_type = $legder_voucher_basic_voucher_list[$record[$model]["legder_voucher_type_id"]];
                        
                        $arr = array();
                        $url = NULL;
                        if ($basic_voucher_type == VoucherTypes::EXPENSE)
                        {
                            $arr = array($record[$model]['id'], 0);
                        }
                        else if ($basic_voucher_type == VoucherTypes::SALE)
                        {
                            $arr = array(0, $record[$model]['id']);
                        }
                        
                        if ($arr)
                        {
                            $url = $this->Html->url(array_merge(array(
                                "action" => "admin_legder_transaction_expense_sale_detail", 
                            ), $arr));
                        }                        
                        ?>
                            
                        <?php if ($url): ?>
                            <a href="javascript:void(0);" class="css-toggler ajax-loader"  data-toggler-target="tr#record-<?= $key ?>" data-toggler-class="hidden"
                                data-loader-target="tr#record-<?= $key ?> .details" data-loader-href="<?= $url; ?>"
                                >Details</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr id="record-<?= $key ?>" class="hidden" style="background-color: #EEE">
                    <td></td>
                    <td class="details" colspan="14">
                        
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
