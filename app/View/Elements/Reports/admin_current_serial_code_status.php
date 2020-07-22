<?php $i = $start_count;
foreach ($records as $record): $i++; ?>
    <tr class="center">
        <td><?= $i ?></td>
        <td><?= $record['BBSC']["code"] ?></td>
        <td><?= $record['Product']["sku"] ?></td>
        <td><?= $record['BBSC']["status"] == SERIAL_CODE_STATUS_IN ? $location_list[$record['SubLocation']["location_id"]] : "-" ?></td>
        <td><?= $record['BBSC']["status"] == SERIAL_CODE_STATUS_IN ? $record['SubLocation']["name"] : "-" ?></td>
        <td>
            <?php
            if ($record['BBSC']["status"] != SERIAL_CODE_STATUS_IN)
            {
                $location_list[$record['SubLocation']["location_id"]];
            }
            ?>
        </td>

        <td><?= StaticArray::$inventory_all_serial_code_status[$record['BBSC']["status"]] ?></td>
        <td>
            <a target="_blank" href="<?= $this->Html->url(["controller" => "Inventories", "action" => "view", "admin" => true, $record['Inventory']["id"]]) ?>">
                <?= $record['Inventory']["invoice_no"] ?>
            </a>
        </td>
        <td><?= DateUtility::getDate($record['BBSC']["modified"], DateUtility::DATETIME_OUT_FORMAT) ?></td>
        <td><?= isset($user_list[$record['BBSC']["modified_by"]]) ? $user_list[$record['BBSC']["modified_by"]] : "-" ?></td>
            
    </tr>                        
<?php endforeach; ?>
<script type="text/javascript">
    var start_count = parseInt('<?= $start_count ?>');
    var record_count = parseInt('<?= count($records) ?>');
</script>