<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 7%;">  
                        <input type="checkbox" class="chk-select-all" data-href=".child-chk" /> 
                        <?= $this->Paginator->sort('id', __('Id')); ?> 
                    </th>
                    <th style="width : 15%;">Info</th>
                    <th style="width : 12%;">From Location</th>
                    <th style="width : 12%;">To Location</th>
                    <th style="width : 15%;">Invoice No. <br/>Challan No.</th>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('document_date', __('Document Date')); ?> </th>
                    <th style="width : 12%;">Total Qty</th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_verified', __('Complete')); ?> </th>
                    <th style="width : 15%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record):?>
                <tr class="odd gradeX">                    
                    <td class="text-center">
                        <label style="cursor: pointer">
                            <input type="checkbox" class="child-chk" value="<?= $record[$model]['id']; ?>" name="inventory_ids[]" />
                            <?= $record[$model]['id']; ?>
                        </label>
                    </td>
                    <td>
                        Type : <b><?= StaticArray::$inventory_types[$record[$model]['type']] ?></b><br/>
                        Scanable : <?= $record[$model]['is_scanable'] ? '<span class="label label-success">Yes</span>' : "" ?><br/>
                        Invoice From Reffer : <?= $record[$model]['is_reffer'] ? '<span class="label label-success">Yes</span>' : "" ?><br/>
                        Stock Transfer : <?= $record[$model]['is_stock_transfer'] ? '<span class="label label-success">Yes</span>' : "" ?><br/>
                        Purchase Order : <?= $record[$model]['is_purchase_order'] ? '<span class="label label-success">Yes</span>' : "" ?><br/>
                        Created By : <b><?= $user_list[$record[$model]['created_by']] ?></b><br/>
                    </td>
                    <td><?= $location_list[$record[$model]['from_location_id']]; ?></td>
                    <td><?= $location_list[$record[$model]['to_location_id']]; ?></td>
                    <td>
                        Invoice No. : <b><?= $record[$model]['invoice_no']; ?></b><br/>
                        Challan No. : <b><?= $record[$model]['challan_no']; ?></b><br/>
                    </td>
                    <td class="text-center"><?= $record[$model]['document_date']; ?></td>
                    <td class="text-center"><?= $record[$model]['total_qty']; ?></td>
                    <td class="text-center"><?= $record[$model]['is_verified'] ? '<span class="label label-success">Yes</span>' : "" ?></td>
                    <td class="center">
                        <?php
                        $url = "";
                        if ($record[$model]['is_scanable'])
                        {
                            if ($record[$model]['is_reffer'])
                            {
                                if ($record[$model]['type'] == INVENTORY_INCOMING)
                                {
                                    $url = $this->Html->url(array("action" => "admin_scanable_reffer_incoming_edit", $record[$model]['id']));
                                }
                                else
                                {
                                    $url = $this->Html->url(array("action" => "admin_scanable_reffer_outgoing_edit", $record[$model]['id']));
                                }
                            }
                            else if ($record[$model]['is_stock_transfer'])
                            {
                                if ($record[$model]['type'] == INVENTORY_INCOMING)
                                {
                                    $url = $this->Html->url(array("action" => "admin_scanable_stock_transfer_incoming_edit", $record[$model]['id']));
                                }
                                else
                                {
                                    $url = $this->Html->url(array("action" => "admin_scanable_stock_transfer_outgoing_edit", $record[$model]['id']));
                                }
                            }
                            else if ($record[$model]['is_purchase_order'])
                            {
                                $url = $this->Html->url(array("action" => "admin_scanable_purchase_order_outgoing_edit", $record[$model]['id']));
                            }
                            else
                            {
                                if ($record[$model]['type'] == INVENTORY_INCOMING)
                                {
                                    $url = $this->Html->url(array("action" => "admin_scanable_incoming_edit", $record[$model]['id']));
                                }
                                else
                                {
                                    $url = $this->Html->url(array("action" => "admin_scanable_outgoing_edit", $record[$model]['id']));
                                }
                            }
                        }
                        else
                        {
                            if ($record[$model]['is_stock_transfer'])
                            {
                                if ($record[$model]['type'] == INVENTORY_INCOMING)
                                {
                                    $url = $this->Html->url(array("action" => "admin_non_scanable_stock_transfer_incoming_edit", $record[$model]['id']));
                                }
                                else
                                {
                                    $url = $this->Html->url(array("action" => "admin_non_scanable_stock_transfer_outgoing_edit", $record[$model]['id']));
                                }
                            }
                            else if ($record[$model]['is_purchase_order'])
                            {
                                $url = $this->Html->url(array("action" => "admin_non_scanable_purchase_order_outgoing_edit", $record[$model]['id']));
                            }
                            else
                            {
                                if ($record[$model]['type'] == INVENTORY_INCOMING)
                                {
                                    $url = $this->Html->url(array("action" => "admin_non_scanable_incoming_edit", $record[$model]['id']));
                                }
                                else
                                {
                                    $url = $this->Html->url(array("action" => "admin_non_scanable_outgoing_edit", $record[$model]['id']));
                                }
                            }
                        }
                        ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>
                        <a href="<?= $this->Html->url(array("action" => "admin_view" , $record[$model]['id'])); ?>" title="View" class="summary-link">
                            <i class="fa fa-eye icon green-meadow"></i>
                        </a>
                        <?php if ( $record[$model]['is_verified'] ): ?>
                            <a class="summary-link" target="_BLANK" href="<?= $this->Html->url(array("action" => "pdf", $record[$model]['id'])) ?>">
                                <i class="fa fa-file-pdf-o"></i> PDF
                            </a>
                        <?php endif; ?>
                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
