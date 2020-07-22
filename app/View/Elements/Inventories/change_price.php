<div id="modal-product-gst" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Product GST</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <span class="btn blue save">Save</span>
            </div>
        </div>
    </div>
</div>

<div id="modal-product-price" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Product Price</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <span class="btn blue save">Save</span>
            </div>
        </div>
    </div>
</div>

<div id="modal-product-price-list" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Price</h4>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: scroll;">
                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function _change_inventory_detail_rate_gst(_modal, inventory_detail_id, data, callback)
    {
        if (inventory_detail_id)
        {
            $.post("/Inventories/ajaxChangeInventoryDetailRateAndGst/" + inventory_detail_id, data, function(response, status)
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
                    _modal.modal('hide');
                    callback(data);
                }
                else
                {
                    bootbox.alert(response["msg"]);
                }
            });
        }
        else
        {
            _modal.modal('hide');
            callback(data);
        }
    }
    
    function change_product_gst(inventory_detail_id, post_data, callback)
    {
        var _modal = $('#modal-product-gst');        
        _modal.find(".modal-title").html("Change " + post_data["product_name"] + "'s GST ");
        _modal.find(".modal-body").load("/Inventories/change_gst_html", post_data,  function()
        {
            _modal.modal('show');
            if (_modal.find("input.product_id").length == 0)
            {
                return;
            }

            _modal.find(".save").unbind("click").bind("click", function()
            {
                _modal.find(".error-message").remove();

                if (!_modal.find("input.gst_per").val())
                {
                    _modal.find("input.gst_per").parent().append('<span class="error-message">Please Enter</span>');
                    return false;
                }

                var data = _modal.find("form").serialize();
                $.post("/Products/ajaxGstSave", data, function(response, status)
                {
                    if (status != "success")
                    {
                        bootbox.alert(response);
                        return;
                    }

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
                        _change_inventory_detail_rate_gst(_modal, inventory_detail_id, {gst_per : response["gst_per"]}, callback);
                    }
                    else
                    {
                        bootbox.alert(response["msg"]);
                        for(var field in response["errors"])
                        {
                            var error = response["errors"][field][0];
                            _modal.find("span." + field).parent().append('<span class="error-message">' + error + '</span>');
                        }
                    }

                }).fail(function()
                {
                    bootbox.alert("Request Failed, Please try again later");
                });
            });
        });
    }
    
    function change_product_sale_price(inventory_detail_id, post_data, callback)
    {
        var _modal = $('#modal-product-price');        
        _modal.find(".modal-title").html("Change " + post_data["product_name"] + "'s Sale Price");
        _modal.find(".modal-body").load("/Inventories/change_price_html", post_data,  function()
        {
            _modal.modal('show');
            
            if (_modal.find("input.product_id").length == 0)
            {
                return;
            }

            _modal.find(".save").unbind("click").bind("click", function()
            {
                _modal.find(".error-message").remove();

                var actual_price = _modal.find("input.price").val();
                if (!actual_price)
                {
                    _modal.find("input.price").parent().append('<span class="error-message">Please Enter</span>');
                    return false;
                }

                var data = _modal.find("form").serialize();
                $.post("/ProductSalePrices/ajaxAdd", data, function(response, status)
                {
                    if (status != "success")
                    {
                        bootbox.alert(response);
                        return;
                    }

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
                        _change_inventory_detail_rate_gst(_modal, inventory_detail_id, {rate : response["price"], actual_rate : actual_price}, callback);
                    }
                    else
                    {
                        bootbox.alert(response["msg"]);
                        for(var field in response["errors"])
                        {
                            var error = response["errors"][field][0];
                            _modal.find("span." + field).parent().append('<span class="error-message">' + error + '</span>');
                        }
                    }

                }).fail(function()
                {
                    bootbox.alert("Request Failed, Please try again later");
                });
            });
        });
    }
    
    function change_product_party_sale_price(inventory_detail_id, post_data, callback)
    {
        var _modal = $('#modal-product-price');
        _modal.find(".modal-title").html("Change " + post_data["product_name"] + "'s Sale Price of Party " + post_data["party_name"]);
        _modal.find(".modal-body").load("/Inventories/change_party_price_html", post_data, function()
        {
            _modal.modal('show');
            
            if (_modal.find("input.product_id").length == 0)
            {
                return;
            }

            _modal.find(".save").unbind("click").bind("click", function()
            {
                _modal.find(".error-message").remove();

                var actual_price = _modal.find("input.price").val();
                if (!actual_price)
                {
                    _modal.find("input.price").parent().append('<span class="error-message">Please Enter</span>');
                    return false;
                }

                var data = _modal.find("form").serialize();
                $.post("/ProductSaleThirdPartyPrices/ajaxAdd", data, function(response, status)
                {
                    if (status != "success")
                    {
                        bootbox.alert(response);
                        return;
                    }

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
                        _change_inventory_detail_rate_gst(_modal, inventory_detail_id, {rate : response["price"], actual_rate : actual_price}, callback);
                    }
                    else
                    {
                        bootbox.alert(response["msg"]);
                        for(var field in response["errors"])
                        {
                            var error = response["errors"][field][0];
                            _modal.find("span." + field).parent().append('<span class="error-message">' + error + '</span>');
                        }
                    }

                }).fail(function()
                {
                    bootbox.alert("Request Failed, Please try again later");
                });
            });

            
        });
    }
    
    function change_product_cost_price(inventory_detail_id, post_data, callback)
    {
        var _modal = $('#modal-product-price');        
        _modal.find(".modal-title").html("Change " + post_data["product_name"] + "'s Cost Price");
        _modal.find(".modal-body").load("/Inventories/change_price_html", post_data,  function()
        {
            _modal.modal('show');
            
            if (_modal.find("input.product_id").length == 0)
            {
                return;
            }

            _modal.find(".save").unbind("click").bind("click", function()
            {
                _modal.find(".error-message").remove();

                var actual_price = _modal.find("input.price").val();
                if (!actual_price)
                {
                    _modal.find("input.price").parent().append('<span class="error-message">Please Enter</span>');
                    return false;
                }

                var data = _modal.find("form").serialize();
                $.post("/ProductCostPrices/ajaxAdd", data, function(response, status)
                {
                    if (status != "success")
                    {
                        bootbox.alert(response);
                        return;
                    }

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
                        _change_inventory_detail_rate_gst(_modal, inventory_detail_id, {rate : response["price"], actual_rate : actual_price}, callback);
                    }
                    else
                    {
                        bootbox.alert(response["msg"]);
                        for(var field in response["errors"])
                        {
                            var error = response["errors"][field][0];
                            _modal.find("span." + field).parent().append('<span class="error-message">' + error + '</span>');
                        }
                    }

                }).fail(function()
                {
                    bootbox.alert("Request Failed, Please try again later");
                });
            });
        });
    }
    
    function change_product_party_cost_price(inventory_detail_id, post_data, callback)
    {
        var _modal = $('#modal-product-price');
        _modal.find(".modal-title").html("Change " + post_data["product_name"] + "'s Cost Price of Party " + post_data["party_name"]);
        _modal.find(".modal-body").load("/Inventories/change_party_price_html", post_data, function()
        {
            _modal.modal('show');
            
            if (_modal.find("input.product_id").length == 0)
            {
                return;
            }

            _modal.find(".save").unbind("click").bind("click", function()
            {
                _modal.find(".error-message").remove();

                var actual_price = _modal.find("input.price").val();
                if (!actual_price)
                {
                    _modal.find("input.price").parent().append('<span class="error-message">Please Enter</span>');
                    return false;
                }

                var data = _modal.find("form").serialize();
                $.post("/ProductCostThirdPartyPrices/ajaxAdd", data, function(response, status)
                {
                    if (status != "success")
                    {
                        bootbox.alert(response);
                        return;
                    }

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
                        _change_inventory_detail_rate_gst(_modal, inventory_detail_id, {rate : response["price"], actual_rate : actual_price}, callback);
                    }
                    else
                    {
                        bootbox.alert(response["msg"]);
                        for(var field in response["errors"])
                        {
                            var error = response["errors"][field][0];
                            _modal.find("span." + field).parent().append('<span class="error-message">' + error + '</span>');
                        }
                    }

                }).fail(function()
                {
                    bootbox.alert("Request Failed, Please try again later");
                });
            });
        });
    }
    
    function show_product_sale_price(data)
    {
        var _modal = $("div#modal-product-price-list");
        _modal.find(".modal-title").html(data["product_name"] + " 's Sale Price List");
        _modal.find(".modal-body").load("/ProductSalePrices/ajaxIndex", data, function()
        {
            _modal.modal("show");
        });
    }
    
    function show_product_cost_price(data)
    {
        var _modal = $("div#modal-product-price-list");
        _modal.find(".modal-title").html(data["product_name"] + " 's Cost Price List");
        _modal.find(".modal-body").load("/ProductCostPrices/ajaxIndex", data, function()
        {
            _modal.modal("show");
        });
    }
    
    function show_product_party_sale_price(data)
    {
        var _modal = $("div#modal-product-price-list");
        _modal.find(".modal-title").html(data["product_name"] + " 's Sale Price List of Party " + data["party_name"]);
        _modal.find(".modal-body").load("/ProductSaleThirdPartyPrices/ajaxIndex", data, function()
        {
            _modal.modal("show");
        });
    }
    
    function show_product_party_cost_price(data)
    {
        var _modal = $("div#modal-product-price-list");
        _modal.find(".modal-title").html(data["product_name"] + " 's Cost Price List of Party " + data["party_name"]);
        _modal.find(".modal-body").load("/ProductCostThirdPartyPrices/ajaxIndex", data, function()
        {
            _modal.modal("show");
        });
    }
</script>