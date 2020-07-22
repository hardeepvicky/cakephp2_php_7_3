<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 100px;">Name & Image</th>                    
                    <th style="width : 20%;">Category, Style, Rank</th>
                    <th style="width : 8%;"><?= $this->Paginator->sort('is_live', __('Live')); ?></th>
                    <th>Products</th>
                    <th style="width : 17%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>
                        <b><?= $record[$model]['name']; ?></b>
                        <br/>
                        <?php if (isset($record["Image"])) : ?>
                            <a class="fancybox" href="<?= FileUtility::get($record["Image"]['image']); ?>">
                                <img src="<?= FileUtility::get($record["Image"]['thumbnail']); ?>"  style="width : 100%;">
                            </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <b>Category : </b> <?= $category_tree_list[$record[$model]['category_id']]; ?>
                        <br/>
                        <b>Style : </b><?= $type_list[$record[$model]['style_type_id']]; ?>
                        <br/>
                        <b>Rank : </b><?= $record[$model]['rank']; ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_toggleLive", $record[$model]['id'])); ?>
                        <?php if ($url) : ?>
                            <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_live" data-value="<?= (int)$record[$model]['is_live'] ?>">
                                <i class="fa <?= $record[$model]['is_live'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $i = 0;  if ($record['ProductGroupDetail']): ?>
                        <div class="masonary">
                            <?php foreach($record['ProductGroupDetail'] as $arr): $i++;
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
                        <?php $url = $this->Html->url(array("action" => "admin_pdf", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="PDF" class="summary-link">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                        
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Copy" class="summary-link">
                            <i class="fa fa-clone icon font-green-meadow"></i>
                        </a>
                        <br/><br/>
                        <?php if ($record[$model]["child_count"] == 0): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>

                            <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>

                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                                <i class="fa fa-trash-o icon font-red-sunglo"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
