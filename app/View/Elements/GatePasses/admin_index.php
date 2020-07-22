<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('type', __('Type')); ?> </th>
                    <th> Gate Pass No. </th>
                    <th> Picker Name </th>
                    <th> Picker Mobile </th>
                    <th> Returnable </th>
                    <th> <?= $this->Paginator->sort('is_sent', __('Sent')); ?> </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($records as $record): 
                    $td_cls = $record[$model]["is_deleted"] ? "strike-through" : "";
                ?>
                <tr class="odd gradeX center">
                    <td class="<?= $td_cls ?>"><?= $record[$model]['id']; ?></td>
                    <td class="<?= $td_cls ?>"><?= GatePass::TYPE_LIST[$record[$model]['type']]; ?></td>
                    <td class="<?= $td_cls ?> gate_pass_no"><?= $record[$model]['gate_pass_no']; ?></td>
                    <td class="<?= $td_cls ?>"><?= $record[$model]['picker_name']; ?></td>
                    <td class="<?= $td_cls ?>"><?= $record[$model]['picker_mobile']; ?></td>
                    <td class="<?= $td_cls ?>"><?= $record[$model]['is_returnable'] ? '<label class="label label-info">Returnable</label>' : ''; ?></td>
                    <td><?= $record[$model]['is_sent'] ? '<label class="label label-success">Yes</label>' : ''; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_pdf", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="PDF" class="summary-link">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                       
                        <?php if ($record[$model]["is_deleted"]) : ?>
                            <br/><br/>
                            <span> Delete Remarks : <?= $record[$model]["delete_remarks"] ?> </span>
                        <?php else : ?>
                            
                            <?php if (!$record[$model]['is_sent']): ?>
                                <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                                <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                    <i class="fa fa-edit icon blue-madison"></i>
                                </a>

                                <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                                <a href="<?= $url; ?>" class="summary-link delete_with_remarks">
                                    <i class="fa fa-trash-o icon font-red-sunglo"></i>
                                </a>
                            <?php endif; ?>

                            <?php if ($record[$model]["type"] == GatePass::TYPE_ITEM || $record[$model]["type"] == GatePass::TYPE_JOB_ORDER) : ?>
                                <br/><br/>
                                <?php $url = $this->Html->url(array("action" => "admin_pdf_item_box_label", $record[$model]['id'])); ?>
                                <a target="_blank" href="<?= $url; ?>" class="summary-link">
                                    <i class="fa fa-file-pdf-o"></i> Box Label PDF
                                </a>
                            <?php endif; ?>

                            <br/><br/>
                            <?php $url = $this->Html->url(array("action" => "admin_return_receive", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link">
                                 Return Receive
                            </a>
                            
                            <?php if (
                                    $record[$model]['is_return_basic_completed']
                                    || $record[$model]['is_return_box_completed']
                                    || $record[$model]['is_return_product_completed']
                                    || $record[$model]['is_return_item_completed']
                                    || $record[$model]['is_return_asset_completed']
                                ):
                            ?>
                                <br/><br/>
                                <?php $url = $this->Html->url(array("action" => "admin_allow_to_edit_return", $record[$model]['id'])); ?>
                                <a href="<?= $url; ?>" class="summary-link">
                                    Allow to Edit Return
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <br/><br/>
                        <a href="javascript:void(0);" class="css-toggler"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden"
                           >Details</a>
                    </td>                    
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden" style="background-color: #EEE">
                    <td></td>
                    <td colspan="6">
                        <div class="masonary">
                            <?php foreach($record["GatePassImage"] as $file): ?>
                                <div class="box">
                                    <a class="fancybox" data-fancybox="group-<?= $record[$model]['id'] ?>" href="<?= FileUtility::get($file["image"]) ?>">
                                        <img class="main-img" src="<?= FileUtility::get($file["image"]) ?>">
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            <div style="clear: both"></div>
                        </div>
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
