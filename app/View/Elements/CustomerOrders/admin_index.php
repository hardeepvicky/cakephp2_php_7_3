<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> # </th>
                    <th> Order No. </th>
                    <th> Customer </th>
                    <th> Product </th>
                    <th> <?= $this->Paginator->sort('order_date', __('Order Date Time')); ?> </th>
                    <th> Qty & Price </th>
                    <th> Payment Method </th>
                    <th> Status </th>
                    <th style="width : 10%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record):
                        $record[$model]['price'] = $record[$model]['price'] - round($record[$model]['price'] * $record[$model]['discount_per'] / 100, ROUND_DIGIT);
                    ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['order_no']; ?></td>
                    <td><?= isset($customer_list[$record[$model]['customer_id']]) ? $customer_list[$record[$model]['customer_id']] : "-"; ?></td>
                    <td><?= isset($product_list[$record[$model]['product_id']]) ? $product_list[$record[$model]['product_id']] : "-"; ?></td>
                    <td><?= DateUtility::getDate($record[$model]['order_date'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td>
                        <?= $record[$model]['qty']; ?> X <?= $record[$model]['price']; ?> = <?= CURRENCY_SYMBOL ?> <?= $record[$model]['qty'] * $record[$model]['price']; ?>
                    </td>
                    <td><?= isset(StaticArray::$payment_method_types[$record[$model]['payment_method']]) ? StaticArray::$payment_method_types[$record[$model]['payment_method']] : "-"; ?></td>
                    <td>
                        <?php if ($record[$model]['is_paid']): ?>
                        <div style="margin-bottom: 10px;">
                            <span class="label label-default">Paid</span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($record[$model]['is_ship']): ?>
                        <div style="margin-bottom: 10px;">
                            <span class="label label-info">Shipped</span>
                        </div>
                        <?php endif; ?>
                            
                        <?php if ($record[$model]['is_deliver']): ?>
                        <div style="margin-bottom: 10px;">
                            <span class="label label-success">Deliver on <?= DateUtility::getDate($record[$model]['deliver_date'], DateUtility::DATE_OUT_FORMAT); ?></span>
                        </div>
                        <?php endif; ?>
                            
                        <?php if ($record[$model]['is_cancel']): ?>
                        <div style="margin-bottom: 10px;">
                            <span class="label label-warning">Canceled</span>
                        </div>
                        <?php endif; ?>
                            
                        <?php if ($record[$model]['is_return']): ?>
                        <div style="margin-bottom: 10px;">
                            <span class="label label-danger">Return</span>
                        </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr id="tr-<?= $record[$model]["id"]; ?>" class="hidden">
                    <td></td>
                    <td colspan="5">
                        <h3>Shipping Address</h3>
                        <?= $record["CustomerAddress"]["contact_person_name"] ?>, M : <?= $record["CustomerAddress"]["contact_no"] ?><br/>
                        <?= $record["CustomerAddress"]["address"] ?><br/>
                        <?= $record["CustomerAddress"]["address2"] ?><br/>
                        <?= $record["City"]["name"] ?>-<?= $record["CustomerAddress"]["pincode"] ?>, <?= $record["State"]["name"] ?>    
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>