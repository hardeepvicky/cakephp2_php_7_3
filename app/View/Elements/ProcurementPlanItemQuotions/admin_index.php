<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> Procurement Plan </th>
                    <th> Procurement Item </th>
                    <th> Supplier </th>
                    <th> Price </th>
                    <th> Qty </th>
                    <th style="width : 20%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= isset($procurement_plan_list[$record[$model]['procurement_plan_id']]) ? $procurement_plan_list[$record[$model]['procurement_plan_id']] : "-"; ?></td>
                    <td><?= isset($procurement_item_list[$record["ProcurementPlanItem"]['procurement_item_id']]) ? $procurement_item_list[$record["ProcurementPlanItem"]['procurement_item_id']] : "-"; ?></td>
                    <td>
                        <?= $record[$model]['supplier_name']; ?><br/>
                        <b> Address</b> : <?= $record[$model]['supplier_address']; ?><br/>
                        <b> Mobile </b> : <?= $record[$model]['supplier_mobile']; ?><br/>
                    </td>
                    <td><?= CURRENCY_SYMBOL . " " . $record[$model]['price']; ?></td>
                    <td><?= $record[$model]['qty']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr class="hidden" id="tr-<?= $record[$model]['id'] ?>">
                    <td></td>
                    <td colspan="3">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr class="center">                                    
                                    <th>#</th>
                                    <th>File</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 0; foreach($record['ProcurementPlanItemQuotionFile'] as $arr): $a++; ?>
                                <tr class="center">
                                    <td><?= $a ?></td>
                                    <td style="text-align: left;"><?= pathinfo($arr["file"], PATHINFO_BASENAME) ?></td>                                    
                                    <td>
                                        <a href="/<?= $arr["file"] ?>" download>Download</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>                        
                    </td>
                    <td colspan="3">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr class="center">                                    
                                    <th>#</th>
                                    <th>Parameter</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 0; foreach($record['ProcurementPlanItemQuotionParam'] as $arr): $a++; ?>
                                <tr class="center">
                                    <td><?= $a ?></td>
                                    <td><?= $arr["ProcurementItemParam"]["name"] ?></td>
                                    <td><?= $arr["value"] ?></td>
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
