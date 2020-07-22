<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Location</th>
                    <th>Product</th>
                    <th>Min</th>
                    <th>Max</th>
                    <th>Current Stock</th>
                    <th style="width : 15%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $location_list[$record[$model]['location_id']]; ?></td>
                    <td><?= $sku_list[$record[$model]['product_id']]; ?></td>
                    <td><?= $record[$model]['minimum']; ?></td>
                    <td><?= $record[$model]['maximum']; ?></td>
                    <td><?= $record[$model]['current_stock']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-clone icon green-meadow"></i>
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
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                
                <tr class="hidden" id="tr-<?= $record[$model]['id'] ?>">
                    <td></td>
                    <td colspan="5"  style="background-color: #EEE;">
                        <?php
                        $list = array(); 
                        foreach($record['ProductThresholdNotifyUser'] as $arr)
                        {
                            $list[] = $user_list[$arr['user_id']];
                        } 
                        ?>
                        <b>Alert Users</b> : <?= implode(", ", $list); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
