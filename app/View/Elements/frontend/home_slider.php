<?php if (isset($home_slides) && $home_slides): ?>
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
            <?php foreach($home_slides as $home_slide): ?>
            <div class="item-slick1" style="background-image: url(/<?= $home_slide["HomeSlide"]["image"] ?>);">
                <div class="container h-full">
                    <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                <?= $home_slide["HomeSlide"]["name"] ?>
                            </span>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                <?= $home_slide["HomeSlide"]["caption"] ?>
                            </h2>
                        </div>

                        <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                            <?= $home_slide["HomeSlide"]["detail"] ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>