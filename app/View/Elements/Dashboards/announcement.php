<style>
    .mt-comment-text .masonary
    {
        padding: 5px;
        column-gap: 10px;
    }
    
    .mt-comment-text .masonary .box
    {
        padding: 5px;
    }
</style>
<div class="portlet light bordered">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="icon-bubbles font-dark hide"></i>
            <span class="caption-subject font-dark bold uppercase">Announcements</span>
        </div>
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#announcements_new" data-toggle="tab" aria-expanded="true"> New </a>
            </li>
            <li class="">
                <a href="#announcements_old" data-toggle="tab" aria-expanded="false"> Old </a>
            </li>
        </ul>
    </div>
    <div class="portlet-body">
        <div class="tab-content">
            <div class="tab-pane active" id="announcements_new">
                <!-- BEGIN: Comments -->
                <div class="mt-comments">
                    <?php $announcement_first = null; foreach($announcement_new as $id => $record): 
                        if (!$record["Announcement"]["is_seen"] && !$announcement_first)
                        {
                            $announcement_first = $record;
                        }
                    ?>
                    <div class="mt-comment">
                        <div class="mt-comment-img">
                        </div>
                        <div class="mt-comment-body">
                            <div class="mt-comment-info">
                                <span class="mt-comment-author"><?= $record["Announcement"]["name"] ?></span>
                                <span class="mt-comment-date">
                                    <?= $record["Announcement"]["created_by"] ?><br/>
                                    <?= DateUtility::getDate($record["Announcement"]["created"], DateUtility::DATETIME_OUT_FORMAT) ?>
                                </span>
                            </div>
                            <div class="mt-comment-text"> 
                                <?= $record["Announcement"]["detail"] ?> 
                                <?php if ($record["AnnouncementImage"]): ?>
                                <div class="masonary">
                                    <?php foreach($record["AnnouncementImage"] as $file): ?>
                                    <div class="box">
                                        <a class="fancybox" href="/<?= $file['image'] ?>" data-fancybox="group-<?= $id ?>">
                                            <img class="main-img" src="/<?= $file['thumbnail'] ?>">
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                    <div style="clear: both"></div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="mt-comment-details">
                                <ul class="mt-comment-actions">
                                    <li>
                                        <?= $this->Html->link("VIEW", array("controller" => "Announcements", "action" => "admin_view", $record["Announcement"]["id"])) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>                    
                </div>
                <!-- END: Comments -->
            </div>
            <div class="tab-pane" id="announcements_old">
                <!-- BEGIN: Comments -->
                <div class="mt-comments">
                    <?php foreach($announcement_old as $record): ?>
                    <div class="mt-comment">
                        <div class="mt-comment-img">
                        </div>
                        <div class="mt-comment-body">
                            <div class="mt-comment-info">
                                <span class="mt-comment-author"><?= $record["Announcement"]["name"] ?></span>
                                <span class="mt-comment-date">
                                    <?= $record["Announcement"]["created_by"] ?><br/>
                                    <?= DateUtility::getDate($record["Announcement"]["created"], DateUtility::DATETIME_OUT_FORMAT) ?>
                                </span>
                            </div>
                            <div class="mt-comment-text"> 
                                <?= $record["Announcement"]["detail"] ?> 
                                <div class="masonary" >
                                    <?php foreach($record["AnnouncementImage"] as $file): ?>
                                    <div class="box">
                                        <a class="fancybox" href="/<?= $file['image'] ?>" data-fancybox="group-<?= $id ?>">
                                            <img class="main-img" src="/<?= $file['image'] ?>">
                                        </a>
                                    </div>
                                    <?php endforeach; ?>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                            <div class="mt-comment-details">
                                <ul class="mt-comment-actions">
                                    <li>
                                        <?= $this->Html->link("VIEW", array("controller" => "Announcements", "action" => "admin_view", $record["Announcement"]["id"])) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?> 
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($announcement_first): ?>
<div class="modal fade " id="modal-announcement-flash" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <table style="width : 90%">
                        <tr>
                            <td style="width:75%;">
                                New Announcement By <?= $announcement_first["Announcement"]["created_by"] ?>
                            </td>
                            <td>
                                <span class="label label-default">Date : <?= DateUtility::getDate($announcement_first["Announcement"]["created"], DateUtility::DATETIME_OUT_FORMAT) ?></span><br/>
                                <span class="label label-primary">Priority : <?= $announcement_first["Announcement"]["priority"] ?></span>
                            </td>
                        </tr>
                    </table>
                </h4>
            </div>
            <div class="modal-body">
                <?= $this->element("Announcements/view", array("record" => $announcement_first)) ?>
            </div>            
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        var url = "/Announcements/ajaxSeen/" + '<?= $announcement_first["Announcement"]["id"] ?>';
        
        $.get(url, function(response)
        {
            if (response != "1")
            {
                bootbox.alert(response);
            }
            else
            {
                $("#modal-announcement-flash").modal("show");
            }
        });
    });
</script>
<?php endif; ?>