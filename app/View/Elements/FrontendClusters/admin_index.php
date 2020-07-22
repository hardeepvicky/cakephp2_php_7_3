<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 100px;">Image</th>                    
                    <th style="width : 12%;">Name</th>
                    <th style="width : 6%;">Show on Home Page</th>
                    <th style="width : 6%;">Display Order</th>
                    <th>Product Groups</th>
                    <th style="width : 12%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>
                        <?php if (isset($record["Image"])) : ?>
                        <a class="fancybox" href="<?= FileUtility::get($record["Image"]['image']); ?>">
                            <img src="<?= FileUtility::get($record["Image"]['thumbnail']); ?>"  style="width : 100%;">
                        </a>
                        <?php endif; ?>
                    </td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_toggleShowOnHomePage", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_on_home_page" data-value="<?= (int)$record[$model]['is_on_home_page'] ?>">
                            <i class="fa <?= $record[$model]['is_on_home_page'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        </a>
                    </td>
                    <td><?= $record[$model]['display_order']; ?></td>
                    <td>
                        <?php if ($record['FrontendClusterProductGroup']): ?>
                        <div class="masonary">
                            <?php foreach($record['FrontendClusterProductGroup'] as $arr):
                                    if(isset($product_groups[$arr['product_group_id']])):
                                ?>
                                <div class="box">
                                    <?php if ($product_groups[$arr['product_group_id']]['Image']["image"]): ?>
                                    <a class="fancybox" data-fancybox="group-<?= $record[$model]['id'] ?>" href="/<?= $product_groups[$arr['product_group_id']]['Image']['image'] ?>">
                                        <img class="main-img" src="/<?= $product_groups[$arr['product_group_id']]['Image']['thumbnail'] ?>">
                                    </a>
                                    <?php else : ?>
                                        <img class="main-img" src="/img/dummy.jpg">
                                    <?php endif; ?>
                                    <label class="details">
                                        <?= $product_groups[$arr['product_group_id']]['PG']['name'] ?>
                                    </label>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                        </div>
                        <?php endif;  ?>
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
