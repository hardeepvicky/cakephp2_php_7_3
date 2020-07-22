<?php $quick_view = isset($quick_view) ? $quick_view : true; ?>
<div class="block2">            
    <div class="block2-pic hov-img0">
        <?php if ($product_group[0]["discount_per"]): ?>
            <span class="badge top-right badge-discount"> <?= $product_group[0]["discount_per"] ?>% off</span>
        <?php endif; ?>
            
        <?php if ($product_group[0]["stock"] <= 0) : ?>
            <img class="out-of-stock" src="/frontend/images/out-of-stock.png">
        <?php endif; ?>

        <img class="thumnail" src="<?= FileUtility::get($product_group["Image"]["thumbnail"]) ?>" alt="IMG-PRODUCT">
        
        <?php if ($quick_view): ?>
            <?php $url = $this->Html->url(array("controller" => "Pages", "action" => "getProductGroupDetail", $product_group["PG"]['id'])); ?>
            <a href="javascript:void(0);" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-product-modal ajax-loader"
               data-modal="#modal-product-group-<?= $product_group["PG"]['id'] ?>"
               data-loader-target="#modal-product-group-<?= $product_group["PG"]['id'] ?> .container" data-loader-href="<?= $url; ?>"
               >
                Quick View
            </a>
        <?php endif; ?>
    </div>

    <div id="modal-product-group-<?= $product_group["PG"]['id'] ?>" class="wrap-modal1 modal-product-group p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-product-modal"></div>
        <div class="container"></div>
    </div>

    <div class="block2-txt flex-w flex-t p-t-14">
        <div class="block2-txt-child1 flex-col-l ">
            <a href="/Pages/product_group_detail/<?= $product_group["PG"]["id"] ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                <?= $product_group["PG"]["frontend_title"] ?>
            </a>
        </div>

        <div class="block2-txt-child2 flex-r p-t-3">
            <a href="/Customers/ajaxLikeToggleProductGroup/<?= $product_group["PG"]["id"] ?>" data-is_like="<?= $product_group["0"]["is_like"] ?>" class="<?= $product_group["0"]["is_like"] ? "js-addedwish-b2" : "btn-addwish-b2" ?> dis-block pos-relative ajaxLikeToggleProductGroup">
                <img class="icon-heart1 dis-block trans-04" src="/frontend/images/icons/icon-heart-01.png" alt="ICON">
                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="/frontend/images/icons/icon-heart-02.png" alt="ICON">
            </a>
        </div>
    </div>    
    <div class="flex-w flex-sb-m">
        <div>
            <?= CURRENCY_SYMBOL ?> 
            <?php
            $product_group[0]["min_price"] = round($product_group[0]["min_price"]);
            $product_group[0]["max_price"] = round($product_group[0]["max_price"]);
            if ($product_group[0]["min_price"] == $product_group[0]["max_price"])
            {
                $price = $product_group[0]["min_price"];
                if ($product_group[0]["discount_per"])
                {
                    $price = $price - round($price * $product_group[0]["discount_per"] / 100);
                    echo $price . ' <span class="strike">' . $product_group[0]["min_price"] . '</span>';
                }
                else
                {
                    echo $price;
                }
            }
            else
            {
                echo $product_group[0]["min_price"] . " - " . $product_group[0]["max_price"];
            }
            ?>
        </div>
        <span class="stext-105 cl3">
            Stock : <?= $product_group[0]["stock"] ?>
        </span>
    </div>
    <div>
        <?= $this->element("frontend/rating_star_public_view", array(
            "id" => "rating-star-" . $product_group["PG"]["id"],
            "value" => ceil($product_group[0]["rating"]),
            "count" => $product_group[0]["rating_user_count"],
        ));
        ?>
    </div>
</div>