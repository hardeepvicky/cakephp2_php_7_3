<?php $disabled = in_array($action, array(
        "admin_scanable_incoming_add", "admin_scanable_outgoing_add", 
        "admin_scanable_stock_transfer_incoming_add", "admin_scanable_stock_transfer_outgoing_add",
        "admin_non_scanable_incoming_add", "admin_non_scanable_outgoing_add",
        "admin_non_scanable_stock_transfer_incoming_add", "admin_non_scanable_stock_transfer_outgoing_add",
        "admin_scanable_purchase_order_outgoing_add", "admin_non_scanable_purchase_order_outgoing_add"
    )
    ) ? "" : "disabled";
?>
<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Document Date<span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('document_date', array(
                'id' => 'document_date',
                'placeholder' => 'dd-MMM-yyyy', 
                "class" => "form-control date-picker", 
                "autocomplete" => "off",
                $disabled
            )); ?>
        </div>                
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">From Location <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input("from_location_id", array(
                'id' => "from_location_id",
                "type" => "select",
                "class" => "form-control select2me",
                "options" => $this->request->data[$model]['type'] == INVENTORY_INCOMING ? $other_location_list : $my_location_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            )); ?>
        </div>
    </div>
    
    <?php if ($this->request->data[$model]["is_purchase_order"]) : ?>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Purchase Order <span>*</span> :</label>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?= $this->Form->input("purchase_order_id", array(
                    "type" => "select",
                    "class" => "form-control select2me",
                    "options" => $purchase_order_list,
                    "empty" => DROPDOWN_EMPTY_VALUE,
                    $disabled
                )); ?>
            </div>
        </div>
    <?php else : ?>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">To Location <span>*</span> :</label>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?= $this->Form->input("to_location_id", array(
                    'id' => "to_location_id",
                    "type" => "select",
                    "class" => "form-control select2me",
                    "options" => $this->request->data[$model]['type'] == INVENTORY_INCOMING ? $my_location_list : $other_location_list,
                    "empty" => DROPDOWN_EMPTY_VALUE,
                    $disabled
                )); ?>
            </div>
        </div>

    <?php endif; ?>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Invoice NO. <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('invoice_no', array('placeholder' => 'Invoice NO.', "id" => "invoice_no", $disabled)); ?>
        </div>
    </div>
    <?php if (!$this->request->data[$model]["is_purchase_order"]) : ?>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Challan NO. <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('challan_no', array('placeholder' => 'Challan NO.', "id" => "challan_no", $disabled)); ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Documents <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <input type="file" name="data[files][]" multiple="multiple">
            <?php if ( isset($this->validationErrors[$model]['files']) ): ?>
            <ul class="error-message">
                <?php foreach ($this->validationErrors[$model]['files'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <table class="table table-bordered order-column table-template">
                <tbody>
                    <?php 
                    if (isset($this->request->data["InventoryFile"]) && $this->request->data["InventoryFile"]):
                        foreach($this->request->data["InventoryFile"] as $i => $file):
                            echo $this->Form->hidden("InventoryFile.$i.id");
                            echo $this->Form->hidden("InventoryFile.$i.file");
                    ?>
                    <tr>
                        <td>
                            <?php 
                                $name = pathinfo($file['file'], PATHINFO_BASENAME); 
                                $name = explode("?", $name)[0];
                                echo $name;
                            ?>
                        </td>
                        <td>
                            <a href="<?= FileUtility::get($file['file']); ?>" target="_blank">Download</a>
                        </td>
                        <td>
                            <a href="<?= $this->Html->url(array("action" => "admin_delete_file", $file["id"])) ?>" class="inventory-file-delete" data-id="<?= $file['id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; endif;?>      
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Comments :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('comments', array('placeholder' => 'Comments', 'type' =>'textarea', 'rows' => 2, 'class' => 'form-control invalid-sql-char')); ?>
        </div>
    </div>
</div>
<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <?php if ($disabled): ?>
            <button type="submit" class="btn blue-madison" name="data[next]" value="1">Next</button>
        <?php endif; ?>
        <button type="submit" class="btn blue">Submit</button>
        <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
    </div>
</div>

<script type="text/javascript">
    <?php if (isset($my_parent_location_list)): ?>
        var my_parent_location_list = JSON.parse('<?= json_encode($my_parent_location_list) ?>');
    <?php endif; ?>
        
    $(document).ready(function()
    {
        $(".inventory-file-delete").click(function()
        {
            var _this = $(this);
            var href = $(this).attr("href");
            
            bootbox.confirm({
                message: "Are You sure to Delete. This can not be undo.",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) 
                {
                    if (result)
                    {
                        $.get(href, function(data)
                        {
                            if (data == "1")
                            {
                                _this.closest("tr").remove();
                            }
                            else
                            {
                                bootbox.alert(data);
                            }
                        });
                    }
                }
            });
            
            return false;
        });
        
        if (typeof my_parent_location_list != "undefined")
        {
            $("#from_location_id, #to_location_id").change(function()
            {
                $("#to_location_id").parent().find("div.alert").remove();

                var from_location_id = $("#from_location_id").val();
                if (!from_location_id)
                {
                    return;
                }

                var to_location_id = $("#to_location_id").val();
                if (!to_location_id)
                {
                    return;
                }

                if (typeof my_parent_location_list[from_location_id] != "undefined" && typeof my_parent_location_list[to_location_id] != "undefined" && my_parent_location_list[from_location_id] == my_parent_location_list[to_location_id])
                {
                    var html = '<div class="alert alert-warning"><strong>Warning!</strong> From Location and To Location have same parent location. you are recommend to use Stock transfer instead</div>';
                    $("#to_location_id").parent().append(html);
                }
            });
        }
    })
</script>
