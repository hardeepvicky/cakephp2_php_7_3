<h3><b><?= $record["Announcement"]["name"] ?></b></h3>
<h5><?= $record["Announcement"]["detail"] ?></h5>

<?php if ( $record['AnnouncementImage'] ): ?>
<div class="masonary">
    <?php foreach ($record['AnnouncementImage'] as $file): ?>
    <div class="box">
        <a class="fancybox" href="/<?= $file['image'] ?>" data-fancybox="group">
            <img class="main-img" src="/<?= $file['thumbnail'] ?>">
        </a>
    </div>
    <?php endforeach; ?>
    <div style="clear: both"></div>
</div>
<?php endif; ?>