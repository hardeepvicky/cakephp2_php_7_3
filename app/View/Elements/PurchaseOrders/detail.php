<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12"></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="mt-checkbox-inline">
                <label class="mt-checkbox mt-checkbox-outline">
                    <?= $this->Form->input('will_customer_pay_freight', array('type' => 'checkbox', 'id' => 'will_customer_pay_freight')); ?> Will Customer Pay Freight
                    <span></span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="form-group freight">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Carier <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('carier_id', [
                "type" => "select",
                "options" => $carirer_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                "class" => "form-control select2me"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group freight">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Estimated Freight Charges <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('freight_charges', [
                "id" => "freight_charges",
                "class" => "form-control validate-float"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group freight">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Freight GST (%) <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('freight_gst_per', [
                "id" => "freight_gst_per",
                "class" => "form-control validate-float"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group freight">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Freight Borne by Customer <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('freight_borne_by_customer', [
                "id" => "freight_borne_by_customer",
                "class" => "form-control validate-float"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Other Charges :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('other_charges', [
                "id" => "other_charges",
                "class" => "form-control validate-float"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Other Charges Reason :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('other_charge_reason', array('type' => 'textarea', 'rows' => 2)); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Discount (%) :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('discount_per', [
                "id" => "discount_per",
                "class" => "form-control validate-float"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-xs-12">
            <table id="product" class="table table-striped table-bordered order-column" data-template-min-row="1">
                <thead>
                    <tr>
                        <th style="width : 5%" class="text-center">
                            <span class="row-adder">
                                <i class="fa fa-plus-circle font-green-meadow icon"></i>
                            </span>
                        </th>
                        <th style="width : 20%">Product</th>
                        <th style="width : 15%">UOM</th>
                        <th style="width : 15%">Sale-Price</th>
                        <th style="width : 8%">Gst(%)</th>
                        <th style="width : 15%">Quantity</th>                        
                        <th style="width : 6%">Product Total</th>
                        <th style="width : 6%">Discount</th>
                        <th style="width : 6%">Freight</th>
                        <th style="width : 6%">Taxable Amount</th>
                        <th style="width : 6%">GST</th>
                        <th style="width : 8%">GST + Amount</th>
                        <th style="width : 6%">Cost Price Per Unit</th>
                        <th style="width : 6%">Freight Charge Per Unit</th>
                        <th style="width : 6%">Other Charge Per Unit</th>
                        <th style="width : 6%">Margin Per Unit</th>
                        <th style="width : 8%">Margin Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hidden template-row">
                        <td class="text-center">
                            <span class="row-deleter">
                                <i class="fa fa-times-circle font-red-sunglo icon"></i>
                            </span>
                            {{i}}
                        </td>
                        <td>
                            <?= $this->Form->input('PurchaseOrderDetail.{{id}}.product_id', array(
                                    "type" => "select",
                                    "options" => $sku_group_list,
                                    "empty" => "Please Select",
                                    "class" => "form-control product_id  required-input",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input('PurchaseOrderDetail.{{id}}.uom_id', array(
                                    "type" => "select",
                                    "class" => "form-control uom_id required-input",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input('PurchaseOrderDetail.{{id}}.price', array(
                                    "class" => "form-control required-input price",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        <td>
                            <?php if ($this->request->data[$model]["is_gst_apply"]) : ?>
                                <span class="gst_per"></span>
                                <br/>
                                <a class="change_gst_per" href='javascript:void(0);'>Change GST</a>
                                <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.gst_per', [
                                    "class" => "gst_per",
                                ]);
                                ?>
                            <?php else: ?>
                                <span>0</span>
                                <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.gst_per', [
                                    "value" => 0
                                ]);
                                ?>
                            <?php endif; ?>
                            
                        </td>
                        <td>
                            <?= $this->Form->input('PurchaseOrderDetail.{{id}}.qty', array(
                                    "class" => "form-control required-input qty",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        
                        <td>
                            <span class="amt"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.amt', ["class" => "amt"]);?>
                        </td>
                        
                        <td>
                            <span class="discount"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.discount', ["class" => "discount"]);?>
                        </td>
                        
                        <td>
                            <span class="freight"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.freight', ["class" => "freight"]);?>
                        </td>
                        
                        <td>
                            <span class="taxable_amt"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.taxable_amt', ["class" => "taxable_amt"]);?>
                        </td>
                        
                        <td>
                            <span class="gst"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.gst', ["class" => "gst"]);?>
                        </td>
                        <td>
                            <span class="gst_taxable_amt"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.gst_taxable_amt', ["class" => "gst_taxable_amt"]);?>
                        </td>
                        <td>
                            <span class="cost_price"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.cost_price', [
                                "class" => "cost_price",
                            ]);
                            ?>
                        </td>
                        <td>
                            <span class="freight_charges"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.freight_charges', ["class" => "freight_charges"]);?>
                        </td>
                        <td>
                            <span class="other_charges"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.other_charges', ["class" => "other_charges"]);?>
                        </td>
                        <td>
                            <span class="margin_per_unit"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.margin_per_unit', ["class" => "margin_per_unit"]);?>
                        </td>
                        <td>
                            <span class="margin_total"></span>
                            <?= $this->Form->hidden('PurchaseOrderDetail.{{id}}.margin_total', ["class" => "margin_total"]);?>
                        </td>
                    </tr>
                    
                    <?php foreach($this->request->data["PurchaseOrderDetail"] as $n => $detail): ?>
                    <tr data-row-id="<?= $n ?>" data-row-i="<?= $n + 1 ?>">
                        <td class="text-center">                            
                            <span class="row-deleter">
                                <i class="fa fa-times-circle font-red-sunglo icon"></i>
                            </span>
                            
                            <?= $n + 1 ?>
                        </td>
                        <td>
                            <span class="product_name"><?= $sku_list[$detail['product_id']] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.product_id", [
                                "class" => "product_id",
                            ]);
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("PurchaseOrderDetail.$n.uom_id", array(
                                    "type" => "select",
                                    "class" => "form-control uom_id select2me",
                                    "data-value" => $detail['uom_id']
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("PurchaseOrderDetail.$n.price", array(
                                    "class" => "form-control required-input price",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        <td>
                            <?php if ($this->request->data[$model]["is_gst_apply"]) : ?>
                                <span class="gst_per"><?= $detail['gst_per'] ?></span>
                                <br/>
                                <a class="change_gst_per" href='javascript:void(0);'>Change GST</a>
                                <?= $this->Form->hidden("PurchaseOrderDetail.$n.gst_per", [
                                    "class" => "gst_per",
                                ]);
                                ?>
                            <?php else : ?>
                                <span>0</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $this->Form->input("PurchaseOrderDetail.$n.qty", array(
                                    "class" => "form-control required-input qty",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        
                       <td>
                            <span class="amt"><?= $detail['amt'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.amt", ["class" => "amt"]);?>
                        </td>
                        
                        <td>
                            <span class="discount"><?= $detail['discount'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.discount", ["class" => "discount"]);?>
                        </td>
                        
                        <td>
                            <span class="freight"><?= $detail['freight'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.freight", ["class" => "freight"]);?>
                        </td>
                        
                        <td>
                            <span class="taxable_amt"><?= $detail['taxable_amt'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.taxable_amt", ["class" => "taxable_amt"]);?>
                        </td>
                        
                        <td>
                            <span class="gst"><?= $detail['gst'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.gst", ["class" => "gst"]);?>
                        </td>
                        <td>
                            <span class="gst_taxable_amt"><?= $detail['gst_taxable_amt'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.gst_taxable_amt", ["class" => "gst_taxable_amt"]);?>
                        </td>
                        
                        <td>
                            <span class="cost_price"><?= $detail['cost_price'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.cost_price", [
                                "class" => "cost_price",
                            ]);
                            ?>
                        </td>
                        <td>
                            <span class="freight_charges"><?= $detail['freight_charges'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.freight_charges", ["class" => "freight_charges"]);?>
                        </td>
                        <td>
                            <span class="other_charges"><?= $detail['other_charges'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.other_charges", ["class" => "other_charges"]);?>
                        </td>
                        <td>
                            <span class="margin_per_unit"><?= $detail['margin_per_unit'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.margin_per_unit", ["class" => "margin_per_unit"]);?>
                        </td>
                        <td>
                            <span class="margin_total"><?= $detail['margin_total'] ?></span>
                            <?= $this->Form->hidden("PurchaseOrderDetail.$n.margin_total", ["class" => "margin_total"]);?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>                
            </table>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Total Sale Amount :</label>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
            <span class="total_sale_amount"><?= $this->request->data[$model]["total_sale_amount"] ?></span>
        </div>
        <?= $this->Form->hidden('total_sale_amount', array('class' => "total_sale_amount")); ?>
    </div>
    
    <?php if ($this->request->data[$model]["is_igst_apply"]) : ?>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">IGST :</label>
            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                <span class="igst"><?= $this->request->data[$model]["igst"] ?></span>
            </div>
            <?= $this->Form->hidden('igst', array('class' => "igst")); ?>
        </div>
    <?php else : ?>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">CGST :</label>
            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                <span class="cgst"><?= $this->request->data[$model]["cgst"] ?></span>
            </div>
            <?= $this->Form->hidden('cgst', array('class' => "cgst")); ?>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">SGST :</label>
            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
                <span class="sgst"><?= $this->request->data[$model]["sgst"] ?></span>
            </div>
            <?= $this->Form->hidden('sgst', array('class' => "sgst")); ?>
        </div>
    <?php endif; ?>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Total Receive Amount :</label>
        <div class="col-md-6 col-sm-6 col-xs-12" style="padding-top: 7px;">
            <span class="total_receive_able_amount"><?= $this->request->data[$model]["total_receive_able_amount"] ?></span>
        </div>
        <?= $this->Form->hidden('total_receive_able_amount', array('class' => "total_receive_able_amount")); ?>
    </div>
    
    <div class="form-group freight">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Receipt Term <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('reciept_term_id', [
                "type" => "select",
                "options" => $reciept_term_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                "class" => "form-control select2me"
            ]); ?>
        </div>
    </div>
</div>

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue">Submit</button>
    </div>
</div>

<script type="text/javascript">
    var party = JSON.parse('<?= json_encode($this->request->data['Location']['Party']) ?>');
    var is_completed = '<?= (int) $this->request->data[$model]['is_completed'] ?>';
    var cgst_per = '<?= $cgst_per ?>';
    var sgst_per = '<?= $sgst_per ?>';
    $(document).ready(function()
    {
        $("table#product").tableTemplate({
            onRowAdd : function (tr, opt)
            {
                tr.find(".required-input").attr("required", true);    
                
                tr.find("input.qty").addClass("validate-more-than");
                tr.find("input.qty").attr("data-more-than-msg", "Should be greater than 0");
                tr.find("input.qty").attr("data-more-than-from", 0);
                
                tr.find(".product_id").select2();
                tr.find(".uom_id").select2();
                
                update_total_amts();
            },
            onRowDel : function (table, id, i)
            {
                update_total_amts();
            }
        });
        
        function get_product_uom_list(_tr, pageLoad)
        {
            var p_id = _tr.find(".product_id").val();
            
            if (p_id)
            {
                $.get("/Categories/ajaxGetUomListByProduct/" + p_id, function(response)
                {
                    try
                    {
                        response = JSON.parse(response);
                    }
                    catch(e)
                    {
                        bootbox.alert(response);
                        return;
                    }

                    var html = '<option value="">Please Select</option>';
                    for(var i in response)
                    {
                        var r = response[i];

                        html += '<option value="' + r["id"] + '">' + r["name"] + '</option>';
                    }

                    _tr.find("select.uom_id").html(html);

                    if (pageLoad)
                    {
                        var v = _tr.find("select.uom_id").data("value");
                        _tr.find("select.uom_id").val(v).trigger("change");

                        get_cost_price(_tr);
                    }
                });
            }
        }
        
        $("table#product").on("change", ".product_id", function ()
        {
            var _tr = $(this).closest("tr");
            
            get_product_uom_list(_tr);
        });
        
        $("table#product").on("change", "select.uom_id", function ()
        {
            get_cost_price($(this).closest("tr"));
            get_gst_price($(this).closest("tr"));
        });
        
        $("table#product").on("click", ".get_cost_price", function ()
        {
            get_cost_price($(this).closest("tr"));
        });
        
        $("table#product").on("blur", "input.qty, input.price", function ()
        {
            cal_freight_charges();
            cal_other_charges();
            cal_discount();
            update_tr_amt($(this).closest("tr"));
        });
                
        function get_cost_price(_tr)
        {
            var p_id = _tr.find(".product_id").val();
            var uom_id = _tr.find(".uom_id").val();
            
            if (p_id && uom_id)
            {
                $.get("/ProductCostPrices/ajaxGetPrice/" + p_id + "/" + uom_id, function(response)
                {
                    try
                    {
                        response = JSON.parse(response);
                    }
                    catch(e)
                    {
                        bootbox.alert(response);
                        return;
                    }

                    if (response["status"] == "1")
                    {
                        _tr.find("span.cost_price").html(response['data']['cost_price']);
                        _tr.find("input.cost_price").val(response['data']['cost_price']);
                        update_tr_amt(_tr);
                    }
                    else
                    {
                        bootbox.alert(response['msg']);
                    }
                });
            }
        }
        
        function get_gst_price(_tr)
        {
            var p_id = _tr.find(".product_id").val();
            
            if ( _tr.find("span.gst_per").length == 0)
            {
                return;
            }
            
            if (p_id)
            {
                $.get("/Products/ajaxGstGet/" + p_id, function(response)
                {
                    try
                    {
                        response = JSON.parse(response);
                    }
                    catch(e)
                    {
                        bootbox.alert(response);
                        return;
                    }

                    if (response["status"] == "1")
                    {
                        _tr.find("span.gst_per").html(response['data']['gst_per']);
                        _tr.find("input.gst_per").val(response['data']['gst_per']);
                        update_tr_amt(_tr);
                    }
                    else
                    {
                        bootbox.alert(response['msg']);
                    }
                });
            }
        }
        
        $(document).on("click", "a.change_cost_price", function()
        {
            var _tr = $(this).closest("tr");
            var date = '<?= date(DateUtility::DATE_OUT_FORMAT) ?>';

            var price_post_data = { 
                product_id : _tr.find(".product_id").val(), 
                date : date,
                uom_id : _tr.find(".uom_id").val()
            };
            
            if (!price_post_data.product_id)
            {
                bootbox.alert("Please select product first");
                return;
            }
            
            if (!price_post_data.uom_id)
            {
                bootbox.alert("Please select UOM first");
                return;
            }
            
            if (_tr.find("select.product_id").length > 0)
            {
                price_post_data['product_name'] = _tr.find("select.product_id option:selected").text()
            }
            else
            {
                price_post_data['product_name'] = _tr.find(".product_name").text()
            }

            change_product_cost_price(price_post_data, function(data)
            {
                _tr.find("span.cost_price").html(data["actual_rate"]);
                _tr.find("input.cost_price").val(data["rate"]);
                update_tr_amt(_tr);
            });

            return false;
        });

        $(document).on("click", "a.show_cost_price_list", function()
        {
            var _tr = $(this).closest("tr");

            var price_post_data = { 
                product_id : _tr.find(".product_id").val(), 
                uom_id : _tr.find(".uom_id").val()
            };
            
            if (!price_post_data.product_id)
            {
                bootbox.alert("Please select product first");
                return;
            }
            
            if (!price_post_data.uom_id)
            {
                bootbox.alert("Please select UOM first");
                return;
            }
            
            if (_tr.find("select.product_id").length > 0)
            {
                price_post_data['product_name'] = _tr.find("select.product_id option:selected").text()
            }
            else
            {
                price_post_data['product_name'] = _tr.find(".product_name").text()
            }

            show_product_cost_price(price_post_data);
        });
        
        $(document).on("click", "a.change_gst_per", function()
        {
            var _tr = $(this).closest("tr");

            var price_post_data = { 
                party_id : party["id"],
                party_name : party["name"],
                product_id : _tr.find(".product_id").val(), 
                uom_id : _tr.find(".uom_id").val()
            };
            
            if (!price_post_data.product_id)
            {
                bootbox.alert("Please select product first");
                return;
            }
            
            if (!price_post_data.uom_id)
            {
                bootbox.alert("Please select UOM first");
                return;
            }

            change_product_gst(price_post_data, function(data)
            {
                _tr.find("span.gst_per").html(data["gst_per"]);
                _tr.find("input.gst_per").val(data["gst_per"]);
                update_tr_amt(_tr);
            });

            return false;
        });
        
        function update_tr_amt(tr)
        {
            var price = tr.find("input.price").val();
            price = parseFloat(price ? price : 0);
            
            var qty = tr.find("input.qty").val();
            qty = parseFloat(qty ? qty : 0);        
            
            var gst_per = tr.find("input.gst_per").val();
            gst_per = parseFloat(gst_per ? gst_per : 0);
            
            var amt = price * qty;
            tr.find("span.amt").html(amt.toFixed(2));
            tr.find("input.amt").val(amt.toFixed(2));
            
            var discount = tr.find("input.discount").val();
            discount = parseFloat(discount ? discount : 0);
            
            var freight = tr.find("input.freight").val();
            freight = parseFloat(freight ? freight : 0);
            
            var taxable_amt = amt - discount + freight;
            tr.find("span.taxable_amt").html(taxable_amt.toFixed(2));
            tr.find("input.taxable_amt").val(taxable_amt.toFixed(2));
            
            var gst = taxable_amt * gst_per / 100;
            tr.find("span.gst").html(gst.toFixed(2));
            tr.find("input.gst").val(gst.toFixed(2));
            
            var gst_taxable_amt = taxable_amt + gst;
            tr.find("span.gst_taxable_amt").html(gst_taxable_amt.toFixed(2));
            tr.find("input.gst_taxable_amt").val(gst_taxable_amt.toFixed(2));
            
            var cp = tr.find("span.cost_price").html();
            cp = parseFloat(cp ? cp : 0);
            
            var fc = tr.find("input.freight_charges").val();
            fc = parseFloat(fc ? fc : 0);
            
            var oc = tr.find("input.other_charges").val();
            oc = parseFloat(oc ? oc : 0);
            
            var margin = (gst_taxable_amt / qty) - cp - fc - oc;
            tr.find("span.margin_per_unit").html(margin.toFixed(2));
            tr.find("input.margin_per_unit").val(margin.toFixed(2));
            
            margin = margin * qty;
            tr.find("span.margin_total").html(margin.toFixed(2));
            tr.find("input.margin_total").val(margin.toFixed(2));
            
            update_total_amts();
        }
        
        function update_total_amts()
        {
            var amt = 0, gst = 0;
            $("table#product").find(">tbody > tr").not(".template-row").each(function() 
            {
                var tr = $(this);
                var v =  tr.find("input.taxable_amt").val();
                v = parseFloat(v ? v : 0);
                amt += v;
                
                v =  tr.find("input.gst").val();
                v = parseFloat(v ? v : 0);
                gst += v;
            });
            
            $("span.total_sale_amount").html(amt.toFixed(2));
            $("input.total_sale_amount").val(amt.toFixed(2));
            
            if ( $(".igst").length > 0 )
            {
                $("span.igst").html(gst.toFixed(2));
                $("input.igst").val(gst.toFixed(2));
            }
            else
            {
                var cgst = gst * cgst_per / 100;
                var sgst = gst * sgst_per / 100;
                
                $("span.cgst").html(cgst.toFixed(2));
                $("input.cgst").val(cgst.toFixed(2));
                
                $("span.sgst").html(sgst.toFixed(2));
                $("input.sgst").val(sgst.toFixed(2));
            }
            
            var t_amt = amt + gst;
            $("span.total_receive_able_amount").html(t_amt.toFixed(2));
            $("input.total_receive_able_amount").val(t_amt.toFixed(2));
        }
        
        function cal_freight_charges()
        {
            var fc = $("#freight_charges").val();
            fc = parseFloat(fc ? fc : 0);
            
            var fc_gst_per = $("#freight_gst_per").val();
            fc_gst_per = parseFloat(fc_gst_per ? fc_gst_per : 0);
            
            var fc_gst = fc * fc_gst_per / 100;
            fc = fc + fc_gst;
            
            var fc_by_customer = $("#freight_borne_by_customer").val();
            fc_by_customer = parseFloat(fc_by_customer ? fc_by_customer : 0);
            
            if (fc_by_customer > fc)
            {
                fc_by_customer = fc;
                $("#freight_borne_by_customer").val(fc_by_customer);
            }
            
            var count = 0;
            $("table#product").find(">tbody > tr").not(".template-row").each(function()
            {
                var tr = $(this);
                var q = tr.find("input.qty").val();
                q = parseFloat(q ? q : 0);
                count += q;
            });
            
            var per_unit = 0;
            if (count > 0 && fc)
            {
                per_unit = fc / count;
            }
            
            $("table#product").find("span.freight_charges").html(per_unit.toFixed(2));
            $("table#product").find("input.freight_charges").val(per_unit.toFixed(2));
            
            
            per_unit = 0;
            if (count > 0 && fc_by_customer)
            {
                per_unit = fc_by_customer / count;
            }
            
            $("table#product").find(">tbody > tr").not(".template-row").each(function()
            {
                var tr = $(this);
                var q = tr.find("input.qty").val();
                q = parseFloat(q ? q : 0);
                var fc_q = per_unit * q;
                tr.find("span.freight").html(fc_q.toFixed(2));
                tr.find("input.freight").val(fc_q.toFixed(2));
                
                update_tr_amt(tr);
            });
        }
        
        function cal_other_charges()
        {
            var oc = $("#other_charges").val();
            oc = parseFloat(oc ? oc : 0);
            
            var count = 0;
            $("table#product").find(">tbody > tr").not(".template-row").each(function()
            {
                var tr = $(this);
                var q = tr.find("input.qty").val();
                q = parseFloat(q ? q : 0);
                count += q;
            });
            
            var per_unit = 0;
            if (count > 0 && oc)
            {
                per_unit = oc / count;
            }
            
            $("table#product").find("span.other_charges").html(per_unit.toFixed(2));
            $("table#product").find("input.other_charges").val(per_unit.toFixed(2));
        }
        
        function cal_discount()
        {
            var dis_per = $("#discount_per").val();
            dis_per = parseFloat(dis_per ? dis_per : 0);
            
            $("table#product").find(">tbody > tr").not(".template-row").each(function()
            {
                var tr = $(this);
                var amt = tr.find("input.amt").val();
                var dis = amt * dis_per / 100;
                tr.find("span.discount").html(dis.toFixed(2));
                tr.find("input.discount").val(dis.toFixed(2));
                update_tr_amt(tr);
            });
        }
        
        $("#freight_charges, #freight_gst_per, #freight_borne_by_customer").blur(function()
        {
            cal_freight_charges();
        });
        
        $("#other_charges").blur(function()
        {
            cal_other_charges();
            update_total_amts();
        });
        
        $("#discount_per").blur(function() 
        {
            cal_discount();            
        });
        
        $("#will_customer_pay_freight").change(function()
        {
            if (this.checked)
            {
                $(".freight").find("input, select").val(0).attr("disabled", true).removeAttr("required");
                $(".freight").hide();
            }
            else
            {
                $(".freight").find("input, select").attr("required", true).removeAttr("disabled");
                $(".freight").show();
            }
            
            cal_freight_charges();
            update_total_amts();
        });
        
        $("form").submit(function()
        {
            var result = true;            
            var error_ele = null;
            var list = [];
            $("table#product").find(".product_id").each(function()
            {
                var v = $(this).val();
                
                if (list.indexOf(v) === -1)
                {
                    list.push(v);
                }
                else
                {
                    result = false;
                    $(this).parent().append("<span class='error-message'>Duplicate Product</span>");
                    if (!error_ele)
                    {
                        error_ele = $(this).parent().find(".error-message:first");
                    }
                }
            });
            
            if (error_ele)
            {
                $("html, body").animate({
                    scrollTop: error_ele.offset().top - 250
                }, 500);
            }
            
            if (list.length == 0)
            {
                bootbox.alert("Please Select at least one product");
            }
            
            return result;
        });
        
        $("#will_customer_pay_freight").trigger("change");
        
        $("table#product").find(">tbody > tr").not(".template-row").each(function()
        {
            get_product_uom_list($(this), true);
            get_gst_price($(this));
        });
    });
</script>