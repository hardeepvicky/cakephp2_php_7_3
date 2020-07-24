<style>
    .page-header.navbar .page-logo .logo-default {
        margin-top: 0px;
        max-width: 166px;
        height : 47px;
    }
    
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu
    {
        max-width: 370px;
        width : 370px;
        border : 1px solid #b4bcc8;
        border-top : none;
    }
    
    .page-header.navbar .top-menu .navbar-nav>li.dropdown-user .dropdown-toggle>img
    {
        width : 30px;
    }
    
    .dropdown-menu-list li
    {
        width : 360px;
        padding: 10px;
        border-bottom: 1px solid #b4bcc8;
    }
    
    @media (max-width : 500px)
    {
        .page-header.navbar .top-menu .navbar-nav>li.dropdown-extended .dropdown-menu
        {
            max-width: 320px;
            width : 320px;
        }
        
        .dropdown-menu-list li
        {
            width : 300px;
        }
    }
    
    .dropdown-menu-list .title
    {
        font-weight: bold;
        font-size: 14px;        
    }
    
    .dropdown-menu-list .name
    {
        font-weight: bold;
        font-size: 11px;
        width : 56%;
        float: left;
    }
    
    .dropdown-menu-list .time
    {
        font-weight: bold;
        font-size: 10px;
        width : 40%;
        float: left;
        text-align: right;
    }
    
    .dropdown-menu-list .name-time
    {
        background-color : #EEE; 
        padding: 5px;
    }
    
    .dropdown-menu-list .detail
    {
        font-size: 12px;
        margin: 5px;
    }
    
    @media (max-width: 767px)
    {
        .page-header.navbar .top-menu .navbar-nav>li.dropdown-notification .dropdown-menu{
            margin-right: 0 !important;
        }
        
        .page-header.navbar .top-menu .navbar-nav>li.dropdown .dropdown-menu:after{
            right : -176px;
        }
    }
    
</style>
<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="<?= isset($home_link) ? $this->Html->url($home_link) : "/" ?>">
                <img src="/img/company_name.png" alt="logo" class="logo-default" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" id="notification-icon" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                        <i class="icon-bell"></i>
                        <?php if (isset($notification_unseen_count) && $notification_unseen_count): ?>
                            <span class="badge badge-default"><?= $notification_unseen_count ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu"> 
                        <?php if (isset($notifications)): ?>
                        <li>
                            <div id="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 500px;">
                                <ul id="notification-list" data-page="1" class="dropdown-menu-list scroller" style="height: 500px; overflow-y: auto; width: auto;" data-handle-color="#637283" data-initialized="1">
                                <?php foreach($notifications as $noti): ?>                         
                                    <li>
                                        <div class="title">                                            
                                            <?= $noti['Notification']['title'] ?>
                                        </div>
                                            
                                        <div class="detail"> 
                                            <?= $noti['Notification']['detail'] ?> 
                                        </div>
                                        
                                        <div class="name-time">
                                            <div class="name"> 
                                                <?php 
                                                if ($noti['Notification']['type'] == NOTI_FROM_USER)
                                                {
                                                    echo $noti['User']['name'] ;
                                                }
                                                else
                                                {
                                                    echo " &nbsp; ";
                                                }
                                                ?>     
                                            </div>
                                            <div class="time">
                                                <?= DateUtility::getDate($noti['Notification']['created'], DateUtility::DATETIME_OUT_FORMAT) ?>
                                            </div>
                                            <div style="clear:both;"></div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                </ul>                                
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                            
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?php if (isset($auth_user["profile_image"])) : ?>
                            <img alt="" class="img-circle" src="/<?= $auth_user["profile_image"] ? $auth_user["profile_image"] : "img/avatar.png" ?>">
                            <span class="username username-hide-on-mobile"> <?php echo trim($auth_user["firstname"] . " " . $auth_user["lastname"]); ?> </span>
                        <?php endif; ?>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <?php 
                                echo $this->Html->link("<i class='fa fa-lock'></i> Change Password", 
                                    array( "controller" => "users", "action" => "admin_change_password"),
                                    array( "escape" => false)
                                );
                            ?>
                        </li>
                        <li>
                            <a href="/users/logout"> <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"> </div>

<script type="text/javascript">
    var notification_loading = false;
    $(document).ready(function()
    {
        function load_notification()
        {
            var url = "/Users/get_notifications";

            var page = parseInt( $("ul#notification-list").attr("data-page") );
            page += 1;

            if ( page <= parseInt('<?= $notification_total_pages; ?>') && !notification_loading)
            {
                url += "/page:" + page;
                notification_loading = true;
                $.get(url, function (data)
                {
                    $("ul#notification-list").attr("data-page", page);
                    $("ul#notification-list").append(data);
                    notification_loading = false;
                });
            }
        }
        
        
        $("ul#notification-list").on('scroll', function() 
        {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) 
            {
                load_notification();
            }
        });
        
        $("#notification-icon").click(function ()
        {
            var _this = $(this);
            if ( _this.find(".badge").length > 0)
            {
                $.get("/Users/set_notification_seen", function(data)
                {
                    if (data == "1")
                    {
                        _this.find(".badge").remove();
                    }
                });
            }
        });
    });
    
</script>