<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 5%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('name', __('Photoshoot')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('total_variation', __(' Total Variation')); ?></th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('un_complete_variation', __(' Uncomplete Variation')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('complete_variation', __(' Complete Variation')); ?> </th>
                    <th> Variations </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['total_variation']; ?></td>
                    <td><?= $record[$model]['un_complete_variation']; ?></td>
                    <td><?= $record[$model]['complete_variation']; ?></td>
                    <td>
                        <div class="masonary">
                            <?php foreach($record["PhotoshootVariation"] as $variation): ?>
                            <div class="box">     
                                <a href="<?= $this->Html->url(array("controller" => "Images", "action" => "index", "photoshoot_variation_id" => $variation["PV"]['id'])) ?>">
                                    <img class="main-img" src="<?= $variation["I"]['thumbnail'] ? FileUtility::get($variation["I"]['thumbnail']) : "/img/dummy.jpg" ?>">
                                    <div class="details">
                                        <?= $variation["PV"]['name'] ?>                                         
                                    </div>
                                </a>
                                <br/>
                                <a class="details" href="<?= $this->Html->url(array("controller" => "Photoshoots", "action" => "edit", "admin" => true, $record[$model]['id'])) ?>">
                                    <?php if ($variation["PV"]['is_completed']): ?>
                                        (Completed)
                                    <?php else : ?>
                                        <div class="text-center">
                                            (Un-Completed)
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
