<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th>Party</th>
                    <th>Location</th>
                    <th>Request Qty</th>
                    <th>Found Qty</th>
                    <th>Download File</th>
                    <th>User</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $party_list[$record[$model]['party_id']]; ?></td>
                    <td><?= $location_list[$record[$model]['location_id']]; ?></td>
                    <td><?= $record[$model]['request_qty']; ?></td>
                    <td><?= $record[$model]['qty']; ?></td>
                    <td>
                        <a href="<?= FileUtility::get($record[$model]['pdf_file']); ?>" download>
                            <i class="fa fa-file-pdf"></i>
                            PDF
                        </a>
                        <br/>
                        <a href="<?= FileUtility::get($record[$model]['csv_file']); ?>" download>
                            <i class="fa fa-file-excel-o"></i>
                            CSV
                        </a>
                    </td>
                    <td><?= if_exist($user_list, $record[$model]['created_by']); ?></td>
                    <td>
                        <?php if ($record[$model]['is_cancel']): ?>
                            <label class="label label-info">Cancelled</label>
                        <?php else: ?>
                            <?php $url = $this->Html->url(array("action" => "admin_cancel", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Cancel ?">
                                Cancel
                            </a>
                        <?php endif; ?>
                        
                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                    </td>
                    <td>
                        <div style="display: none">
                            <?php $url = $this->Html->url(array("action" => "ajaxLockedSerialCodes", "admin" => false, $record[$model]['id'])); ?>
                            <a href="javascript:void(0);" class="css-toggler ajax-loader"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden"
                               data-loader-target="tr#record-<?= $record[$model]['id'] ?> .serial-codes" data-loader-href="<?= $url; ?>"
                               >Serial Codes</a>

                            <?php $url = $this->Html->url(array("action" => "ajaxLockedDetails", "admin" => false, $record[$model]['id'])); ?>
                            <a href="javascript:void(0);" class="ajax-loader" data-loader-target="tr#record-<?= $record[$model]['id'] ?> .lock-products" data-loader-href="<?= $url; ?>"
                               >Lock Products</a>
                        </div>
                        
                        <span class="btn btn-link details">Details</span>
                    </td>
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden" style="background-color: #EEE;">
                    <td></td>
                    <td class="serial-codes" colspan="3">
                        
                    </td>
                    <td></td>
                    <td class="lock-products" colspan="5">
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>