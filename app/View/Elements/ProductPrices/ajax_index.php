<h4>Price showing in <?= $uom["name"] ?> (<?= $uom["short_name"] ?>) Unit</h4>
<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($records as $record): ?>
                <tr class="center">
                    <td><?= $record[$model]['date']; ?></td>
                    <td>&#8360 <?= $record[$model]['price'] * $uom["conversion_factor"] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>