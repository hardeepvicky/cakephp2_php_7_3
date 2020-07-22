<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Name</th>
                    <th>Height</th>
                    <th>Chest</th>
                    <th>Hip Size</th>
                    <th>Wear Cloth</th>
                    <th>Photoshoots</th>
                    <th style="width : 100px;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['height']; ?></td>
                    <td><?= $record[$model]['chest']; ?></td>
                    <td><?= $record[$model]['hip_size']; ?></td>
                    <td><?= $record[$model]['cloth_size']; ?></td>
                    <td>
                        <?php if ($record['PhotoshootModelDetail']): ?>
                        <div class="masonary">
                            <?php foreach($record['PhotoshootModelDetail'] as $arr):
                                    if(isset($photoshoots[$arr['photoshoot_id']])):
                                ?>
                                <div class="box">
                                    <?php if ($photoshoots[$arr['photoshoot_id']]["image"]): ?>
                                    <a class="fancybox" data-fancybox="group-<?= $record[$model]['id'] ?>" href="<?= FileUtility::get($photoshoots[$arr['photoshoot_id']]['image']) ?>">
                                        <img class="main-img" src="<?= FileUtility::get($photoshoots[$arr['photoshoot_id']]['image']) ?>">
                                    </a>
                                    <?php else : ?>
                                        <img class="main-img" src="/img/dummy.jpg">
                                    <?php endif; ?>
                                    <label class="details">
                                        <?= $photoshoots[$arr['photoshoot_id']]['name'] ?>
                                    </label>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                        </div>
                        <?php endif;  ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
