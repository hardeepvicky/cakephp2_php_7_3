<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> Product </th>
                    <th style="width : 20%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $sku_list[$record[$model]['product_id']]; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="tr#<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr id="<?= $record[$model]['id'] ?>" class="hidden">
                    <td></td>
                    <td colspan="2">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th style="width : 10%;"> # </th>
                                    <th> Consumption Product </th>
                                    <th> Qty </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($record["ProductIdealConsumptionDetail"] as $k => $detail): ?>
                                <tr class="center">
                                    <td><?= $k + 1 ?></td>
                                    <td><?= $sku_list[$detail["product_id"]] ?></td>
                                    <td><?= $detail["qty"] ?> <b><?= $product_uom_list[$detail["product_id"]] ?></b></td>
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
