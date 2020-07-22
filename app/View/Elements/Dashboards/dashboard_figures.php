<?php 
foreach($dashbaord_figures as $dashbaord_figure): 
    $figure = $dashbaord_figure["UserDashboardFigure"];
?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-v2 <?= $figure["bg_color"] ?>" href="<?= $figure["url"] ? $figure["url"] : "#" ?>">
        <div class="visual">
            <i class="<?= $figure["icon_class"] ?>"></i>
        </div>
        <div class="details">
            <div class="number">
                <span data-counter="counterup" data-value="<?= $figure["value"] ?>"><?= $figure["value"] ?></div>
            <div class="desc"> <?= $figure["name"] ?> </div>
        </div>
    </a>
</div>
<?php endforeach; ?>
