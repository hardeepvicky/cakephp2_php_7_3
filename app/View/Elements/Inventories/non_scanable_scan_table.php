<table class="table table-striped table-bordered order-column sr-databtable" id="scan">
    <thead>
        <tr>
            <th>#</th>
            <th data-search="1" data-sort="alpha">SKU</th>
            <th data-search="1">Sub Location</th>
            <th data-search="1">Inventory Tag</th>
            <th data-search="1">Box</th>
            <th data-sort="numeric">Qty</th>                            
            <th data-search="1">Unit</th>
        </tr>
    </thead>
    <tbody>
        <?php if ( isset($this->request->data['InventoryDetail']) ) : ?>
            <?php $a = 0; foreach ($this->request->data['InventoryDetail'] as $i => $inv_detail) : ?>
                <?php foreach ($inv_detail['InventoryDetailSubLocation'] as $i => $inv_sub_location) : 
                    $a++;
                    $key = "product-" . $inv_detail["product_id"] . "-sub_location-" . $inv_sub_location["IDSL"]["sub_location_id"] .  "-inventory_tag_id-" . $inv_sub_location["IDSL"]["inventory_tag_id"] . "-box-" . $inv_sub_location["IDSL"]["box_no"];
                ?>
                    <tr class="<?= $key ?>" data-inventory_detail_sub_location_id="<?= $inv_sub_location["IDSL"]["id"] ?>" data-product_id="<?= $inv_detail["product_id"] ?>">
                        <td>
                            <span class="row-deleter">
                                <i class="fa fa-times-circle font-red-sunglo icon"></i>
                            </span> 
                            &nbsp;<?= $a ?>
                        </td>
                        <td><?= $sku_list[$inv_detail["product_id"]] ?></td>
                        <td  class='sub_location'>
                            <?php
                                if ($this->request->data["Inventory"]["type"] == INVENTORY_OUTGOING && $this->request->data["Inventory"]["is_stock_transfer"])
                                {
                                    echo $sub_location_list[$inv_sub_location["PSL"]["sub_location_id"]];
                                }
                                else
                                {
                                    echo $sub_location_list[$inv_sub_location["IDSL"]["sub_location_id"]];
                                }
                            ?>
                        </td>
                        <td><?= isset($inventory_tag_list[$inv_sub_location["IDSL"]["inventory_tag_id"]]) ? $inventory_tag_list[$inv_sub_location["IDSL"]["inventory_tag_id"]] : "" ?></td>
                        <td><?= $inv_sub_location["IDSL"]["box_no"] ?></td>
                        <td><?= $inv_sub_location["IDSL"]["uom_qty"] ?></td>
                        <td><?= $uom_list[$inv_sub_location["IDSL"]["uom_id"]] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<script type="text/javascript">
    function insert_scan_table(row_unique_key, data)
    {
        var row_len = $("table#scan tbody tr").length;

        var html = '<tr class="' + row_unique_key + '" data-inventory_detail_sub_location_id="' + data["inventory_detail_sub_location_id"] + '" data-product_id="' + data["product_id"] + '">';
            html += "<td>";
                html += '<span class="row-deleter"><i class="fa fa-times-circle font-red-sunglo icon"></i></span> &nbsp; ';
                html += (row_len + 1);
            html += "</td>";
            html += "<td>" + data['sku'] + "</td>";
            html += "<td class='sub_location'>" + data["sub_location"] + "</td>";
            html += "<td>" + data["inventory_tag"] + "</td>";
            html += "<td>" + data["box"] + "</td>";
            html += "<td>" + data["qty"] + "</td>";
            html += "<td>" + data["unit"] + "</td>";
        html += "</tr>";
        
        $("table#scan tbody").prepend(html);
    }
    
    function delete_record(tr)
    {
        var inventory_detail_sub_location_id = tr.attr("data-inventory_detail_sub_location_id");
        var product_id = tr.attr("data-product_id");

        bootbox.confirm({
            message: "Are you sure to delete",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) 
            {
                if (!result)
                {
                    return;
                }
                
                $.get("/<?= $controller ?>/ajaxNonScanableDelete/" + inventory_id + "/" + inventory_detail_sub_location_id, function(response, status)
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

                        $('html, body').animate({
                            scrollTop: $("#scan-error-msg").offset().top - 300
                        });
                        return;
                    }
                    else
                    {
                        $("#scan-error-msg").html("Success").addClass("alert-success");
                    }

                    update_inventory_qty_uom_wise(response["qty_group_uom"]);
                    $("tr.product-" + product_id).find("span.inventory-qty").html(response["inventory_detail"]["uom_qty"]);                    
                    $("tr.product-" + product_id).find("input.inventory-qty").val(response["inventory_detail"]["qty"]);
                    if (typeof update_inventory_detail_amt === "function") { 
                        update_inventory_detail_amt($("tr.product-" + product_id));
                    }
                    tr.remove();
                    
                    var found = false;
                    $("table#scan tbody tr").each(function()
                    {
                        var p_id = $(this).attr("data-product_id");
                        
                        if (p_id == product_id)
                        {
                            found = true;
                        }
                    });
                    
                    if (!found)
                    {
                        $("tr.product-" + product_id).remove();
                    }
                });
            }
        });
        
       
    }

    $(document).on("click", "table#scan .row-deleter", function ()
    {
        var _tr = $(this).parents("tr");
        delete_record(_tr);
    });
</script>