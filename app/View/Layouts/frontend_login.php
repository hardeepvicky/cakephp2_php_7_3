<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->element("frontend/head_scripts"); ?>
    </head>
    <body class="animsition">

        <!-- Header -->
        <header class="header-v4">
            <!-- Header desktop -->
            <div class="container-menu-desktop">
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
                                    );
                                    
                                    foreach($menus as $link_action => $name):
                                        
                                        $cls = $action == $link_action ? "active-menu" : "";
                                ?>
                                    <li class="<?= $cls ?>">
                                        <?= $this->Html->link($name, array("controller" => "Pages",  "action" => $link_action, "admin" => false)) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>	
                    </nav>
                </div>	
            </div>

            <!-- Header Mobile -->
            <div class="wrap-header-mobile">
                <!-- Logo moblie -->		
                <div class="logo-mobile">
                    <a href="/"><img src="/frontend/images/icons/logo-01.png" alt="IMG-LOGO"></a>
                </div>

                <!-- Button show menu -->
                <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div class="menu-mobile">
                <ul class="main-menu-m">
                    <ul class="main-menu">
                        <?php
                            $menus = array(
                                "index" => "Home",
                                "shop" => "Shop",
                                "about" => "About Us",
                                "contact" => "Contact",
                            );

                            foreach($menus as $link_action => $name):

                                $cls = $action == $link_action ? "active-menu" : "";
                        ?>
                            <li class="<?= $cls ?>">
                                <?= $this->Html->link($name, array("controller" => "Pages",  "action" => $link_action, "admin" => false)) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </ul>
            </div>

        </header>

        <?php echo $this->Session->flash(); ?>
        
        <?= $this->fetch("content"); ?>

        <?= $this->element("frontend/popup") ?>
        
        <?= $this->element("frontend/footer") ?>
        
        <?= $this->element("frontend/foot_scripts"); ?>    
    </body>
</html>