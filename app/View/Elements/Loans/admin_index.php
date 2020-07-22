<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> Ledger Account </th>
                    <th> Amount </th>
                    <th> Start Date </th>
                    <th> No. Of Installments </th>
                    <th> No. Of Paid Installments </th>
                    <th> Cancel </th>
                    <th colspan="2" style="width : 25%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $legder_account_list[$record[$model]['legder_account_id']]; ?></td>
                    <td><?= $record[$model]['amount']; ?></td>
                    <td><?= $record[$model]['start_date']; ?></td>
                    <td><?= $record[$model]['no_of_installment']; ?></td>
                    <td><?= $record[$model]['no_of_paid_installment']; ?></td>
                    <td><?= $record[$model]['is_cancel'] ? '<span class="label label-danger">Cancelled</span>' : ''; ?></td>
                    <td>
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                    <td>
                        <?php if (!$record[$model]['is_cancel'] && $record[$model]['no_of_installment'] != $record[$model]['no_of_paid_installment']): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_cancel", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Cancel ?">
                                Cancel Now
                            </a>
                        <?php endif; ?>
                        
                        <?php if (!$record[$model]['is_complete']): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>
                        <?php endif; ?>

                        <?php if (!$record[$model]['can_not_be_delete']): ?>
                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden">
                    <td colspan="5">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th style="width : 10%;"> # </th>
                                    <th> Date </th>
                                    <th> Amount </th>
                                    <th> Paid </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($record['LoanInstallment'] as $a => $arr): ?>
                                <tr>
                                    <td><?= $a + 1 ?></td>
                                    <td><?= DateUtility::getDate($arr['date'], DateUtility::DATE_OUT_FORMAT) ?></td>
                                    <td><?= $arr['amount'] ?></td>
                                    <td><?= $arr['legder_transaction_id'] ? "Yes" : "No" ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td colspan="3">
                        <?php if ($record[$model]['file1']): ?>
                        <p>
                            Attachment 1 : 
                            <a href="<?= FileUtility::get($record[$model]['file1']); ?>" download>
                                <?= pathinfo($record[$model]['file1'], PATHINFO_FILENAME) ?>
                            </a>
                        </p>
                        <?php endif; ?>
                        
                        <?php if ($record[$model]['file2']): ?>
                        <p>
                            Attachment 2 : 
                            <a href="<?= FileUtility::get($record[$model]['file2']); ?>" download>
                                <?= pathinfo($record[$model]['file2'], PATHINFO_FILENAME) ?>
                            </a>
                        </p>
                        <?php endif; ?>
                        
                        <p>
                           Comments : <?= $record[$model]['comments'] ?>
                        </p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
