<div class="modal fade pop-up" id="login-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var Login = {
        selector : "#login-modal",
        user : JSON.parse('<?= json_encode(isset($auth_user) ? $auth_user : array()) ?>'),
        show : function()
        {            
            if ($(Login.selector).find(".modal-body").html().trim().length == 0)
            {
                $(Login.selector).find(".modal-body").load("/Customers/login", function()
                {
                    $(Login.selector).modal("show");
                });
            }
            else
            {
                $(Login.selector).modal("show");
            }
        },
        onError: function(url, errorObj)
        {
            $("#error-modal .modal-title").html(errorObj.statusText);
            $("#error-modal .modal-body").html(errorObj.status.toString());
            $("#error-modal").modal("show");
            
            var data = {
                url : url,
                error_msg : errorObj.statusText,
                error_code : errorObj.status,
                error_detail : errorObj.responseText,
                auth : Login.user
            };
            
            $.post("/Logs/ajaxSaveFrontendErrors", data, function(response)
            {
                try
                {
                    response = JSON.parse(response);
                }
                catch(e)
                {
                    console.log(response);
                }
                
                if (response["status"] == 0)
                {
                    swal("", response["msg"], "error");
                }
            });
        },
        hide : function()
        {
            $(Login.selector).modal("hide");
        },
        onLogin : function(){
            
        },
        onLikeProductGroup : function(obj) {
            var count = parseInt($(".favourite-product-group-count").attr("data-notify"));
            count++;
            $(".favourite-product-group-count").attr("data-notify", count);
        },
        onDisLikeProductGroup : function(obj) {
            var count = parseInt($(".favourite-product-group-count").attr("data-notify"));
            count--;
            $(".favourite-product-group-count").attr("data-notify", count);
        },
    };
</script>

<div class="modal fade pop-up" id="customer-address-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var CustomerAddress = {
        selector : "#customer-address-modal",
        show : function(id)
        {         
            if (typeof id == "undefined")
            {
                id = 0;
            }

            $(CustomerAddress.selector).find(".modal-body").load("/Customers/customerAddress/" + id, function()
            {
                $(CustomerAddress.selector).modal("show");
            });
        },
        hide : function()
        {
            $(CustomerAddress.selector).modal("hide");
        },
        onGet : function()
        {
        },
        onSave : function()
        {
        }
    };
    
    var Cart = {
        add : function(product_id, qty)
        {
            var url = "/Customers/ajaxCartAddProduct/" + product_id + "/" + qty;
            $.get(url, function(response)
            {
                if (response == "1")
                {
                    Cart.update();
                    swal("", "Product is added to Cart", "success");
                }
                else
                {
                    $("#error-modal .modal-body").html(response);    $("#error-modal").modal("show");
                }
            })
            .fail(function(errorObj) 
            {
                Login.onError(url, errorObj);
            });
        },
        update : function()
        {
            $(".js-panel-cart .header-cart-content").load("/Customers/cartPopup");
        },
        onDown : function() {},
        onUp : function() {},
    };
</script>

<div class="modal fade pop-up" id="product-review-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" style="background: transparent;">
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var ProductReview = {
        selector : "#product-review-modal",
        show : function(id)
        {         
            if (typeof id == "undefined")
            {
                id = 0;
            }

            $(ProductReview.selector).find(".modal-body").load("/Customers/orderProductReview/" + id, function()
            {
                $(ProductReview.selector).modal("show");
            });
        },
        hide : function()
        {
            $(ProductReview.selector).modal("hide");
        },
        onSave : function(){
            
        },
        likeToggle : function(id, active, callbk)
        {
            ProductReview.voteToggle(id, "is_like", active, callbk);
        },
        disLikeToggle : function(id, active, callbk)
        {
            ProductReview.voteToggle(id, "is_dislike", active, callbk);
        },
        voteToggle : function(id, field, active, callbk)
        {
            active = active ? 1 : 0;
            var url = "/Customers/ajaxCustomerOrderProductReviewVoteToggle/" + id + "/" + field + "/" + active;
            $.get(url, function(response)
            {
                try
                {
                    response = JSON.parse(response);
                }
                catch(e)
                {
                    $("#error-modal .modal-body").html(response); $("#error-modal").modal("show");
                }

                if (response["status"] == "1")
                {
                    callbk(response["data"]);
                }
                else
                {
                    swal("", response["msg"], "error");
                }
            })
            .fail(function(errorObj) 
            {
                Login.onError(url, errorObj);
            });
        }
    };
</script>