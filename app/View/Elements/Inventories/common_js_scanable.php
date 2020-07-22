<script type="text/javascript">
    var default_uom = JSON.parse('<?= json_encode($uom) ?>');   
    
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
</script>
    