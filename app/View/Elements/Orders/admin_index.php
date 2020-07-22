<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 20%;"> Party Location </th>
                    <th><?php echo $this->Paginator->sort('order_no',  'Order No.'); ?></th>
                    <th><?php echo $this->Paginator->sort('purchase_date',  'Purchase Date'); ?></th>
                    <th><?php echo $this->Paginator->sort('order_status',  'Status'); ?></th>
                    <th><?php echo $this->Paginator->sort('import_log_id',  'Last Import Log Id'); ?></th>
                    <th><?php echo $this->Paginator->sort('import_log_id',  'Last Api Log Id'); ?></th>
                    <th>Last Update</th>
                    <th style="width : 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $record[$model]['id']; ?></td>
                    <td class="text-center"><?= isset($party_location_list[$record[$model]['party_location_id']]) ? $party_location_list[$record[$model]['party_location_id']] : "-"; ?></td>
                    <td class="text-center"><?= $record[$model]['order_id']; ?></td>          
                    <td class="text-center"><?php echo DateUtility::getDate($record[$model]['purchase_date'], "d-M-Y h:i:s"); ?></td>
                    <td class="text-center"><?= $record[$model]['order_status']; ?></td>
                    <td class="text-center"><?= $record[$model]['import_log_id']; ?></td>
                    <td class="text-center"><?= $record[$model]['api_log_id']; ?></td>
                    <td class="text-center"><?= DateUtility::getDate($record[$model]['modified'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td class="text-center">
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
                </tr>
                <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="7" style="background-color:#EEF2F5; text-align: left;">
                        <?php if ($record[$model]['error_log']): ?>
                        <div class="note note-danger">
                            <h4 class="block">Some Details are not saved due to following reason</h4>
                            <p> <?= $record[$model]['error_log']; ?> </p>
                        </div>
                        <?php endif; ?>
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr>                                    
                                    <th>Sub Order ID</th>
                                    <th>CSV Sku</th>
                                    <th>Product</th>                                    
                                    <th>Map Sku</th>
                                    <th>Qty</th>
                                    <th>Dispatch</th>
                                    <th>Ship</th>
                                    <th>Deliver</th>
                                    <th>Cancel</th>
                                    <th>Return</th>
                                    <th>Status</th>
                                    
                                    <th>Return Type</th>
                                    <th>Return Recieved</th>
                                    <th>Return Recieved Date</th>
                                    <th>Return Item</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($record['OrderDetail'] as $arr):  ?>
                                <tr class="center">
                                    <td><?= $arr['sub_order_id'] ?></td>
                                    <td><?= $arr['sku'] ?></td>
                                    <td><?= isset($product_list[$arr['product_id']]) ? $product_list[$arr['product_id']] : "-"  ?></td>
                                    <td><?= isset($party_sku_list[$arr['party_map_sku_id']]) ? $party_sku_list[$arr['party_map_sku_id']] : "-"  ?></td>
                                    <td><?= $arr['qty'] ?></td>
                                    <td><?= $arr['is_dispatch'] ? '<span class="label label-success">Yes</span>' : "" ?></td>
                                    <td><?= $arr['is_ship'] ? '<span class="label label-success">Yes</span>' : "" ?></td>
                                    <td><?= $arr['is_delivered'] ? DateUtility::getDate($arr["deliver_date"], DateUtility::DATETIME_OUT_FORMAT) : "" ?></td>
                                    <td><?= $arr['is_cancel'] ? '<span class="label label-success">Yes</span>' : "" ?></td>
                                    <td><?= $arr['is_return'] ? '<span class="label label-success">Yes</span>' : "" ?></td>
                                    <td><?= $arr['item_status'] ?></td>
                                    
                                    <td><?= isset(OrderDetail::$return_list[$arr['return_type']]) ? OrderDetail::$return_list[$arr['return_type']] : "-"  ?></td>
                                    <td><?= $arr['is_return_receive'] ? '<span class="label label-success">Yes</span>' : "" ?></td>
                                    <td><?= $arr['is_return_receive'] ? DateUtility::getDate($arr["return_recieve_date"], DateUtility::DATE_OUT_FORMAT) : "" ?></td>
                                    <td>
                                        <?php 
                                        if (isset($arr['BatchBundleSerialCode']["id"]) && $arr['BatchBundleSerialCode']["id"])
                                        {
                                           echo "Code : " . $arr['BatchBundleSerialCode']["code"] . "<br/>";
                                           echo "Status : " . StaticArray::$inventory_all_serial_code_status[$arr["bbsc_status"]]; 
                                        }
                                        ?>
                                    </td>
                                    
                                    <td class="text-center">
                                        <?php $url = $this->Html->url(array("action" => "admin_order_item_detail", $arr['id'])); ?>
                                        <a href="javascript:void(0);" class="css-toggler ajax-loader" data-toggler-class="hidden" data-toggler-target="tr#order-detail-<?= $arr['id']; ?>"
                                           data-loader-target="tr#order-detail-<?= $arr['id']; ?> .order-detail" data-loader-href="<?= $url; ?>"
                                           >
                                            Details
                                        </a>
                                    </td>
                                </tr>
                                <tr id="order-detail-<?= $arr['id']; ?>" class="hidden">
                                    <td colspan="14">   
                                        <div class="order-detail">
                                            
                                        </div>
                                    </td>
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