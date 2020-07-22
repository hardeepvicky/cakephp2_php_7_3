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
<table class="table table-striped table-bordered order-column sr-databtable" id="scan">
    <thead>
        <tr>
            <th>#</th>
            <th data-search="1">SKU</th>
            <?php if ($sub_location_will_appear): ?>
                <th data-search="1">Sub Location</th>
            <?php endif; ?> 
            <th data-search="1">Serial Code</th>
            <th data-search="1">Box</th>
            <th data-search="1">Scan By</th>
            <?php if ($last_operation_done_on_serial_code): ?>
                <th>Last Operation</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php if ( isset($this->request->data['InventoryDetail']) ) :
                $a = 0; $scan_by_you = 0;
                foreach ($this->request->data['InventoryDetail'] as $i => $inv_detail) : 
                    foreach ($inv_detail['InventoryDetailProduct'] as $i => $inv_product) :
                        $a++;
                
                        if ($inv_product["IDP"]["created_by"] == $auth_user["id"])
                        {
                            $scan_by_you++;
                        }
                        
            ?>
                    <tr class="code-<?= $inv_product["BBSC"]["code"] ?>" data-serial_code="<?= $inv_product["BBSC"]["code"] ?>"  data-product_id="<?= $inv_detail["product_id"] ?>">
                        <td>
                            <span class="row-deleter">
                                <i class="fa fa-times-circle font-red-sunglo icon"></i></span> &nbsp;
                            <?= $a ?>
                        </td>
                        <td><?= $inv_detail['Product']["Product"]['sku'] ?></td>
                        <?php if ($sub_location_will_appear): ?>
                            <td class="sub_location"><?= $sub_location_all_list[$inv_product["IDP"]['sub_location_id']] ?></td>
                        <?php endif; ?>
                        <td><?= $inv_product["BBSC"]["code"] ?></td>
                        <td class="box_no"><?= $inv_product["IDP"]['box_no'] ?></td>
                        <td><?= $user_list[$inv_product["IDP"]["created_by"]] ?></td>
                        <?php if ($last_operation_done_on_serial_code): ?>
                            <td></td>
                        <?php endif; ?>
                    </tr>
                <?php 
                 endforeach;
            endforeach;
        endif; 
        ?>
    </tbody>
</table>

<script type="text/javascript">
    var sub_location_will_appear = '<?= $sub_location_will_appear ? 1 : 0 ?>' == "1";
    var last_operation_done_on_serial_code = '<?= $last_operation_done_on_serial_code ? 1 : 0 ?>' == "1";
    var auth_user_name = '<?= $auth_user["name"] ?>';
    function insert_scan_table(row_unique_id, data)
    {
        var row_len = $("table#scan tbody tr").length;

        var html = '<tr class="' + row_unique_id + '" data-serial_code="' + data["serial_code"] + '" data-sub_location_id="' + data['sub_location_id'] + '" data-product_id="' + data['product_id'] + '">';
            html += "<td>";
                html += '<span class="row-deleter">';
                    html += '<i class="fa fa-times-circle font-red-sunglo icon"></i></span> &nbsp;';
                    html += (row_len + 1);
                html += "</span>";
            html += "</td>";
            html += "<td>" + data['sku'] + "</td>";
            if (sub_location_will_appear)
            {
                html += "<td>" + data["sub_location"] + "</td>";
            }
            html += "<td>" + data["serial_code"] + "</td>";
            html += "<td>" + data["box"] + "</td>";
            html += "<td>" + auth_user_name + "</td>";
            if (last_operation_done_on_serial_code)
            {
                html += "<td>" + data['last_operation'] + "</td>";
            }
        html += "</tr>";

        $("table#scan tbody tr." + row_unique_id).remove();
        $("table#scan tbody").prepend(html);
        update_scan_qty(1);
    }
    
    $(document).on("click", "table#scan .row-deleter", function ()
    {
        var tr = $(this).closest("tr");
        var code = tr.attr("data-serial_code");
        var p_id = tr.attr("data-product_id");
        
        delelte_serial_code($("#modal-InventoryDetailProduct-" + p_id).find("table.InventoryDetailProduct tr.code-" + code));
    });
    
    $(document).ready(function()
    {
        var scan_by_you = parseInt('<?= $scan_by_you ?>');
        update_scan_qty(scan_by_you);
    });
</script>