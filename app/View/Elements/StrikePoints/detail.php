<div class="row">
    <div class="col-md-4 col-sm-6">
        <?php if ($record[$model]["photo"]): ?>
        <div class="masonary">
            <a class="fancybox box" href="<?= FileUtility::get($record[$model]["photo"]) ?>">
                <img src="<?= FileUtility::get($record[$model]["photo"]) ?>" style="width : 100%" />
            </a>
            <div style="clear: both"></div>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-md-3 col-sm-6">
        <?php
        if ($record[$model]["excel_file"]):
            echo pathInfo($record[$model]["excel_file"], PATHINFO_BASENAME);
            ?>
            <br/>
            <a href="<?= FileUtility::get($record[$model]["excel_file"]) ?>" download>
                Download Excel
            </a>
        <?php endif; ?>
    </div>
    <div class="col-md-4 col-sm-6">
        <?php if ($record[$model]["audio_file"]): ?>
            <audio controls>
                <source src="<?= FileUtility::get($record[$model]["audio_file"]) ?>">                                    
                Your browser does not support the audio element.
            </audio>

            <a href="<?= FileUtility::get($record[$model]["audio_file"]) ?>" download>
                Download Audio
            </a>
        <?php endif; ?>
    </div>
</div>