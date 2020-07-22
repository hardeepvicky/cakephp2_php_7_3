<div class="form-body">
    <div class="form-group">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered order-column table-template" data-template-min-row="1">
                <thead>
                    <tr>
                        <th style="width : 5%" class="text-center">
                            <span class="row-adder">
                                <i class="fa fa-plus-circle font-green-meadow icon"></i>
                            </span>
                        </th>
                        <th style="width : 20%">Product</th>
                        <th style="width : 15%">UOM</th>
                        <th style="width : 12%">Price</th>
                        <th style="width : 12%">Gst(%)</th>
                        <th style="width : 10%">Qty</th>
                        <th style="width : 10%">GST</th>
                        <th style="width : 12%">Amount</th>
                        <th style="width : 12%">GST + Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hidden template-row">
                        <td class="text-center">
                            <span class="row-deleter">
                                <i class="fa fa-times-circle font-red-sunglo icon"></i>
                            </span>
                        </td>
                        <td>
                            <?= $this->Form->input('DemandOrderDetail.{{id}}.product_id', array(
                                    "type" => "select",
                                    "options" => $sku_group_list,
                                    "empty" => "Please Select",
                                    "class" => "form-control product_id  required-input",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input('DemandOrderDetail.{{id}}.uom_id', array(
                                    "type" => "select",
                                    "class" => "form-control uom_id required-input",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        <td>
                            &#8360 <span class="price"></span>
                            <a class="btn btn-default btn-sm change_price" href='javascript:void(0);'>Change Price</a>
                            <a class="btn btn-default btn-sm show-price-list" href="javascript:void(0);">Show Prices</a>
                            <?= $this->Form->hidden('DemandOrderDetail.{{id}}.price', [
                                "class" => "price",
                            ]);
                            ?>
                        </td>
                        <td>
                            <span class="gst_per"></span>
                            <br/>
                            <a class="btn btn-default btn-sm change_gst_per" href='javascript:void(0);'>Change GST</a>
                            <?= $this->Form->hidden('DemandOrderDetail.{{id}}.gst_per', [
                                "class" => "gst_per",
                            ]);
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input('DemandOrderDetail.{{id}}.qty', array(
                                    "class" => "form-control required-input qty",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        
                        <td>
                            <span class="gst"></span>
                            <?= $this->Form->hidden('DemandOrderDetail.{{id}}.gst', ["class" => "gst"]);?>
                        </td>
                        <td>
                            <span class="amt"></span>
                            <?= $this->Form->hidden('DemandOrderDetail.{{id}}.amt', ["class" => "amt"]);?>
                        </td>
                        <td>
                            <span class="gst_amt"></span>
                            <?= $this->Form->hidden('DemandOrderDetail.{{id}}.gst_amt', ["class" => "gst_amt"]);?>
                        </td>
                    </tr>
                    
                    <?php foreach($this->request->data["DemandOrderDetail"] as $n => $demand_order_detail): ?>
                    <tr data-row-id="<?= $n ?>" data-row-i="<?= $n ?>">
                        <td class="text-center">                            
                            <span class="row-deleter">
                                <i class="fa fa-times-circle font-red-sunglo icon"></i>
                            </span>
                            
                            <?= $n + 1 ?>
                        </td>
                        <td>
                            <span class="product_name"><?= $sku_list[$demand_order_detail['product_id']] ?></span>
                            <?= $this->Form->hidden("DemandOrderDetail.$n.product_id", [
                                "class" => "product_id",
                            ]);
                            ?>
                        </td>
                        <td>
                            <span class="uom"><?= $uom_list[$demand_order_detail['uom_id']] ?></span>
                            <?= $this->Form->hidden("DemandOrderDetail.$n.uom_id", [
                                "class" => "uom_id",
                            ]);
                            ?>
                        </td>
                        <td>
                            &#8360 <span class="price"><?= $demand_order_detail['price'] ?></span>
                            <a class="btn btn-default btn-sm change_price" href='javascript:void(0);' >Change Price</a>
                            <a class="btn btn-default btn-sm show-price-list" href="javascript:void(0);">Show Prices</a>
                            <?= $this->Form->hidden("DemandOrderDetail.$n.price", [
                                "class" => "price",
                            ]);
                            ?>
                        </td>
                        <td>
                            <span class="gst_per"><?= $demand_order_detail['gst_per'] ?></span>
                            <br/>
                            <a class="btn btn-default btn-sm change_gst_per" href='javascript:void(0);'>Change GST</a>
                            <?= $this->Form->hidden("DemandOrderDetail.$n.gst_per", [
                                "class" => "gst_per",
                            ]);
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("DemandOrderDetail.$n.qty", array(
                                    "class" => "form-control required-input qty",
                                    "required" => false
                                ));
                            ?>
                        </td>
                        
                        <td>
                            <span class="gst"><?= $demand_order_detail['gst'] ?></span>
                            <?= $this->Form->hidden("DemandOrderDetail.$n.gst", ["class" => "gst"]);?>
                        </td>
                        <td>
                            <span class="amt"><?= $demand_order_detail['amt'] ?></span>
                            <?= $this->Form->hidden("DemandOrderDetail.$n.amt", ["class" => "amt"]);?>
                        </td>
                        <td>
                            <span class="gst_amt"><?= $demand_order_detail['gst_amt'] ?></span>
                            <?= $this->Form->hidden("DemandOrderDetail.$n.gst_amt", ["class" => "gst_amt"]);?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue">Submit</button>
        <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
    </div>
</div>

<script type="text/javascript">
    var party = JSON.parse('<?= json_encode($this->request->data['LegderAccount']['Location']['Party']) ?>');
    $(document).ready(function()
    {
        $(".table-template").tableTemplate({
            onRowAdd : function (tr, opt)
            {
                tr.find(".required-input").attr("required", true);    
                
                tr.find("input.qty").addClass("validate-more-than");
                tr.find("input.qty").attr("data-more-than-msg", "Should be greater than 0");
                tr.find("input.qty").attr("data-more-than-from", 0);
                
                tr.find(".product_id").select2();
                tr.find(".uom_id").select2();
            }
        });
        
        $(".table-template").on("change", ".product_id", function ()
        {
            var v = $(this).val();
            v = v ? v : 0;
            
            var _tr = $(this).closest("tr");
            
            $.get("/Categories/ajaxGetUomListByProduct/" + v, function(response)
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
            });
        });
        
        $(".table-template").on("change", "select.uom_id", function ()
        {
            get_cost_price($(this).closest("tr"));
            get_gst_price($(this).closest("tr"));
        });
        
        $(".table-template").on("blur", "input.qty", function ()
        {
            update_tr_amt($(this).closest("tr"));
        });
                
        function get_cost_price(_tr)
        {
            var p_id = _tr.find("select.product_id").val();
            var uom_id = _tr.find("select.uom_id").val();
            
            if (p_id && uom_id)
            {
                $.get("/ProductCostThirdPartyPrices/ajaxGetPrice/" + p_id + "/" + party['id'] + "/" + uom_id, function(response)
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
                        _tr.find("span.price").html(response['data']['cost_price']);
                        _tr.find("input.price").val(response['data']['cost_price']);
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
            var p_id = _tr.find("select.product_id").val();
            
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
        
        $(document).on("click", "a.change_price", function()
        {
            var _tr = $(this).closest("tr");
            var date = '<?= date(DateUtility::DATE_OUT_FORMAT) ?>';

            var price_post_data = { 
                party_id : party["id"],
                party_name : party["name"],
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

            change_product_party_cost_price(price_post_data, function(data)
            {
                _tr.find("span.price").html(data["actual_rate"]);
                _tr.find("input.price").val(data["rate"]);
                update_tr_amt(_tr);
            });

            return false;
        });

        $(document).on("click", "a.show-price-list", function()
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
            
            if (_tr.find("select.product_id").length > 0)
            {
                price_post_data['product_name'] = _tr.find("select.product_id option:selected").text()
            }
            else
            {
                price_post_data['product_name'] = _tr.find(".product_name").text()
            }

            show_product_party_cost_price(price_post_data);
        });
        
        $(document).on("click", "a.change_gst_per", function()
        {
            var _tr = $(this).closest("tr");

            var price_post_data = { 
                party_id : party["id"],
                party_name : party["name"],
                product_id : _tr.find("select.product_id").val(), 
                uom_id : _tr.find("select.uom_id").val()
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
            var price = tr.find("span.price").html();
            price = parseFloat(price ? price : 0);
            
            var qty = tr.find("input.qty").val();
            qty = parseFloat(qty ? qty : 0);            
            
            var gst_per = tr.find("input.gst_per").val();
            gst_per = parseFloat(gst_per ? gst_per : 0);
            
            var amt = price * qty;
            tr.find("span.amt").html(amt.toFixed(2));
            tr.find("input.amt").val(amt.toFixed(2));
            
            var gst = amt * gst_per / 100;
            tr.find("span.gst").html(gst.toFixed(2));
            tr.find("input.gst").val(amt.toFixed(2));
            
            var gst_amt = amt + gst;
            tr.find("span.gst_amt").html(gst_amt.toFixed(2));
            tr.find("input.gst_amt").val(gst_amt.toFixed(2));
        }
        
        $("form").submit(function()
        {
            var result = true;            
            var error_ele = null;
            var list = [];
            $(".product_id").each(function()
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
    });
</script>