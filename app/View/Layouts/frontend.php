<!DOCTYPE html>
<html lang="en">
    <head>        
        <?= $this->element("frontend/head_scriprs"); ?>
    </head>
    <body class="animsition">

        <!-- Header -->
        <header class="header-v4">
            <!-- Header desktop -->
            <div class="container-menu-desktop">
                <!-- Topbar -->
                <div class="top-bar">
                    <div class="content-topbar flex-sb-m h-full container">
                        <div class="left-top-bar">
                            Free shipping for standard order over $100
                        </div>

                        <div class="right-top-bar flex-w h-full">
                            <a href="#" class="flex-c-m trans-04 p-lr-25">
                                Help & FAQs
                            </a>

                            <?php if ($auth_user): ?>
                                <a href="<?= $this->Html->url(array("controller" => "Customers" , "action" => "myAccount")); ?>" class="flex-c-m trans-04 p-lr-25">
                                    <?= $auth_user["name"] ?>
                                </a>
                            <?php else : ?>
                                <a href="<?= $this->Html->url(array("controller" => "Customers" , "action" => "login")); ?>" class="flex-c-m trans-04 p-lr-25">
                                    My Account
                                </a>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>

                <div class="wrap-menu-desktop">
                    <nav class="limiter-menu-desktop container">

                        <!-- Logo desktop -->		
                        <a href="/" class="logo">
                            <img src="/frontend/images/icons/logo-01.png" alt="IMG-LOGO">
                        </a>

                        <!-- Menu desktop -->
                        <div class="menu-desktop">
                            <ul class="main-menu">
                                <?php
                                    $menus = array(
                                        "index" => "Home",
                                        "shop" => "Shop",
                                        "about" => "About Us",
                                        "contact" => "Contact",
                                        "jobs" => "Jobs",
                                    );
                                    
                                    foreach($menus as $link_action => $name):
                                        
                                        $cls = $action == $link_action ? "active-menu" : "";
                                ?>
                                    <li class="<?= $cls ?>">
                                        <?= $this->Html->link($name, array("controller" => "Pages", "action" => $link_action)) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>	

                        <?php if($auth_user && isset($cart_products)): ?>
                        <div class="wrap-icon-header flex-w flex-r-m">
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="<?= $wallet; ?>">
                                <img src="/frontend/images/icons/wallet-black-and-white.png">
                            </div>
                            
                            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?= count($cart_products); ?>">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>

                            <a href="/Customers/myFavourites" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti favourite-product-group-count" data-notify="<?= $my_favourite_product_group_count ?>">
                                <i class="zmdi zmdi-favorite-outline"></i>
                            </a>
                        </div>
                        <?php endif; ?>
                    </nav>
                </div>	
            </div>

            <!-- Header Mobile -->
            <div class="wrap-header-mobile">
                <!-- Logo moblie -->		
                <div class="logo-mobile">
                    <a href="/"><img src="/frontend/images/icons/logo-01.png" alt="IMG-LOGO"></a>
                </div>

                <?php if($auth_user && isset($cart_products)): ?>
                <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="<?= $wallet; ?>">
                        <img src="/frontend/images/icons/wallet-black-and-white.png">
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?= count($cart_products); ?>">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="/Customers/myFavourites" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti favourite-product-group-count" data-notify="<?= $my_favourite_product_group_count ?>">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
                <?php endif; ?>

                <!-- Button show menu -->
                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>


            <!-- Menu Mobile -->
            <div class="menu-mobile">
                <ul class="topbar-mobile">
                    <li>
                        <div class="left-top-bar">
                            Free shipping for standard order over $100
                        </div>
                    </li>

                    <li>
                        <div class="right-top-bar flex-w h-full">
                            <a href="#" class="flex-c-m p-lr-10 trans-04">
                                Help & FAQs
                            </a>

                           <?php if ($auth_user): ?>
                                <a href="<?= $this->Html->url(array("controller" => "Customers" , "action" => "myAccount")); ?>" class="flex-c-m trans-04 p-lr-25">
                                    <?= $auth_user["name"] ?>
                                </a>
                            <?php else : ?>
                                <a href="<?= $this->Html->url(array("controller" => "Customers" , "action" => "login")); ?>" class="flex-c-m trans-04 p-lr-25">
                                    My Account
                                </a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>

                <ul class="main-menu-m">
                    <ul class="main-menu">
                        <?php
                            foreach($menus as $link_action => $name):

                                $cls = $action == $link_action ? "active-menu" : "";
                        ?>
                            <li class="<?= $cls ?>">
                                <?= $this->Html->link($name, array("controller" => "Pages", "action" => $link_action)) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </ul>
            </div>

            <!-- Modal Search -->
            <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
                <div class="container-search-header">
                    <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                        <img src="/frontend/images/icons/icon-close2.png" alt="CLOSE">
                    </button>

                    <form class="wrap-search-header flex-w p-l-15">
                        <button class="flex-c-m trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        <input class="plh3" type="text" name="search" placeholder="Search...">
                    </form>
                </div>
            </div>
        </header>

        <?= $this->element("frontend/cart") ?>

        <?php echo $this->Session->flash(); ?>
        
        <?= $this->fetch("content"); ?>
        
        <?= $this->element("frontend/popup") ?>
        
        <?= $this->element("frontend/footer") ?>

        <?= $this->element("frontend/foot_scripts"); ?>    
    </body>
</html>