<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> Name </th>
                    <th> Assign User </th>
                    <th style="width : 20%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= isset($user_list[$record[$model]['assign_user_id']]) ? $user_list[$record[$model]['assign_user_id']] : "-"; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        
                        <?php $url = $this->Html->url(array("controller" => "ProcurementPlanItemQuotions", "procurement_plan_id" => $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" target="_blank">
                            Quotations
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr class="hidden" id="tr-<?= $record[$model]['id'] ?>">
                    <td></td>
                    <td colspan="5">
                        <label>
                            <h3 class="section">Items</h3>
                        </label>
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr class="center">                                    
                                    <th>#</th>
                                    <th>Procurement Item</th>
                                    <th> Qty </th>
                                    <th> Min Price </th>
                                    <th> Max Price </th>
                                    <th> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 0; foreach($record['ProcurementPlanItem'] as $item): $a++; ?>
                                <tr class="center">
                                    <td><?= $a ?></td>
                                    <td><?= $item["ProcurementItem"]['name'] ?></td>                                    
                                    <td><?= $item['qty']; ?></td>
                                    <td><?= $item['min_price']; ?></td>
                                    <td><?= $item['max_price']; ?></td>
                                    <td>
                                        <?php $url = $this->Html->url(array("controller" => "ProcurementPlanItemQuotions", "procurement_plan_id" => $record[$model]['id'], "procurement_plan_item_id" => $item["id"])); ?>
                                        <a href="<?= $url; ?>" target="_blank">
                                            Quotations
                                        </a>
                                    </td>
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
