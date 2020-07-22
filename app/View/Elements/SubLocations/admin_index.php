<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Location</th>
                    <th> <?= $this->Paginator->sort('name', __('Sub Location')); ?> </th>
                    <th> Code </th>
                    <th> <?= $this->Paginator->sort('display_order', __('Display Order')); ?> </th>
                    <th> <?= $this->Paginator->sort('total_volume', 'Total Volume'); ?>  (Inch<sup>3</sup>) </th>
                    <th> <?= $this->Paginator->sort('empty_volume', 'Empty Volume'); ?>  (Inch<sup>3</sup>) </th>
                    <th> <?= $this->Paginator->sort('is_open', __('Open Space')); ?> </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $location_list_cache[$record[$model]['location_id']]; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['barcode']; ?></td>
                    <td><?= $record[$model]['display_order']; ?></td>
                    <td><?= $record[$model]['total_volume']; ?></td>
                    <td><?= round($record[$model]['empty_volume'], ROUND_DIGIT); ?></td>
                    <td>
                        <?= $record[$model]['is_open'] ? '<span class="label label-success"> Yes </span>' : '<span class="label label-danger"> No </span>' ?>
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
                        
                        <?php $url = $this->Html->url(array("action" => "getProducts", "admin" => false, $record[$model]['id'])); ?>
                        <a href="javascript:void(0);" class="css-toggler ajax-loader"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden"
                           data-loader-target="tr#record-<?= $record[$model]['id'] ?> .products" data-loader-href="<?= $url; ?>"
                           >Details</a>
                    </td>                    
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden" style="background-color: #EEE">
                    <td></td>
                    <td class="products" colspan="6">
                        
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
