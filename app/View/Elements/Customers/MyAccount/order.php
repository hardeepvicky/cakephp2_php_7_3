<style>
    .order-detail
    {
        border-bottom: 1px solid #000;
    }
    
    .main-img
    {
        width : 170px;
        object-fit: contain;
    }
    
    .items-container
    {
        border: 1px solid #ccc;
        margin: 5px 0;
    }
    
    .table-shopping-cart td{
        padding : 5px;
    }
    
    .table-shopping-cart tr:nth-child(even){
        background-color: #EEE;
    }
    
    .main-table > tbody > tr:nth-child(even){
        background-color: #E1E5EC;
    }
    
    .review-text{
        font-size: 12px;
        text-align: center;
    }
</style>
<div class="container m-t-15 m-b-15">
    <h1 class="m-b-20 row">
        <div class="col-md-9 col-sm-12">
            Order History
        </div>
    </h1>
    <table class="table-shopping-cart main-table">
        <thead>
            <tr class="table_head">
                <td class="column-1">#</td>
                <td class="column-1">Shipping Address</td>
                <td class="column-1">Order Date Time</td>
                <td class="column-1">Payment</td>
                <td>Items</td>
            </tr>
        </thead>
        <tbody>
            <?php $j = 0; foreach($orders as $order_id => $order): $j++; $first_order = reset($order);  ?>
            <tr>
                <td><?= $j ?></td>
                <td>
                    <?= $first_order["CustomerAddress"]["contact_person_name"] ?><br/>
                    M : <?= $first_order["CustomerAddress"]["contact_no"] ?><br/>
                    <?= $first_order["CustomerAddress"]["address"] ?><br/>
                    <?= $first_order["CustomerAddress"]["address2"] ?><br/>
                    <?= $first_order["City"]["name"] ?>-<?= $first_order["CustomerAddress"]["pincode"] ?><br/>
                    <?= $first_order["State"]["name"] ?>    
                </td>
                <td><?= DateUtility::getDate($first_order[$model]['order_date'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                <td>
                    <?php if ($first_order[$model]["is_paid"]):  ?>
                        <span class="label label-success">Paid</span>
                    <?php else: ?>
                        <?php if ($first_order[$model]["payment_method"] == PAYMENT_METHOD_ONLINE):  ?>
                            <a href="<?= $this->Html->url(array("controller" => "Customers", "action" => "payment", $order_id)) ?>">Pay Now</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <table class="table-shopping-cart items-container">
                        <thead>
                            <tr class="table_head">
                                <td class="column-1">Product</td>
                                <td class="column-1">Qty & Price</td>
                                <td class="column-1">Status</td>
                                <td class="column-1">Others</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($order as $k => $record):  ?>
                            <tr class="table_row">
                                <td>
                                    <img class="main-img" src="<?= FileUtility::get($record[0]["image"]) ?>" /> <br/><br/>
                                    <?= $record["Product"]["name"] ?>
                                </td>
                                <td>
                                    <?= $record[$model]["qty"] ?> X <?= $record[$model]["price"] ?> = <?= CURRENCY_SYMBOL ?> <?= $record[$model]["qty"] * $record[$model]["price"] ?>
                                </td>                                
                                <td>
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
                                    <?php if ($record[$model]['is_deliver']): ?>
                                    <div style="margin-bottom: 10px; text-align: center;">
                                        <?php if ($record["CustomerOrderProductReview"]["id"]): ?>
                                            <?= $this->element("frontend/rating_star", array(
                                                "id" => "rating-star-" . $record[$model]["id"],
                                                "font_size" => "1.0em",
                                                "event" => false,
                                                "value" => $record["CustomerOrderProductReview"]["rating"]
                                            )); ?>
                                            <p class="review-text">
                                                <?= $record["CustomerOrderProductReview"]["review"] ?>                                                
                                            </p>
                                            
                                            <button class="btn btn-link review-product" data-id="<?= $record[$model]["id"] ?>" >Update Review</button>
                                        <?php else : ?>
                                            <button class="btn btn-link review-product" data-id="<?= $record[$model]["id"] ?>" >Review</button>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
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

<script type="text/javascript">
    $(document).ready(function()
    {
        $(".css-toggler").cssToggler();
        
        ProductReview.onSave = function()
        {
            window.location.reload();
        }
        
        $(".review-product").click(function()
        {
            var id = $(this).data("id");
            
            ProductReview.show(id);
        });
        
    });
</script>