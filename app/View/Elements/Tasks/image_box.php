<?php foreach($files as $id => $file): ?>
<div class="col-md-4 col-sm-6 col-xs-12 image-box">
    <div class="portlet light">        
        <span class="cross-btn badge badge-default" data-task_image_id="<?php echo isset($not_in_form) ? $id : "" ?>">
            X 
        </span>
        <div class="portlet-body">
            <a href="<?= "/" . $file ?>" class="fancybox" data-fancybox="group">
                <img src="<?= "/" . $file ?>" />
            </a>
            <?php if (!isset($not_in_form)) : ?>
                <input type="hidden" name="images[]" value="<?= $file ?>" />
            <?php endif; ?>
        </div>
    </div>
</div>
<?php endforeach; ?>