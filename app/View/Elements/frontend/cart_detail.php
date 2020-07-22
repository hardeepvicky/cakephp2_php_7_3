<ul class="header-cart-wrapitem w-full">
    <?php
    $total = 0;
    foreach ($cart_products as $cart_product):

        $total += ($cart_product["qty"] * $cart_product["actual_price"]);
        ?>
        <li class="header-cart-item flex-w flex-t m-b-12">
            <div class="header-cart-item-img">
                <img src="/<?= $cart_product["thumbnail"] ?>" alt="IMG">
            </div>

            <div class="header-cart-item-txt p-t-8">
                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                    <?= $cart_product["product_name"] ?>
                </a>

                <span class="header-cart-item-info">
                    <?= $cart_product["qty"] ?> x <?= CURRENCY_SYMBOL ?> 
                    <?php if ($cart_product["price"] == $cart_product["actual_price"]): ?>
                        <?= $cart_product["price"] ?>
                    <?php else: ?>
                        <?= $cart_product["actual_price"] ?> <span class="strike"><?= $cart_product["price"] ?></span>
                    <?php endif; ?>
                </span>
            </div>
        </li>
<?php endforeach; ?>
</ul>

<div class="w-full">
    <div class="header-cart-total w-full p-tb-40">
        Total: <?= CURRENCY_SYMBOL ?> <?= $total ?>
    </div>

    <div class="header-cart-buttons flex-w w-full">
        <a href="<?= $this->Html->url(array("controller" => "Customers", "action" => "cart")) ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
            Checkout
        </a>
    </div>
</div>

<script type="text/javascript">
    $(".js-show-cart").attr("data-notify", <?= count($cart_products); ?>);
</script>