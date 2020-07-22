<div class="form-body">
    <div class="row">
        <div class="col-md-10 col-sm-12">
            <div class="form-group">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    Document Date : <b><?= $this->request->data[$model]['document_date'] ?></b>
                    <?= $this->Form->hidden('document_date'); ?>
                </div>                
                <div class="col-md-3 col-sm-6 col-xs-12">      
                    Total Invoice Quantity:
                    <div id="inventory-qty-uom-wise" style="font-size : 18px;"></div>
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="row">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12">Product <span>*</span></label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select id="product_id" class="form-control select2me">
                                <option value="">Please Select</option>
                                <?php foreach ($category_sku_list as $category) : ?>
                                    <?php if ($category["Product"]): ?>
                                        <optgroup label="<?= $category["Category"]["name"] ?>" data-uom_data='<?= json_encode($category["uom_list"]) ?>'>
                                            <?php foreach ($category["Product"] as $product): ?>
                                                <option value="<?= $product["id"] ?>"> <?= $product["sku"] ?> </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    From Location : <b><?= $this->request->data['FromLocation']['name'] ?></b>
                    <?= $this->Form->hidden('FromLocation.name'); ?>
                </div>                
                <div class="col-md-3 col-sm-6 col-xs-12">                    
                </div>
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="row">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12">User </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select id="user_id" class="form-control select2me cascade-list" cascade-href="/Tasks/getList/{{v}}" cascade-target="select#task_id">
                                <option value="">Please Select</option>
                                <?php foreach ($dept_users as $dept) : ?>
                                    <?php if ($dept["User"]): ?>
                                        <optgroup label="<?= $dept["Department"]["name"] ?>">
                                            <?php foreach ($dept["User"] as $user): ?>
                                                <option value="<?= $user["id"] ?>"> <?= $user["name"] ?> </option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    To Location : <b><?= $this->request->data['ToLocation']['name'] ?></b>
                    <?= $this->Form->hidden('ToLocation.name'); ?>
                </div>                
                <div class="col-md-3 col-sm-6 col-xs-12">
                </div> 
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="row">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12">Task </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <select id="task_id" class="form-control select2me ">
                                <option value="">Please Select</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">  
                <div class="col-md-3 col-sm-6 col-xs-12">
                    Invoice No. : <b><?= $this->request->data[$model]['invoice_no'] ?></b>
                    <?= $this->Form->hidden('invoice_no'); ?>
                </div>                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    Challan No. : <b><?= $this->request->data[$model]['challan_no'] ?></b>
                    <?= $this->Form->hidden('challan_no'); ?>
                </div> 
                <div class="col-md-5 col-sm-6 col-xs-12">
                    <div class="row">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12">Sub Location <span>*</span></label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <?=
                            $this->Form->input("sub_location_id", array(
                                "id" => "sub_location_id",
                                "type" => "select",
                                "options" => $sub_location_list,
                                "value" => $open_sub_location_id,
                                "empty" => DROPDOWN_EMPTY_VALUE,
                                "div" => false, "label" => false, "escape" => false,
                                "class" => "form-control select2me",
                            ))
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">  
                <div class="col-md-3 col-sm-6 col-xs-12">
                </div>                
                <div class="col-md-9 col-sm-6 col-xs-12">
                    <div class="row">
                        <label class="control-label col-md-4 col-sm-6 col-xs-12">Tag </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?=
                            $this->Form->input("inventory_tag_id", array(
                                "id" => "inventory_tag_id",
                                "type" => "select",
                                "options" => $inventory_tag_list,
                                "empty" => DROPDOWN_EMPTY_VALUE,
                                "div" => false, "label" => false, "escape" => false,
                                "class" => "form-control select2me",
                            ))
                            ?>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            <span id="add-inventory-tag" class="btn blue">Add New</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">  
                <div class="col-md-offset-4 col-md-8 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            Box No.
                            <input type="text" autocomplete="off"  class="barcode-scan form-control invalid-char validate-alpha-numeric" id="scan-box"/>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12">
                            Qty
                            <input type="text" autocomplete="off"  class="barcode-scan form-control validate-float" id="scan-qty"/>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            Unit
                            <select id="uom_id" class="form-control select2me">
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-6 col-xs-12" style="padding-top : 18px;">                        
                            <span id="save-inv-detail-sub-location" class="btn blue">Save</span>
                        </div>
                    </div>
                    <div style="margin-top: 15px;">
                        <p id="scan-error-msg" class="alert alert-info" style="padding : 5px 10px;">Scan Result</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-12">
            <div>
                <img id="scan-product-image" style="margin-left: 8%; width : 90%;">
            </div>
        </div>
    </div>

    <?= $this->element("Inventories/inventory_tag_add") ?>
    
    <div class="portlet box blue-hoki" style="margin-top : 5px;">
        <div class="portlet-title">
            <div class="caption">Saved Records</div>
        </div>
        <div class="portlet-body">
            <div class="form-group" style="max-height : 300px; overflow-y: scroll;">
                <?= $this->element("Inventories/non_scanable_scan_table") ?>
            </div>
        </div>
    </div>
    <?php
    if ($this->request->data[$model]["is_purchase_order"])
    {
        echo $this->element("$controller/non_scanable_inventory_detail_table_purchase_order");
    } 
    else
    {
        echo $this->element("Inventories/non_scanable_inventory_detail_table");
    }
    ?>
</div>

<?php if ($this->request->data[$model]["created_by"] == $auth_user["id"]): ?>
<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue-madison next" name="data[next]" value="1">Next</button>
    </div>
</div>
<?php endif; ?>

<?= $this->element("Inventories/common_js_non_scanable") ?>

<script type="text/javascript" src="/assets/global/plugins/handlebars-v4.0.12.js"></script>    
<script type="text/javascript">
var inventory_id = '<?= $this->request->data[$model]["id"] ?>';
var inventory_type = JSON.parse('<?= $this->request->data[$model]['type']; ?>');
var another_location = JSON.parse('<?= json_encode($another_location); ?>');
var qty_group_uom = JSON.parse('<?= json_encode($this->request->data[$model]['qty_group_uom']); ?>');

$(document).ready(function() 
{        
    update_inventory_qty_uom_wise(qty_group_uom);
    var product_template = Handlebars.compile(document.getElementById("product-template").innerHTML);
    
    function sent_request(request)
    {
        var tr = $("tr.product-" + request['product_id']);
        if (tr.length > 0 && tr.attr("data-out_uom_id") != request["uom_id"])
        {
            var product_name = tr.find(".product-name").html();
            var uom_name = tr.find(".out-uom-name").html();
            bootbox.alert("Product " + product_name + " is alredy with unit " + uom_name + ", Now you can not change Unit");
            return false;
        }    

        var inv_sub_location_key = "product-" + request["product_id"] + "-sub_location-" + request["sub_location_id"] + "-inventory_tag_id-" + request["inventory_tag_id"] + "-box-" + request["box_no"];

        var product_name = $("select#product_id option[value='" + request["product_id"] + "']").html();
        var sub_location_name = $("select#sub_location_id option[value='" + request["sub_location_id"] + "']").html();
        var inventory_tag_name = "";
        if (request["inventory_tag_id"])
        {
            inventory_tag_name = $("select#inventory_tag_id option[value='" + request["inventory_tag_id"] + "']").html();
        }

        if ($("table#scan tr." + inv_sub_location_key).length > 0)
        {
            bootbox.alert("Record alredy exist. SKU : " + product_name + ", Sub Location : " + sub_location_name +  ", Inventory Tag : " + inventory_tag_name + ", Box No. : " + request["box_no"]);
            return false;
        }

        $.post("/<?= $controller ?>/ajaxNonScanableSave/" + inventory_id, request, function(response, status)
        {
            if (status != "success")
            {
                bootbox.alert("Request Failed. Please try again");
                return;
            }

            try
            {
                response = JSON.parse(response);
            }
            catch (e)
            {
                bootbox.alert(response);
                return;
            }

            $("#scan-error-msg").removeClass("alert-info alert-success alert-danger");
            
            if (response["status"] == "0")
            {
                $("#scan-error-msg").html(response["msg"]).addClass("alert-danger");
                $("#text-to-speech").html(response["msg"]).articulate('speak');
                return;
            }
            else
            {
                $("#scan-error-msg").html("Success").addClass("alert-success");
            }
            
            update_inventory_qty_uom_wise(response["qty_group_uom"]);
            
            if ( tr.length == 0 )
            {
                var context = {
                    i : $("table#inventory tbody tr.inventory").length + 1,
                    product_id : response['Product']['id'],
                    sku : response['Product']['sku'],
                    uom_id : request["uom_id"],
                    uom_name : response["uom"]["name"] + " (" + response["uom"]["short_name"] + ")",
                    rate : response["inventory_detail"]["rate"],
                    uom_rate : response["inventory_detail"]["uom_rate"],
                    gst_per : response["inventory_detail"]["gst_per"],
                    inventory_detail_id : response["inventory_detail"]["id"],
                    qty : response["inventory_detail"]["qty"],
                    uom_qty : response["inventory_detail"]["uom_qty"],
                };

                var html = product_template(context);
                $("table#inventory > tbody").prepend(html);
                tr = $("table#inventory > tbody tr.inventory:first");
            }
            else
            {
                tr.find("span.inventory-qty").html(response["inventory_detail"]["uom_qty"]);
                tr.find("input.inventory-qty").val(response["inventory_detail"]["qty"]);
            }
            
            update_inventory_detail_amt(tr);
            
            var data = {
                inventory_detail_sub_location_id : response["inventory_detail_sub_location_id"],
                product_id : response["Product"]['id'],
                sku : response["Product"]['sku'],
                sub_location_id : request["sub_location_id"],
                sub_location : sub_location_name,
                inventory_tag_id : request["inventory_tag_id"],
                inventory_tag : inventory_tag_name,
                box : request["box_no"],
                qty : request["uom_qty"],
                unit : response["uom"]["name"] + " (" + response["uom"]["short_name"] + ")",
            };

            insert_scan_table(inv_sub_location_key, data);
        });
    }

    $("#save-inv-detail-sub-location").click(function(e) 
    {
        $(".form-body").find(".error-message").remove();
        
        var result = true;
        var product_id = $("select#product_id").val();
        if ( !product_id )
        {
            $("select#product_id").parent().append('<div class="error-message">Please Select Product</div>');
            result = false;
        }

        var sub_location_id = $("select#sub_location_id").val();
        if ( !sub_location_id )
        {
            $("select#sub_location_id").parent().append('<div class="error-message">Please Select Sub Location</div>');
            result = false;
        }

        var box_no = $("#scan-box").val();
        if ( !box_no )
        {
            $("input#scan-box").parent().append('<div class="error-message">Entre Box No.</div>');
            result = false;
        }

        var qty = $("#scan-qty").val();
        if ( !qty )
        {
            $("input#scan-qty").parent().append('<div class="error-message">Enter Qty</div>');
            result = false;
        }
        
        var uom_id = $("select#uom_id").val();
        if ( !uom_id )
        {
            $("select#uom_id").parent().append('<div class="error-message">Please Select Unit</div>');
            result = false;
        }
        
        if (result == false)
        {
            return;
        }
        
        var data = {
            product_id : product_id,
            sub_location_id : sub_location_id,
            box_no : box_no,
            uom_qty : qty,
            uom_id : uom_id
        };
        
        var tag_id = $("select#inventory_tag_id").val();
        if (tag_id)
        {
            data["inventory_tag_id"] = tag_id;
        }
        else
        {
            data["inventory_tag_id"] = 0;
        }
        
        sent_request(data);
    });
    
    $("select#product_id").change(function()
    {
        var obj = $(this).find("option:selected").parents("optgroup");
        var html = "";
        if (obj.length > 0)
        {
            var uom_data = JSON.parse(obj.attr("data-uom_data"));
            for (var i in uom_data)
            {
                html += '<option value="' + uom_data[i]["id"] + '">' + uom_data[i]["name"] + '</option>';
            }
        }     
        
        $("input#scan-qty").val("");
        $("select#uom_id").html(html).trigger("change");
    });
    
    $("select#product_id").trigger("change");
    
    var validate = false;
    $("form").submit(function ()
    {
        if (!validate)
        {
            $.get("/<?= $controller ?>/ajaxValidateNonScanble/" + inventory_id, function(response)
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
                    validate = true;
                    $("button.next").trigger("click");
                }
                else
                {
                    if ( typeof response["errors"] != "undefined")
                    {
                        var html = "<ol>";
                            for (var error_type in response["errors"])
                            {
                                html += "<li>" + error_type;
                                html += "<ul>"
                                
                                for (var i in response["errors"][error_type])
                                {
                                    html += "<li>" + response["errors"][error_type][i]  + "</li>";
                                }
                                
                                html += "</ul>";
                                html += "</li>";
                                
                            }
                        html += "</ol>";
                        $("#scan-error-msg").html(html);
                        
                        $('html, body').animate({
                            scrollTop: $("#scan-error-msg").offset().top - 300
                        });
                    }
                }
            });
            
            return false;
        }
    });
});
</script>