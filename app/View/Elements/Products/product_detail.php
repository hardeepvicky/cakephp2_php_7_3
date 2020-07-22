<div class="row">
    <div class="col-md-5 col-sm-6 col-xs-12">
        <h3 class="section">            
            Cost Prices
            <a class="btn btn-default" target='_blank' href="<?= $this->Html->url(array("controller" => "ProductCostPrices", "action" => "add", "admin" => true, $product_id)); ?>">
                Add Price
            </a>
        </h3>

        <table class="table table-striped table-bordered order-column sub-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Price</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($cost_prices as $record): 
                    $record = $record["ProductCostPrice"];
            ?>
                <tr class="center">
                    <td><?= DateUtility::getDate($record['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                    <td>&#8360 <?= $record['price'] ?></td>
                    <td><?= isset($user_list[$record['created_by']]) ? $user_list[$record['created_by']] : "-" ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3 class="section">            
            Cost Third Party Prices
            <a class="btn btn-default" target='_blank' href="<?= $this->Html->url(array("controller" => "ProductCostThirdPartyPrices", "action" => "add", "admin" => true, $product_id)); ?>">
                Add Price
            </a>
        </h3>

        <table class="table table-striped table-bordered order-column sub-table">
            <thead>
                <tr>
                    <th>Party</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($cost_party_prices as $record): 
                    $record = $record["ProductCostThirdPartyPrice"];
            ?>
                <tr class="center">
                    <td><?= isset($party_list[$record["party_id"]]) ? $party_list[$record["party_id"]] : "-" ?></td>
                    <td><?= DateUtility::getDate($record['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                    <td>&#8360 <?= $record['price'] ?></td>
                    <td><?= isset($user_list[$record['created_by']]) ? $user_list[$record['created_by']] : "-" ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3 class="section">            
            Sale Prices
            <a class="btn btn-default" target='_blank' href="<?= $this->Html->url(array("controller" => "ProductSalePrices", "action" => "add", "admin" => true, $product_id)); ?>">
                Add Price
            </a>
        </h3>

        <table class="table table-striped table-bordered order-column sub-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Price</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($sale_prices as $record):
                    $record = $record["ProductSalePrice"];
                ?>
                <tr class="center">
                    <td><?= DateUtility::getDate($record['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                    <td>&#8360 <?= $record['price'] ?></td>
                    <td><?= isset($user_list[$record['created_by']]) ? $user_list[$record['created_by']] : "-" ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3 class="section">            
            Sale Third Party Prices
            <a class="btn btn-default" target='_blank' href="<?= $this->Html->url(array("controller" => "ProductSaleThirdPartyPrices", "action" => "add", "admin" => true, $product_id)); ?>">
                Add Price
            </a>
        </h3>

        <table class="table table-striped table-bordered order-column sub-table">
            <thead>
                <tr>
                    <th>Party</th>
                    <th>Date</th>
                    <th>Price</th>
                    <th>By</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($sale_party_prices as $record): 
                    $record = $record["ProductSaleThirdPartyPrice"];
            ?>
                <tr class="center">
                    <td><?= isset($party_list[$record["party_id"]]) ? $party_list[$record["party_id"]] : "-" ?></td>
                    <td><?= DateUtility::getDate($record['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                    <td>&#8360 <?= $record['price'] ?></td>
                    <td><?= isset($user_list[$record['created_by']]) ? $user_list[$record['created_by']] : "-" ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3 class="section">            
            MRP Prices
            <a class="btn btn-default" target='_blank' href="<?= $this->Html->url(array("controller" => "Products", "action" => "add_mrp_price", "admin" => true, $product_id)); ?>">
                Add Price
            </a>
        </h3>
        <table class="table table-striped table-bordered order-column sub-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($mrp_prices as $record): 
                    $record = $record["ProductMrpPrice"];
            ?>
                <tr>
                    <td><?= DateUtility::getDate($record['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                    <td>&#8360 <?= $record['price'] ?></td>
                    <td><?= isset($user_list[$record['created_by']]) ? $user_list[$record['created_by']] : "-" ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <h3 class="section">
            Operations
        </h3>

        <table class="table table-striped table-bordered order-column sub-table">
            <thead>
                <tr>
                    <th>Operation</th>
                    <th>Time in Mintues</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                foreach($product_operations as $product_operation): 
            ?>
                <tr>
                    <td style="width: 30%"><?= $product_operation["ProductOperation"]['name'] ?></td>
                    <td class="text-center"><?= $product_operation["ProductOperation"]['time_in_mintues'] ?></td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#operation-<?= $product_operation["ProductOperation"]['id'] ?>" data-toggler-class="hidden">Rates</a>
                    </td>
                </tr>
                <tr id="operation-<?= $product_operation["ProductOperation"]['id'] ?>" class="hidden">
                    <td colspan="3">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($product_operation['ProductOperationRate'] as $operation_rate): ?>
                                    <tr class="center">
                                        <td><?= DateUtility::getDate($operation_rate['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                                        <td>&#8360 <?= $operation_rate['rate'] ?></td>
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
    <div class="col-md-4 col-sm-6 col-xs-12">
        <h3 class="section">Product Attributes</h3>
        <?php 
            $field_list = ProductAttrTypes::getFieldList();
            
            foreach($category_product_field_list as $type): 
        ?>
            <label class="control-label"><b><?= ProductAttrTypes::$list[$type] ?></b> : 
                <?php 
                if(isset($type_list[$product[$field_list[$type]]]))
                {
                    echo $type_list[$product[$field_list[$type]]];
                }
                else
                {
                    echo $product[$field_list[$type]];
                }
                ?>
            </label>
            <br/>
        <?php endforeach; ?>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3 class="section">Old Codes</h3>
        <table class="table table-striped table-bordered order-column sub-table">
            <tbody>
                <?php foreach($old_sku_list as $id => $sku): ?>
                <tr>
                    <td><?= $sku ?></td>
                    <td>
                        <a class="delete-old-sku-code" href="<?= $this->Html->url(array("action" => "ajaxDeleteOldSkuCode", "admin" => false, $id)) ?>">
                            Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>