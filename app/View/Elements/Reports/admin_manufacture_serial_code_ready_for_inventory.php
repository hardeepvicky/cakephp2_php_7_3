<?php $i = $start_count;
foreach ($records as $record): $i++; ?>
    <tr class="center">
        <td><?= $i ?></td>
        <td><?= $batch_list[$record['BB']["batch_id"]] ?></td>
        <td><?= $product_group_list[$record['PGD']["product_group_id"]] ?></td>
        <td><?= $record['P']["sku"] ?></td>
        <td><?= $record['BBSC']["code"] ?></td>
        <td><?= StaticArray::$inventory_all_serial_code_status[$record['BBSC']["status"]] ?></td>
        <td><?= DateUtility::getDate($record['BBSC']["last_scan_datetime"], DateUtility::DATETIME_OUT_FORMAT) ?></td>
        <td><?= isset($user_list[$record['BBSC']["last_scan_user_id"]]) ? $user_list[$record['BBSC']["last_scan_user_id"]] : "-" ?></td>
        <td><?= $location_list[$record['BBSC']["manufacture_location_id"]] ?></td>
    </tr>                        
<?php endforeach; ?>
<script type="text/javascript">
    var start_count = parseInt('<?= $start_count ?>');
    var record_count = parseInt('<?= count($records) ?>');
</script>