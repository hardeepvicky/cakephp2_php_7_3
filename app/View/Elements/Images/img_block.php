<div class="img-block">            
    <div class="img-container">
        <a class="delete-img img-icon cross-btn" href="<?= $this->Html->url(array("action" => "admin_delete", $record[$model]['id'], 1)); ?>">
            <i class="fa fa-trash"></i>
        </a>
        <a class="img-icon edit-btn" href="<?= $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>">
            <i class="fa fa-edit"></i>
        </a>
        <a class="img-icon info-btn" 
           data-original="<?= FileUtility::get($record[$model]['original']) ?>"
           data-image="<?= FileUtility::get($record[$model]['image']) ?>"
           data-thumbnail="<?= FileUtility::get($record[$model]['thumbnail']) ?>"
           >
            <i class="fa fa-info"></i>
        </a>
        
        <a href="<?= FileUtility::get($record[$model]['image']) ?>" class="fancybox" data-fancybox='group-1'>
            <img src="<?= FileUtility::get($record[$model]['thumbnail']) ?>">
        </a>
        <p class="name"><?= $record[$model]['name'] ?></p>
    </div>        
</div>