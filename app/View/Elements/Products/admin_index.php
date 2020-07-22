<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 12%;">Category</th>
                    <th style="width : 12%;"> <?= $this->Paginator->sort('name', __('Product')); ?> </th>
                    <th style="width : 12%;"> <?= $this->Paginator->sort('sku', __('Sku')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('volume', __('Volume')); ?> (Inch<sup>3</sup>) </th>
                    <th colspan="2">Images</th>
                    <th style="width : 15%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($records as $record): 
                ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $category_list[$record[$model]['category_id']]; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['sku']; ?></td>
                    <td><?= $record[$model]['volume']; ?></td>
                    <td style="width : 35%;">
                        <?php $i = 0;  if ( isset($images[$record[$model]['id']]) ): ?>
                        <div class="masonary">
                            <?php foreach($images[$record[$model]['id']] as $arr): $i++; ?>
                            <div class="box <?= $arr["ProductFile"]["is_primary"] ? "selected" : ""; ?> <?= $i > 3 ? "hidden hide-show-image-" . $record[$model]['id'] : "" ?>">
                                <a class="fancybox" data-fancybox="group-<?= $record[$model]['id'] ?>" href="<?= FileUtility::get($arr["Image"]['image']) ?>">
                                    <img class="main-img" src="<?= FileUtility::get($arr["Image"]['thumbnail']) ?>">
                                </a>
                                <div class="box-icon bottom-center">
                                    <span class="is-primary-image <?= $arr["ProductFile"]["is_primary"] ? "" : "hidden"; ?>"><i class="fa fa-star font-blue-madison"></i></span>
                                    <a class="set-primary-image <?= $arr["ProductFile"]["is_primary"] ? "hidden" : ""; ?>" href="<?= $this->Html->url(array("action" => "ajaxImagePrimary", $record[$model]['id'], $arr["ProductFile"]["id"])) ?>">
                                        <i class="fa fa-star-o"></i>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                        </div>
                        <?php endif;  ?>
                    </td>
                    <td>
                        <?php if ($i > 3) : ?>
                            <a href="javascript:void(0)" class="css-toggler" data-toggler-target=".hide-show-image-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Show / Hide Images</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_costing_pdf", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Copy" class="summary-link">
                            <i class="fa fa-file-pdf-o"></i> Costing PDF
                        </a>
                        <br/><br/>
                        
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
                        
                        <br/><br/>
                        <?php $url = $this->Html->url(array("action" => "ajaxProductDetail", "admin" => false, $record[$model]['id'])); ?>
                        <a href="javascript:void(0);" class="css-toggler ajax-loader"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden"
                           data-loader-target="tr#record-<?= $record[$model]['id'] ?> .detail" data-loader-href="<?= $url; ?>"
                           >Details</a>
                    </td>
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden">
                    <td></td>
                    <td class="detail" colspan="7"  style="background-color: #F7F7F7">
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
