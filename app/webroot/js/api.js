function sync_inventory(onDone)
{
    sync_inventory_amazon(onDone);
}

function sync_inventory_amazon(onDone)
{
    Loader.onShown = function()
    {
        $(".tf-loader-container .help-block").html('Cron Job Running : Amazon Api Current Inventory Generate CSV');
    }
    
    Loader.show();
    
    $.ajax({
        url: "/CronJobs/amazon_generate_request_current_inventory",
        global : false,
    })
    .done(function(response)
    {
        if (response != "1")
        {
            Loader.hide();
            bootbox.alert(response);
            return;
        }
        
        wait(90, function (time)
        {
            $(".tf-loader-container .help-block").html('Cron Job Running : Wait ' + time + " seconds")
        },
        function()
        {
            $(".tf-loader-container .help-block").html('Cron Job Running : Current Inventory');
            
            $.ajax({
                url: "/CronJobs/amazon_current_inventory",
                global : false,
            })
            .done(function(response)
            {
                if (response != "1")
                {
                    Loader.hide();
                    bootbox.alert(response);
                    return;
                }
                
                onDone();
            })
            .fail(function()
            {
                bootbox.alert("Cron Job : Amazon Api Current Inventory : Falied");
            })
            .always(function() {
                Loader.hide();
                Loader.onShown = function() {};
            });
        });
    })
    .fail(function()
    {
        Loader.hide();
        bootbox.alert("Cron Job : Amazon Api Current Inventory Generate CSV : Falied");
    })
    .always(function() {
        Loader.onShown = function() {};
    });
}