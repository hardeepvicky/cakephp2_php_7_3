<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th>Location</th>                    
                    <th>Sub Location</th>
                    <th>Sku</th>
                    <th>Lost Qty</th>
                    <th>Damage Qty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $location_list[$record["ProductSubLocation"]["SubLocation"]['location_id']] ?></td>
                    <td><?= $record["ProductSubLocation"]['SubLocation']["name"] ?></td>
                    <td><?= $sku_list[$record["ProductSubLocation"]['product_id']] ?></td>
                    <td><?= $record[$model]['lost_qty']; ?></td>
                    <td><?= $record[$model]['damage_qty']; ?></td>
                    <td>
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