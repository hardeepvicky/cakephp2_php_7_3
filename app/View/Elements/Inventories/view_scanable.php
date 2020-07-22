<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">Inventory Details</div>
        <div class="tools">
            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="table__structure">
            <div class="table-responsive">
                <table class="table table-striped table-bordered order-column">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Rate</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>GST</th>
                            <th>Total Amount</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; $total_amt = 0;
                        foreach ($this->request->data['InventoryDetail'] as $inv_detail) : $i++; ?>
                            <tr class="center">
                                <td><?= $i; ?></td>
                                <td><?= $inv_detail['Product']['sku']; ?></td>
                                <td><?= DateUtility::getDate($inv_detail['date'], DateUtility::DATE_OUT_FORMAT) ?></td>
                                <td>&#8360 <?= $inv_detail['rate'] ?></td>
                                <td><?= abs($inv_detail['qty']) ?> (<?= $inv_detail['Product']['MU']["short_name"] ?>)</td>
                                <td>
                                    <?php
                                    $amt = $inv_detail['rate'] * abs($inv_detail['qty']);
                                    $gst = round($amt *  $inv_detail['gst_per'] / 100, 2);
                                    echo $amt;
                                    ?>
                                </td>
                                <td><?= $gst ?></td>
                                <td>
                                    <?php 
                                        $total_amt += $amt + $gst;
                                        echo $amt + $gst;
                                    ?>
                                </td>
                                <td>
                                    <?php if ( isset($inv_detail["Product"]['Image']) ): ?>
                                        <a class="fancybox" href="<?= $inv_detail["Product"]['Image']["image"] ?>">
                                            <img src="<?= $inv_detail["Product"]['Image']['thumbnail'] ?>" style="height : 60px; width: auto;">
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $inv_detail['id'] ?>" data-toggler-class="hidden">Details</a>
                                </td>
                            </tr>
                            <tr class="hidden" id="tr-<?= $inv_detail['id'] ?>">
                                <td></td>
                                <td colspan="8">
                                    <h3 class="section">
                                        Details
                                    </h3>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered order-column">
                                            <thead>
                                                <tr style="background-color: #EEE; color:#000;">
                                                    <th>#</th>
                                                    <th>Box No.</th>
                                                    <th>Serial Code</th>
                                                    <th>Batch</th>
                                                    <th>Bundle</th>
                                                    <th>Sub Location</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($inv_detail['IDP'] as $k => $idp): ?>
                                                    <tr class="center">
                                                        <td><?= $k + 1 ?></td>
                                                        <td><?= $idp["IDP"]['box_no'] ?></td>
                                                        <td><?= $idp["BBSC"]['code'] ?></td>
                                                        <td><?= $idp["Batch"]['name'] ?></td>
                                                        <td><?= $idp["BatchBundle"]['name'] ?></td>
                                                        <td><?= $idp["SL"]['name'] ?></td>
                                                        <td><?= isset(StaticArray::$inventory_all_serial_code_status[$idp["IDP"]['status']]) ? StaticArray::$inventory_all_serial_code_status[$idp["IDP"]['status']] : "-" ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tfoot>
                                <tr>
                                    <td colspan="7"></td>
                                    <td class="text-center"><?= $total_amt ?></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
