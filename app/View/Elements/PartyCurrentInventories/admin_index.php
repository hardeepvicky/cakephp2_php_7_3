<?php if($records): ?>
    <a class="btn blue" href="<?= $this->Html->url(array_merge(array("action" => "admin_csv"), $search)); ?>">Export CSV</a>
<?php endif; ?>
    
<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="party-current-inventory">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th>Party Location</th>                    
                    <th>Product</th>
                    <th>CSV Sku</th>
                    <th><?php echo $this->Paginator->sort('qty',  'Qty'); ?></th>
                    <th><?php echo $this->Paginator->sort('is_sellable',  'Sellable'); ?></th>
                    <th>Status</th>
                    <th>Request Report Id</th>
                    <th><?php echo $this->Paginator->sort('modified',  'Last Update'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $party_location_list[$record[$model]['party_location_id']] ?></td>
                    <td><?= $product_list[$record[$model]['product_id']] ?></td>                    
                    <td><?= $record[$model]['sku']; ?></td>
                    <td><?= $record[$model]['qty']; ?></td>
                    <td><?= $record[$model]['is_sellable'] ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?></td>
                    <td><?= $record[$model]['status']; ?></td>
                    <td><?= $record[$model]['request_report_id']; ?></td>
                    <td><?= DateUtility::getDate($record[$model]['modified'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>