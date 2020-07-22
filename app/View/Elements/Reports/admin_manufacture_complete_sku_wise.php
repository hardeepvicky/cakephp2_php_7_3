<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable" id="report">
            <thead>
                <tr>
                    <th data-search-clear="1"  style="width : 8%">#</th>
                    <th data-search="1" data-sort="alpha">Batch</th>
                    <th data-search="1" data-sort="alpha">Product Group</th>
                    <th data-search="1" data-sort="alpha">SKU</th>
                    <th data-sort="numeric" style="width : 15%">Total Qty</th>
                    <th data-sort="numeric" style="width : 15%">Complete Qty</th>
                    <th data-sort="numeric" style="width : 15%">Complete(%)</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach($records as $record): $i++; ?>
                <tr class="center">
                    <td><?= $i ?></td>
                    <td><?= $batch_list[$record['BB']["batch_id"]] ?></td>
                    <td><?= $product_group_list[$record['PGD']["product_group_id"]] ?></td>
                    <td><?= $record['P']["sku"] ?></td>
                    <td><?= $record[0]["total_qty"] ?></td>
                    <td><?= $record[0]["complete_qty"] ?></td>
                    <td><?= round($record[0]["complete_qty"] * 100 / $record[0]["total_qty"], 2) ?></td>
                </tr>                        
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>