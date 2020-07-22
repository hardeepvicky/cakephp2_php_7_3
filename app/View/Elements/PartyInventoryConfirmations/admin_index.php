<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th>Party Location</th>                    
                    <th>Product</th>
                    <th>Map Sku</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $location_list[$record[$model]['party_location_id']] ?></td>
                    <td><?= $sku_list[$record[$model]['product_id']] ?></td>
                    <td><?= $record[$model]['party_map_sku']; ?></td>
                    <td><?= $record[$model]['date']; ?></td>
                    <td>
                        <?php if ($record[$model]['is_confirm']): ?>
                            <span class="label label-success">Verified</span>
                        <?php else: ?>
                            <span class="label label-danger">Not-Verified</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (!$record[$model]['is_confirm']): ?>
                            <?= $record[$model]["not_confirm_reason"] ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>