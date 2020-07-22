<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 6%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 15%;"> Location </th>
                    <th> Shipment No. </th>
                    <th> Party Shipment No. </th>
                    <th> <?= $this->Paginator->sort('dispatch_deadline', __('Dispatch Deadline ')); ?></th>                    
                    <th> <?= $this->Paginator->sort('delivery_date', __('Delivery Date Time ')); ?> </th>                                        
                    <th> <?= $this->Paginator->sort('is_approved', __('Is Approve')); ?>  </th>
                    <th> Inventory Completed </th>
                    <th style="width : 10%;"> Amounts </th>
                    <th> Created On </th>
                    <th> Created By </th>
                    <th style="width : 15%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>
                        Party : <b><?= $record[$model]['party_name'] ?></b> <br/>
                        Location : <b><?= $record[$model]['location_name'] ?></b> <br/>                        
                    </td>
                    <td><?= $record[$model]['shipment_no']; ?></td>
                    <td><?= $record[$model]['party_shipment_no']; ?></td>
                    <td><?= $record[$model]['dispatch_deadline']; ?></td>
                    <td><?= $record[$model]['delivery_date']; ?></td>                    
                    <td>
                        <?php 
                        if ($record[$model]['is_approved'])
                        {
                            ?>
                                <span class="label label-success">Approved</span>
                            <?php
                        }
                        else if ( $record[$model]['is_completed'])
                        {
                            ?>                                
                                <?php $url = $this->Html->url(array("action" => "admin_approve", $record[$model]['id'])); ?>
                                <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Cancel ?">
                                    Approve Now
                                </a>
                            <?php
                        }                        
                        ?>
                    </td>
                    <td>
                        <?php if ($record["Inventory"]["is_verified"]): ?>
                            <span class="label label-success">Yes</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        Total Amount : <b><?= round($record[$model]['total_receive_able_amount'], 1) ?></b> <br/>
                        Receive Amount : <b><?= round($record[$model]['receive_amount'], 1) ?></b> <br/>     
                    </td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td><?= isset($user_list[$record[$model]['created_by']]) ? $user_list[$record[$model]['created_by']] : "-"; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>
                        <br/>
                        
                        <?php if ($record[$model]['is_canceled']): ?>
                            <span class="label label-danger">Canceled</span>
                        <?php else: ?>
                            <?php $url = $this->Html->url(array("action" => "admin_cancel", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Cancel ?">
                                Cancel Now
                            </a>
                        <?php endif; ?>
                        <br/>        
                                
                        <?php $url = $this->Html->url(array("action" => "admin_receipts", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            Receipts & Payments
                        </a>
                        <br/>
                        
                        <?php if (!$record[$model]['is_canceled']) : ?>
                            <br/>
                            
                            <?php if ($record["Inventory"]["id"]): ?>
                                <?php $url = $this->Html->url(array("action" => "admin_pdf", $record[$model]['id'])); ?>
                                <a href="<?= $url; ?>" title="PDF" class="summary-link">
                                    <i class="fa fa-file-pdf-o"></i> PDF
                                </a>
                                <br/>
                            
                                <div class="dropdown">
                                    <button class="btn blue dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> 
                                        <?= $record["Inventory"]["invoice_no"] ?>
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <?= $this->Html->link("Edit", array("controller" => "Inventories", "action" => "admin_scanable_purchase_order_outgoing_edit", $record["Inventory"]['id'], "verification")); ?>
                                        </li>
                                        <li>
                                            <?= $this->Html->link("View", array("controller" => "Inventories", "action" => "admin_view", $record["Inventory"]['id'])); ?>
                                        </li>                                    
                                    </ul>
                                </div>
                            <?php elseif ($record[$model]['is_approved']) : ?>
                                <div class="dropdown">
                                    <button class="btn blue dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"> 
                                        Create Invoice
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <?= $this->Html->link("Scanable", array("controller" => "Inventories", "action" => "admin_scanable_purchase_order_outgoing_add", $record[$model]['id'])); ?>
                                        </li>
                                        <li>
                                            <?= $this->Html->link("Non-Scanable", array("controller" => "Inventories", "action" => "admin_non_scanable_purchase_order_outgoing_add", $record[$model]['id'])); ?>
                                        </li>                                    
                                    </ul>
                                </div>
                            <?php endif; ?>
                                
                            
                            <?php if (isset($record["GatePass"]["id"])): ?>
                                <br/>
                                <a target="_blank" href="<?= $this->Html->url(array("controller" => "GatePasses", "action" => "admin_index", "gate_pass_no" => $record["GatePass"]["gate_pass_no"] )); ?>">
                                    <?= $record["GatePass"]["gate_pass_no"]; ?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr id="tr-<?= $record[$model]["id"]; ?>" class="hidden">
                    <td colspan="8">            
                        <span class="btn blue js-export-csv" data-js-export-csv-table="table#purchase_detail-<?= $record[$model]['id'] ?>" data-js-export-csv-filename="Purchase-Detail-purchase_detail-<?= $record[$model]['shipment_no'] ?>">Export CSV</span>
                        <table id="purchase_detail-<?= $record[$model]['id'] ?>" class="table table-striped table-bordered order-column sub-table sr-databtable">
                            <thead>
                                <tr>
                                    <th style="width : 8%;" data-search-clear="1"> # </th>
                                    <th data-search="1" data-sort="alpha"> Product </th>
                                    <th > Photo </th>
                                    <th data-sort="numeric"> Sale Price </th>
                                    <th> UOM </th>
                                    <th data-sort="numeric"> GST(%) </th>
                                    <th data-sort="numeric"> Purchase Qty </th>
                                    <th data-sort="numeric"> Total Amt </th>
                                    <th data-sort="numeric"> Cost Price </th>
                                    <th data-sort="numeric"> Margin Per Unit </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($record["PurchaseOrderDetail"] as $detail): $i++ ?>
                                <tr class="center">
                                    <td><?= $i ?></td>
                                    <td><?= $detail["sku"]; ?></td>
                                    <td>
                                        <a class="fancybox" href="<?= FileUtility::get($detail["image"]); ?>">
                                            <img class="small-img" src="<?= FileUtility::get($detail["thumbnail"]); ?>" />
                                        </a>
                                    </td>
                                            
                                    <td><?= $detail["price"] ?></td>
                                    <td><?= isset($uom_list[$detail["uom_id"]]) ? $uom_list[$detail["uom_id"]] : "-" ?></td>
                                    <td><?= $detail["gst_per"] ?></td>
                                    <td><?= $detail["qty"] ?></td>
                                    <td><?= $detail["gst_taxable_amt"] ?></td>
                                    <td><?= $detail["cost_price"] ?></td>                                    
                                    <td><?= $detail["margin_per_unit"] ?></td>                                    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    
                    <td colspan="4">
                        City : <b><?= $record[$model]['city_name'] ?></b> <br/>
                        State : <b><?= $record[$model]['state_name'] ?></b> <br/>
                        Address : <b><?= $record[$model]['location_address'] ?></b> <br/>
                        Pincode : <b><?= $record[$model]['location_pincode'] ?></b> <br/>
                        Mobile : <b><?= $record[$model]['location_mobile'] ?></b>
                        
                        <hr>
                        
                        <b>Mode Of Payment </b> : <?= if_exist(PurchaseOrder::PAYMENT_MODE_LIST, $record[$model]["mode_of_payment"]); ?>
                        <br/>
                        <b>Freight Charges</b> : <?= $record[$model]["freight_charges"]; ?>
                        <br/>
                        <b>Freight Charges GST (%)</b> : <?= $record[$model]["freight_gst_per"]; ?>
                        <br/>
                        <?php $fc_gst = $record[$model]["freight_charges"] * $record[$model]["freight_gst_per"] / 100; ?>
                        <b>Freight Charges Total</b> : <?= $record[$model]["freight_charges"] + $fc_gst; ?>
                        <br/>
                        <br/>
                        
                        <b>Other Charges</b> : <?= $record[$model]["other_charges"]; ?>
                        <br/>
                        <b>Other Charges Reason </b> : <?= $record[$model]["other_charge_reason"]; ?>
                        <br/>
                        <br/>
                        
                        <b>Comments</b> : <?= $record[$model]["comments"]; ?>
                        <br/>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>