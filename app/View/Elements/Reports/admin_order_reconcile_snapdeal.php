<?php $i = $start_count;
foreach ($records as $sub_order_id => $record): $i++; ?>                        
    <tr class="center">
        <td><?= $i ?></td>
        <td><?= $record["order_id"] ?></td>
        <td><?= $record["sub_order_id"] ?></td>
        <td><?= $record["product_group"] ?></td>
        <td><?= $record["sku"] ?></td>
        <td><?= $record["party_sku"] ?></td>
        <td><?= $record["order_date"] ?></td>
        <td><?= $record["status"] ?></td>
        <td><?= $record["return_status"] ?></td>
        <td><?= $record["return_delivery_status"] ?></td>
        <td><?= $record["sale_price"] ?></td>
        <td><?= $record["unsettle_charges"] ?></td>
        <td><?= $record["actual_payout"] ?></td>
        <td><?= $record["ideal_payout"] ?></td>
        <td><?= $record["payout_diff"] ?></td>
        <td><?= $record["prospective_payout_diff"] ?></td>
        <td><?= $record["profit"] ?></td>
        <td><?= $record["prospective_profit"] ?></td>
        <td><?= $record["Overcharges"] ?></td>
        <td><?= $record["Payment Not Recieved"] ?></td>
        <td><?= $record["Return Not Received"] ?></td>
        <td><?= $record["Return Item Damaged"] ?></td>
        <td>
    <?php $url = $this->Html->url(array("controller" => "Orders", "action" => "admin_order_detail_view", $record["order_detail_id"])) ?>
            <a href="<?= $url ?>" class="view-order-detail" data-sub_order_id="<?= $record["sub_order_id"] ?>"> View Details </a>
            <div class="modal fade" role="dialog">
                <div class="modal-dialog modal-full">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Order Detail of <span class="sub_order_id"></span></h4>
                        </div>
                        <div class="modal-body" style="text-align: left;"></div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
<?php endforeach; ?>
<script type="text/javascript">
    var start_count = parseInt('<?= $start_count ?>');
    var record_count = parseInt('<?= count($records) ?>');
</script>