<?php $i = $start_count;
foreach ($records as $record): $i++; ?>
    <tr class="center">
        <td><?= $i ?></td>
        <td><?= $record['Location']["name"] ?></td>
        <td><?= $record['SubLocation']["name"] ?></td>
        <td><?= $record['Product']["sku"] ?></td>
        <td><?= $record['IT']["name"] ? $record['IT']["name"] : "-" ?></td>
        <td><?= $record['PSL']["qty"] ?></td>
        <td><?= $record['MU']["short_name"] ?></td>
        <td>
            <?php if ($record[0]["dispute_count"] > 0) : ?>
            <a href="<?= $this->Html->url(["action" => "ajaxGetPslDisputes", "admin" => false, $record['PSL']["id"]]) ?>" class="fancybox-ajax">
                <?= $record[0]["dispute_count"] ?> Disputes
            </a>
            <?php endif; ?>
        </td>
    </tr>             
<?php endforeach; ?>
<script type="text/javascript">
    var start_count = parseInt('<?= $start_count ?>');
    var record_count = parseInt('<?= count($records) ?>');
</script>