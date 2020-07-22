<section class="section-head">
    <h3>
        <div class="row">
            <div class="col-md-6">Inventory Details</div>
            <div class="col-md-6">
                <div style="text-align: right; font-size: 18px;">
                    <label class="label label-info">
                        Total Amount : &#8360 <span id="inventory-total-amt" style="color : #FFF;">0</span> 
                    </label>
                </div>
            </div>
        </div>
    </h3>
</section>

<div class="table__structure">
    <div class="table-responsive">
        <table id="inventory" class="table table-striped table-bordered order-column">
        <thead>
            <tr class="center">
                <th style="width: 8%">#</th>
                <th>Sku</th>
                <th>GST (%)</th>
                <th>Rate</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Taxable Amount</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->request->data['InventoryDetail'] as $i => $inv_detail): ?>
            <tr class="inventory center product-<?= $inv_detail['product_id'] ?>" data-product_id="<?= $inv_detail['product_id'] ?>" data-out_uom_id="<?= $inv_detail['out_uom_id'] ?>" data-inventory_detail_id="<?= $inv_detail["id"] ?>">
                <td><?= ($i + 1) ?></td>
                <td class="product-name"><?= $sku_list[$inv_detail['product_id']] ?></td>
                <td>
                    <span class="inventory-gst_per"><?= $inv_detail['gst_per'];?></span> 
                    <a href='javascript:void(0);' class='change_gst_per'>Change GST</a>
                    <input type="hidden" class="inventory-gst_per" value="<?= $inv_detail['gst_per'];?>"/>
                </td>
                <td>
                    <span class="inventory-rate">&#8360 <?= $inv_detail['uom_rate']; ?></span> 
                    <a href='javascript:void(0);' class='change_price'>Change Price</a>
                    <a href="javascript:void(0);" class="show-price-list">Show Prices</a>
                    <input type="hidden" class="inventory-rate" value="<?= $inv_detail['rate']; ?>" />                    
                </td>
                <td>
                    <span class="inventory-qty"><?= $inv_detail['uom_qty'] ?></span>
                    <input type="hidden" class="inventory-qty" value="<?= $inv_detail['qty']; ?>" />
                </td>
                <td>
                    <span class="out-uom-name"><?= $uom_list[$inv_detail['out_uom_id']] ?></span>
                </td>
                <td>
                    <span class="inventory-amt"><?= $inv_detail['amt'] ?></span>
                </td>
                <td>
                    <span class="inventory-amt_gst"><?= $inv_detail['amt_gst'] ?></span>
                </td>
            </tr>                    
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<script id="product-template" type="text/x-handlebars-template">
  <tr class="inventory center product-{{product_id}}" data-product_id="{{product_id}}" data-out_uom_id="{{uom_id}}" data-inventory_detail_id="{{inventory_detail_id}}">
    <td>{{i}}</td>
    <td class="product-name">{{sku}}</td>
    <td>
        <span class="inventory-gst_per">{{gst_per}}</span> 
        <a href='javascript:void(0);' class='change_gst_per'>Change GST</a>
        <input type="hidden" class="inventory-gst_per" value="{{gst_per}}"/>
    </td>
    <td>
        <span class="inventory-rate">&#8360 {{uom_rate}}</span> 
        <a href='javascript:void(0);' class='change_price'>Change Price</a>
        <a href="javascript:void(0);" class="show-price-list">Show Prices</a>
        <input type="hidden" class="inventory-rate" value="{{rate}}"/>
    </td>
    <td>
        <span class="inventory-qty">{{uom_qty}}</span>
        <input type="hidden" class="inventory-qty" value="{{qty}}"/>
    </td>
    <td>
        <span class="out-uom-name">{{uom_name}}</span>
    </td>
    <td>
        <span class="inventory-amt">0</span>
    </td>
    <td>
        <span class="inventory-amt_gst">0</span>
    </td>
  </tr>  
</script>


<script type="text/javascript">
    var party_list = JSON.parse('<?= json_encode($party_list) ?>');
    
    function update_inventory_total_amt()
    {
        var total_amt = 0;
        
        $("tr.inventory").each(function()
        {
            total_amt += parseFloat($(this).find("span.inventory-amt_gst").text());
        });
        
        $("span#inventory-total-amt").html(total_amt);
    }
    
    function update_inventory_detail_amt(tr)
    {
        var gst_per = parseFloat(tr.find("input.inventory-gst_per").val());
        var rate = parseFloat(tr.find("input.inventory-rate").val());
        var qty = parseFloat(tr.find("input.inventory-qty").val());
        
        var amt = rate * qty;
        tr.find("span.inventory-amt").html(amt.toFixed(2));
        var gst = amt * gst_per / 100;
        amt = amt + gst;
        tr.find("span.inventory-amt_gst").html(amt.toFixed(2));
        
        update_inventory_total_amt();
    }
    
    $(document).on("click", "a.change_gst_per", function()
    {
        var tr = $(this).parents("tr.inventory");
        var inventory_detail_id = tr.attr("data-inventory_detail_id");
        var date = '<?= date(DateUtility::DATE_OUT_FORMAT) ?>';

        if (!inventory_detail_id)
        {
            bootbox.alert("Inventory Detail Id not found");
            return;
        }

        var price_post_data = { 
            product_id : tr.attr("data-product_id"), 
            product_name : tr.find(".product-name").html(),
            date : date,
            uom_id : tr.attr("data-out_uom_id")
        };

        check_inventory_before_any_operation(function()
        {
            change_product_gst(inventory_detail_id, price_post_data, function(data)
            {
                tr.find("span.inventory-gst_per").html(data["gst_per"]);
                tr.find("input.inventory-gst_per").val(data["gst_per"]);
                update_inventory_detail_amt(tr);
            });
        });

        return false;
    });
    
    $(document).on("click", "a.change_price", function()
    {
        var tr = $(this).parents("tr.inventory");
        var inventory_detail_id = tr.attr("data-inventory_detail_id");
        var date = '<?= date(DateUtility::DATE_OUT_FORMAT) ?>';

        var price_post_data = {
            product_id : tr.attr("data-product_id"),
            product_name : tr.find(".product-name").html(),
            uom_id : tr.attr("data-out_uom_id"),
            date : date
        }

        var on_price_change_event = function(data)
        {
            tr.find("span.inventory-rate").html("&#8360 " + data["actual_rate"]);
            tr.find("input.inventory-rate").val(data["rate"]);
            update_inventory_detail_amt(tr);
        };

        check_inventory_before_any_operation(function()
        {
            if (!another_location["is_company_location"] && another_location["have_party"])
            {
                price_post_data["party_id"] = another_location["party_id"];
                price_post_data["party_name"] = party_list[another_location["party_id"]];

                if (inventory_type == 1)
                {
                    change_product_party_cost_price(inventory_detail_id, price_post_data, on_price_change_event);
                }
                else
                {
                    change_product_party_sale_price(inventory_detail_id, price_post_data, on_price_change_event);
                }
            }
            else
            {
                if (inventory_type == 1)
                {
                    change_product_cost_price(inventory_detail_id, price_post_data, on_price_change_event);
                }
                else
                {
                    change_product_sale_price(inventory_detail_id, price_post_data, on_price_change_event);
                }
            }
        });

        return false;
    });
    
    $(document).on("click", "a.show-price-list", function()
    {
        var tr = $(this).parents("tr.inventory");
        
        var price_post_data = {
            product_id : tr.attr("data-product_id"),
            product_name : tr.find(".product-name").html(),
            uom_id : tr.attr("data-out_uom_id")
        };

        if (another_location["have_party"])
        {
            price_post_data["party_id"] = another_location["party_id"];
            price_post_data["party_name"] = party_list[another_location["party_id"]];
            
            if (inventory_type == 1)
            {
                show_product_party_cost_price(price_post_data);
            }
            else
            {
                show_product_party_sale_price(price_post_data);
            }
        }
        else
        {
            if (inventory_type == 1)
            {
                show_product_cost_price(price_post_data);
            }
            else
            {
                show_product_sale_price(price_post_data);
            }
        }
    });
    
    $(document).ready(function()
    {
        update_inventory_total_amt();
    });
</script>