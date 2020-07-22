<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
    <button class="how-pos3 hov3 trans-04 js-hide-product-modal">
        <img src="/frontend/images/icons/icon-close.png" alt="CLOSE">
    </button>

    <div class="row">
        <div class="col-md-6 col-lg-7 p-b-30">
            <div class="p-l-25 p-r-30 p-lr-0-lg">
                <div class="wrap-slick3 flex-sb flex-w">
                    <div class="wrap-slick3-dots"></div>
                    <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5 p-b-30">
            <div class="p-r-50 p-t-5 p-lr-0-lg">
                <h4 class="mtext-105 cl2 js-name-detail p-b-14 product-title">
                    <?= $product_group["ProductGroup"]["frontend_title"] ?>
                </h4>

                <span class="mtext-106 cl2">
                    <p class="p-b-5">
                        MRP : <?= CURRENCY_SYMBOL ?> <span class="product-price"></span>
                    </p>
                    <p class="p-b-5 actual-price-block">
                        Current Price : <?= CURRENCY_SYMBOL ?> <span class="actual-price"></span> <span class="discount stext-108"></span>
                    </p>
                </span>

                <p class="stext-102 cl3 p-t-23 product-desc">
                    <?= $product_group["ProductGroup"]["details"] ?>
                </p>

                <!--  -->
                <div class="p-t-30">
                    <div class="flex-w flex-l-m p-b-10">
                        <div class="respon6" style="width : 50px;">
                            Size
                        </div>

                        <div class="respon6-next" style="width : 60%;">
                            <div class="rs1-select2 bor8 bg0">
                                <select class="js-select2 size_type_id">
                                    <?php foreach ($size_list as $size_id => $name): ?>
                                        <?php if ($select_size_id == $size_id): ?>
                                            <option value="<?= $size_id ?>" selected="selected"><?= $name ?></option>
                                        <?php else: ?>
                                            <option value="<?= $size_id ?>"><?= $name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="respon6-next p-l-10">
                            <?php if ($product_group["Category"]["size_chart"]): ?>
                                <a href="/<?= $product_group["Category"]["size_chart"] ?>" target="_blank">Size Chart</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="flex-w flex-l-m p-b-10">
                        <div class="respon6" style="width : 50px;">
                            Color
                        </div>

                        <div class="respon6-next" style="width : 60%;">
                            <div class="rs1-select2 bor8 bg0">
                                <select class="js-select2 color_type_id">
                                    <?php foreach ($color_list as $color_id => $name): ?>
                                        <?php if ($select_color_id == $color_id): ?>
                                            <option value="<?= $color_id ?>" selected="selected"><?= $name ?></option>
                                        <?php else: ?>
                                            <option value="<?= $color_id ?>"><?= $name ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex-w flex-r-m p-b-10 add-to-cart-block" style="display: none;">
                        <div class="size-204 flex-w flex-m respon6-next">
                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                </div>

                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="product-count" value="1">

                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                </div>
                            </div>

                            <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                Add to cart
                            </button>
                        </div>
                    </div>	
                    <div class="out-of-stock-block" style="display: none;">
                        <span class="stext-102 c-red">Product is out of Stock</span>
                        <button class="btn-shiny out-of-stock-notify-me">Notify me</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">        
    $(document).ready(function()
    {
        var products = JSON.parse('<?= json_encode($products) ?>');
        var photoshoot_model_list = JSON.parse('<?= json_encode($photoshoot_model_list) ?>');
        var _modal = $("#modal-product-group-<?= $product_group["ProductGroup"]['id'] ?>");

        function load_product_detail()
        {
            var size = _modal.find(".size_type_id").val();
            var color = _modal.find(".color_type_id").val();

            if (typeof products[size] == "undefined" || typeof products[size][color] == "undefined")
            {
                swal("", "This combination of Size and color is present", "error");
                return;
            }
            
            var product = products[size][color];
            
            var keys = Object.keys(product);
            product = product[keys[0]];
            console.log(product);
            
            var price = product["price"] - (product["price"] * product["discount_per"] / 100);
            
            _modal.find(".product-price").html(product["price"]);
            
            if ( product["price"] == product["actual_price"])
            {
                _modal.find(".actual-price-block").hide();
            }
            else
            {
                _modal.find(".actual-price-block .actual-price").html(price);
                _modal.find(".actual-price-block .discount").html("(" + product["discount_per"] + "% Discount)");
                _modal.find(".actual-price-block").show();
            }
            
            if (product["stock"] <= 0)
            {
                _modal.find(".out-of-stock-block").show();
                _modal.find(".add-to-cart-block").hide();
            }
            else
            {
                _modal.find(".out-of-stock-block").hide();
                _modal.find(".add-to-cart-block").show();
            }
            
            _modal.find(".js-addcart-detail").attr("data-product_id", product["id"]);
            _modal.find("button.out-of-stock-notify-me").attr("data-product_id", product["id"]);
            
            var html = "";
            
            html +='<div class="wrap-slick3-dots"></div>';
            html += '<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>';
            html += '<div class="slick3 gallery-lb">';
            for(var i in product["Image"])
            {
                var image = product["Image"][i];

                html += '<div class="item-slick3" data-thumb="' + image["thumbnail"] + '">';
                    html += '<div class="wrap-pic-w pos-relative">';
                        html += '<img src="' + image["image"] + '" alt="IMG-PRODUCT">';
                        
                        if (image["photoshoot_model_id"] && typeof photoshoot_model_list[image["photoshoot_model_id"]] != "undefined")
                        {
                            html += '<span class="photoshoot-model-detail">' + photoshoot_model_list[image["photoshoot_model_id"]] + '</span>';
                        }

                        html += '<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="' + image["image"] + '">';
                            html += '<i class="fa fa-expand"></i>';
                        html += '</a>';
                    html += '</div>';
                html += '</div>';
            }

            html += '</div>';

            _modal.find(".wrap-slick3").html(html);
            
            _modal.find('.wrap-slick3').each(function()
            {
                $(this).find('.slick3').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    fade: true,
                    infinite: true,
                    autoplay: false,
                    autoplaySpeed: 6000,

                    arrows: true,
                    appendArrows: $(this).find('.wrap-slick3-arrows'),
                    prevArrow:'<button class="arrow-slick3 prev-slick3"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                    nextArrow:'<button class="arrow-slick3 next-slick3"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',

                    dots: true,
                    appendDots: $(this).find('.wrap-slick3-dots'),
                    dotsClass:'slick3-dots',
                    customPaging: function(slick, index) {
                        var portrait = $(slick.$slides[index]).data('thumb');
                        return '<img src=" ' + portrait + ' "/><div class="slick3-dot-overlay"></div>';
                    },  
                });
            });
        
            _modal.find('.gallery-lb').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    mainClass: 'mfp-fade'
                });
            });  
            
            if ($("#product-feature-list").length > 0)
            {
                $("#product-feature-list").load("/Pages/ajaxProductFeatures/" + product["id"]);
            }
        }

        _modal.find(".size_type_id, .color_type_id").change(function()
        {
            load_product_detail();
        });

        load_product_detail();
        
        $(".js-select2").select2();
    });
</script>