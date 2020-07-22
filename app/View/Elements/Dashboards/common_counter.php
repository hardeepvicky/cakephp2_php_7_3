<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat dashboard-stat-v2 red-sunglo" href="<?= $this->Html->url(array("controller" => "Issues", "action" => "admin_index", "link_user_id" => $auth_user["id"], "is_open" => 1)) ?>">
        <div class="visual">
            <i class="fa fa-bolt"></i>
        </div>
        <div class="details">
            <div class="number">
                <span data-counter="counterup" data-value="<?= $issue["pending_count"] ?>"><?= $issue["pending_count"] ?></div>
            <div class="desc"> Pending Issues </div>
        </div>
    </a>
</div>