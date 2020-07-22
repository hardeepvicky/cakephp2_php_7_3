<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> Location </th>
                    <th> Supplier </th>
                    <th> Demand Order No. </th>
                    <th> Order Date Time </th>
                    <th> Comment </th>
                    <th> Invoice No. </th>
                    <th style="width : 20%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= isset($location_list[$record[$model]['location_id']]) ? $location_list[$record[$model]['location_id']] : "-"; ?></td>
                    <td><?= isset($legder_account_list[$record[$model]['supplier_legder_account_id']]) ? $legder_account_list[$record[$model]['supplier_legder_account_id']] : "-"; ?></td>
                    <td><?= $record[$model]['demand_order_no']; ?></td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td><?= $record[$model]['comments']; ?></td>
                    <td>
                        <?php 
                        if ( $record[$model]['is_inventory_completed'] )
                        {
                            ?>
                                <span class="label label-success">Received</span>
                            <?php
                        }
                        else if ( $record[$model]['is_force_receive'] )
                        {
                            ?>
                            <span class="btn btn-default order-receive" data-toggle="modal" data-target="#modal-order-receive" data-id="<?= $record[$model]["id"] ?>" data-comment="<?= $record[$model]["comments"] ?>">Mark Received</span>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_pdf", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="PDF" class="summary-link">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                        
                        <?php if (!$record[$model]['is_inventory_completed']) : ?>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr id="tr-<?= $record[$model]["id"]; ?>" class="hidden">
                    <td></td>
                    <td colspan="7">
                        <table class="table table-striped table-bordered order-column sub-table sr-databtable">
                            <thead>
                                <tr>
                                    <th style="width : 8%;" data-search-clear="1"> # </th>
                                    <th data-search="1" data-sort="alpha"> Product </th>
                                    <th data-sort="numeric"> Price </th>
                                    <th data-sort="numeric"> GST(%) </th>
                                    <th data-sort="numeric"> Demand Qty </th>
                                    <th data-sort="numeric"> Total Amt </th>
                                    <th data-sort="numeric"> Receive Qty </th>
                                    <th> UOM </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($record["ViewDemandOrderDetail"] as $detail): $i++ ?>
                                <tr class="center">
                                    <td><?= $i ?></td>
                                    <td><?= isset($sku_list[$detail["product_id"]]) ? $sku_list[$detail["product_id"]] : "-" ?></td>
                                    <td><?= $detail["price"] ?></td>
                                    <td><?= $detail["gst_per"] ?></td>
                                    <td><?= $detail["qty"] ?></td>
                                    <td><?= $detail["total_amt"] ?></td>
                                    <td><?= $detail["receive_qty"] ?></td>
                                    <td><?= isset($uom_list[$detail["uom_id"]]) ? $uom_list[$detail["uom_id"]] : "-" ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>