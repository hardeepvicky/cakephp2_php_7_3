<script type="text/javascript">
    function check_inventory_before_any_operation(callback)
    {
        $.post("/Inventories/ajaxCheckInventoryBeforeAnyOperation/" + inventory_id, function(response, status)
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
            
            callback(response);

            if (response["status"] == "1")
            {
                callback();
            }
            else
            {
                bootbox.alert(response["msg"]);
            }
        });
    }
    
    function update_inventory_qty_uom_wise(total_qty)
    {
        var html = "<ul>";        
        for (var i in total_qty)
        {
            html += "<li>" + total_qty[i]["qty"] + " " + total_qty[i]["unit"] +  "</li>";
        }

        html += "</ul>";

        $("#inventory-qty-uom-wise").html(html);
    }
</script>
    