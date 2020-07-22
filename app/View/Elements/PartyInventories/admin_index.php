<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th>Party Location</th>                    
                    <th>Product</th>
                    <th>Map Sku</th>
                    <th>Sellable</th>
                    <th>Status</th>
                    <th>Request Report Id</th>
                    <th>Last Update</th>
                    <th style="width : 10%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $party_location_list[$record[$model]['party_location_id']] ?></td>
                    <td><?= $product_list[$record[$model]['product_id']] ?></td>
                    <td><?= $record["PartyMapSku"]['sku']; ?></td>
                    <td><?= $record[$model]['is_sellable'] ? '<span class="label label-success">Yes</span>' : "" ?></td>
                    <td><?= $record[$model]['status']; ?></td>
                    <td><?= $record[$model]['request_report_id'] ?></td>
                    <td><?= DateUtility::getDate($record[$model]['modified'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td>
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
                </tr>
                <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="5" style="background-color:#EEF2F5; text-align: left;">                        
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($record['PartyInventoryDetail'] as $arr):  ?>
                                <tr class="center">
                                    <td><?= DateUtility::getDate($arr['date'], DateUtility::DATE_OUT_FORMAT) ?></td>
                                    <td><?= $arr['qty'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>