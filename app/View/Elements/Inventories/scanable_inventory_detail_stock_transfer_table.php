<?php 
    if (!isset($sub_location_will_appear))
    {
        $sub_location_will_appear = false;
    }
    
    if (!isset($last_operation_done_on_serial_code))
    {
        $last_operation_done_on_serial_code = false;
    }
?>
<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="inventory">
            <thead>
                <tr>
                    <th style="width:7%">#</th>
                    <th>Sku</th>                    
                    <th>Qty</th>
                    <th style="width : 20%">Serial Codes</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( isset($this->request->data['InventoryDetail']) ) 
                       foreach ($this->request->data['InventoryDetail'] as $i => $inv_detail) : ?>
                    <tr class="inventory center product-<?= $inv_detail['product_id'] ?>" data-product_id="<?= $inv_detail['product_id'] ?>" data-inventory_detail_id="<?= $inv_detail['id'] ?>">
                        <td><?= ($i + 1) ?></td>
                        <td class="product-name"><?= $inv_detail['Product']["Product"]['sku'] ?></td>                        
                        <td class="text-center">
                            <span class="inventory-qty"><?= $inv_detail['qty'] ?></span>
                        </td>
                        <td class="text-center">
                            <span class="btn btn-default" data-toggle="modal" data-target="#modal-InventoryDetailProduct-<?= $inv_detail['product_id'] ?>">Show Serial Codes</span>
                            <div id="modal-InventoryDetailProduct-<?= $inv_detail['product_id'] ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Serial Codes</h4>
                                        </div>
                                        <div class="modal-body" style="max-height: 80vh; overflow-y: scroll">
                                            <table class="table table-striped table-bordered order-column InventoryDetailProduct">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <?php if ($sub_location_will_appear): ?>
                                                            <th>Sub Location</th>
                                                        <?php endif; ?>
                                                        <th>Serial Code</th>
                                                        <th>Box</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        foreach($inv_detail['InventoryDetailProduct'] as $j => $inv_product):
                                                           $inv_product["IDP"]['sub_location_id'] = $sub_location_will_appear ? $inv_product["IDP"]['sub_location_id'] : 0;
                                                    ?>
                                                    <tr class="code-<?= $inv_product["BBSC"]["code"] ?>" data-serial_code="<?= $inv_product["BBSC"]["code"] ?>" data-sub_location_id="<?= $inv_product["IDP"]['sub_location_id'] ?>"> 
                                                        <td>
                                                            <span class="row-deleter">
                                                                <i class="fa fa-times-circle font-red-sunglo icon"></i>
                                                            </span> &nbsp; &nbsp;
                                                            <?= ($j + 1) ?>
                                                            <input type="hidden" class="sub_location_id" value="<?= $inv_product["IDP"]['sub_location_id'] ?>" />
                                                        </td>
                                                        <?php if ($sub_location_will_appear): ?>
                                                            <td class="sub_location"><?= $sub_location_all_list[$inv_product["IDP"]['sub_location_id']] ?></td>
                                                        <?php endif; ?>
                                                        <td class="serial_code"><?= $inv_product["BBSC"]["code"] ?></td>
                                                        <td class="box_no"><?= $inv_product["IDP"]['box_no'] ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                  </tr>                              
                  <tr class="box box-product-<?= $inv_detail['product_id'] ?>" data-product_id="<?= $inv_detail['product_id'] ?>">
                    <td></td>
                    <td colspan="2">
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr style="background: #eee; color: #000;" class="center">
                                    <?php if ($sub_location_will_appear): ?>
                                        <th style="width : 40%">Sub Location</th>
                                    <?php endif; ?>
                                    <th style="width : 40%">Box No</th>
                                    <th style="width : 20%">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inv_detail['Box'] as $arr):
                                        $arr["sub_location_id"] = $sub_location_will_appear ? $arr["sub_location_id"] : 0;
                                    ?>
                                <tr class="center box-<?= $arr['box_no'] ?>-sub_location-<?= $arr["sub_location_id"] ?>" >
                                    <?php if ($sub_location_will_appear): ?>
                                        <td><?= $sub_location_all_list[$arr["sub_location_id"]]  ?>
                                    <?php endif; ?>
                                    <td><?= $arr['box_no'] ?></td>
                                    <td class="qty"><?= $arr['qty'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
             <?php endforeach; ?>     
            </tbody>
        </table>
    </div>
</div>

<script id="product-template" type="text/x-handlebars-template">
  <tr data-product_id="{{product_id}}" class="inventory center product-{{product_id}}" data-inventory_detail_id="{{inventory_detail_id}}">
    <td>{{i}}</td>
    <td class="product-name">{{sku}}</td>        
    <td class="text-center">
        <span class="inventory-qty">1</span>
    </td>
    <td class="text-center">
        <span class="btn btn-default" data-toggle="modal" data-target="#modal-InventoryDetailProduct-{{product_id}}">Show Serial Codes</span>
        <div id="modal-InventoryDetailProduct-{{product_id}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Serial Codes</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-bordered order-column InventoryDetailProduct">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <?php if ($sub_location_will_appear): ?>
                                        <th>Sub Location</th>
                                    <?php endif; ?>
                                    <th>Serial Code</th>
                                    <th>Box</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </td>
  </tr>  
  <tr class="box box-product-{{product_id}}" data-product_id="{{product_id}}">
    <td></td>
    <td colspan="2">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr style="background: #eee; color: #000;" class="center">
                    <?php if ($sub_location_will_appear): ?>
                        <th style="width : 30%">Sub Location</th>
                    <?php endif; ?>
                    <th style="width : 30%">Box No</th>
                    <th style="width : 20%">Qty</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </td>
    <td></td>
  </tr>
</script>

<script type="text/javascript" src="/assets/global/plugins/handlebars-v4.0.12.js"></script>    
<script type="text/javascript">
    var sub_location_will_appear = '<?= $sub_location_will_appear ? 1 : 0 ?>' == "1";
    function insert_inventory_detail_product_table(row_unique_id, data)
    {
        var row_len = $("#modal-InventoryDetailProduct-" + data['product_id'] + " table.InventoryDetailProduct tbody tr").length;

        var html = '<tr class="' + row_unique_id + '" data-serial_code="' + data['serial_code'] + '" data-sub_location_id="' + data['sub_location_id'] + '">';
            html += "<td>";
                html += '<span class="row-deleter"><i class="fa fa-times-circle font-red-sunglo icon"></i></span> &nbsp; &nbsp;';
                html += (row_len + 1);        
            html += "</td>";          
            if (sub_location_will_appear)
            {
                html += "<td class='sub_location'>" + data['sub_location'] + "</td>";
            }
            html += "<td class='serial_code'>" + data['serial_code'] + "</td>";
            html += "<td class='box_no'>" + data['box'] + "</td>";
        html += "</tr>";
        
        $("#modal-InventoryDetailProduct-" + data['product_id'] + " table.InventoryDetailProduct tbody").prepend(html);
    }
    
    function insert_update_box_table(row_unique_id, data)
    {
        var box_table = $("table#inventory tbody tr.box-product-" + data['product_id']).find("table");
        var box_tr = box_table.find("tr." + row_unique_id);
        if (box_tr.length == 0)
        {
            var html = '<tr class="center ' + row_unique_id + '">';
                if (sub_location_will_appear)
                {
                    html += '<td>' + data['sub_location'] + '</td>';
                }
                html += '<td>' + data['box'] + '</td>';
                html += '<td class="qty">1</td>';
            html += '</tr>';
            box_table.find("tbody").append(html);
            box_tr = box_table.find("tr." + row_unique_id);
        }
        else
        {
            box_tr.find(".qty").html( parseInt( box_tr.find(".qty").html() ) + 1 );
        }
    }
    
    function after_delete_serial_code(p_id)
    {
        update_scan_qty(-1);
        var row_len = $("tr.product-" + p_id).find("table.InventoryDetailProduct tbody tr").length;
        if (row_len == 0)
        {   
            $('.modal').modal('hide');
            $('.modal-backdrop').remove();
            $("tr.product-" + p_id).remove();
            $("tr.box-product-" + p_id).remove();
        }
    }

    function delelte_serial_code(inv_detail_product_tr)
    {
        var p_id = $(inv_detail_product_tr).parents("tr.inventory").attr("data-product_id");
        var serial_code = inv_detail_product_tr.attr("data-serial_code");
        var sub_location_id = inv_detail_product_tr.attr("data-sub_location_id");
        
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

                $("#scan-error-msg").removeClass("alert-info alert-success alert-danger");
                $.post("/<?= $controller ?>/ajaxDeleteSerialCode/" + inventory_id, {code : serial_code}, function(response, status)
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

                    if (response["status"] == "0")
                    {
                        $("#scan-error-msg").html(response["msg"]).addClass("alert-danger");
                        $("#text-to-speech").html(response["msg"]).articulate('speak');
                        
                        $('html, body').animate({
                            'scrollTop' : $("#scan-error-msg").position().top - 300
                        });
                        
                        return;
                    }
                    else
                    {
                        $("#scan-error-msg").html(serial_code + " deleted successfully").addClass("alert-success");
                    }

                    $("b#inventory-total-qty").html(Math.abs(response["inventory_qty"]));
                    $("tr.product-" + p_id).find("span.inventory-qty").html(Math.abs(response["inventory_detail"]["qty"]));

                    var box_sub_location_key = "box-" + inv_detail_product_tr.find(".box_no").html() + "-sub_location-" + sub_location_id;                       
                    var qty = parseInt( $(".box-product-" + p_id).find("tr." + box_sub_location_key).find("td.qty").html() );
                    if (qty)
                    {
                        $(".box-product-" + p_id).find("tr." + box_sub_location_key).find("td.qty").html(qty - 1);
                    }

                    inv_detail_product_tr.remove();
                    $("table#scan tr.code-" + serial_code).remove();
                    after_delete_serial_code(p_id);                    
                });
            }
        });
    }
    
    $(document).on("click", "table.InventoryDetailProduct .row-deleter", function ()
    {
        delelte_serial_code($(this).closest("tr"));
    });
</script>