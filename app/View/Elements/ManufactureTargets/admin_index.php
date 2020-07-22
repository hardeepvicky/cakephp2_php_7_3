<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> 
                        <input type="checkbox" class="chk-select-all" data-href=".child-chk" /> 
                        <?= $this->Paginator->sort('id', __('Id')); ?> 
                    </th>
                    <th> <?= $this->Paginator->sort('name', __('Target')); ?> </th>
                    <th>Operation Type</th>
                    <th> <?= $this->Paginator->sort('target_datetime', __('Target Date')); ?> </th>
                    <th>Complete</th>
                    <th> <?= $this->Paginator->sort('is_expired', __('Expired')); ?> </th>
                    <th style="width : 20%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td>
                        <label style="cursor: pointer">
                            <input type="checkbox" class="child-chk" value="<?= $record[$model]['id']; ?>" name="manufacture_target_ids[]" />
                            <?= $record[$model]['id']; ?>
                        </label>
                    </td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $operation_type_list[$record[$model]['operation_type_id']]; ?></td>
                    <td><?= $record[$model]['target_datetime']; ?></td>
                    <td><?= $record[$model]['is_completed'] ? '<label class="label label-success">Completed</label>' : '<label class="label label-info">' . $record[$model]["complete_per"] . '%</label>' ; ?></td>
                    <td><?= $record[$model]['is_expired'] ? '<label class="label label-danger">Yes</label>' : '' ; ?></td>
                    <td>
                        <a href="javascript:void(0);" class="css-toggler"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                        
                        <?php if (!$record[$model]['is_completed']): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>

                            <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                                <i class="fa fa-trash-o icon font-red-sunglo"></i>
                            </a>
                        <?php endif;?>
                    </td>
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden"> 
                    <td></td>
                    <td colspan="4">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th style="width : 10%;"> # </th>
                                    <th> Sku </th>
                                    <th> Target Qty </th>
                                    <th> Complete </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach($record["ManufactureTargetDetail"] as $arr): $i++; ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?= $sku_list[$arr['product_id']] ?></td>
                                    <td class="text-center"><?= $arr['target_qty'] ?></td>
                                    <td class="text-center"><?= $arr['complete_qty'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
