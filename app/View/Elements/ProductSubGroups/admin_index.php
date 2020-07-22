<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 12%;">Product Group</th>
                    <th style="width : 12%;">Name</th>
                    <th style="width : 12%;">Color</th>
                    <th>Products</th>
                    <th style="width : 12%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $product_group_list[$record[$model]['product_group_id']]; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $type_list[$record[$model]['color_type_id']]; ?></td>
                    <td>
                        <?php $i = 0; if ($record['ProductSubGroupDetail']): ?>
                        <div class="masonary">
                            <?php foreach($record['ProductSubGroupDetail'] as $arr): $i++;
                                    if(isset($products[$arr['product_id']])):
                                ?>
                                <div class="box <?= $i > 4 ? "hidden hide-show-image-" . $record[$model]['id'] : "" ?>">
                                    <?php if ($products[$arr['product_id']]['Image']["image"]): ?>
                                    <a class="fancybox" data-fancybox="group-<?= $record[$model]['id'] ?>" href="<?= FileUtility::get($products[$arr['product_id']]['Image']['image']) ?>">
                                        <img class="main-img" src="<?= FileUtility::get($products[$arr['product_id']]['Image']['thumbnail']) ?>">
                                    </a>
                                    <?php else : ?>
                                        <img class="main-img" src="/img/dummy.jpg">
                                    <?php endif; ?>
                                    <label class="details">
                                        <?= $products[$arr['product_id']]['Product']['sku'] ?>
                                    </label>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                        </div>
                        <?php endif;  ?>
                    </td>
                    <td>
                        <?php if ($i > 4) : ?>
                            <a href="javascript:void(0)" class="css-toggler" data-toggler-target=".hide-show-image-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Show / Hide Images</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Copy" class="summary-link">
                            <i class="fa fa-clone icon font-green-meadow"></i>
                        </a>
                        
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
