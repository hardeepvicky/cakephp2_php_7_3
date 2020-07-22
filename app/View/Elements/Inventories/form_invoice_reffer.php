<?php
    $disabled = in_array($action, array("admin_scanable_reffer_incoming_add", "admin_scanable_reffer_outgoing_add")) ? "" : "disabled";
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
            <?= $this->Form->hidden('prev_inventory_id', array("id" => "prev_inventory_id", $disabled)); ?>
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
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Invoice NO. <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('invoice_no', array('placeholder' => 'Invoice NO.', "id" => "invoice_no", $disabled)); ?>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?php if (!$disabled) : ?>
                <span class="btn btn-primary" id="btn-invoice-details">Get Invoice Details</span>
                <span class="btn blue" id="get-my-invoices">Get My Invoices</span>
                <div id="modal-get-my-invoices" class="modal fade" role="dialog">
                    <div class="modal-dialog" style="max-width : 1100px; width : 98%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">
                                    <?php if ($this->request->data[$model]['type'] == INVENTORY_INCOMING) : ?>
                                        List Of Invoice Sent to You
                                    <?php else : ?>
                                        List Of Invoice Received
                                    <?php endif; ?>
                                </h4>
                            </div>
                            <div class="modal-body" style="max-height: 80vh; overflow-y: scroll"></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Challan NO. <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('challan_no', array('placeholder' => 'Challan NO.', "id" => "challan_no", $disabled)); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Documents <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <input type="file" name="data[files][]" multiple="multiple">

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
                            <a href="/<?= $controller ?>/deleteInventoryFile/<?= $file['id'] ?>" class="inventory-file-delete" data-id="<?= $file['id'] ?>">Delete</a>
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
            <?= $this->Form->input('comments', array('placeholder' => 'Comments', 'type' =>'textarea', 'rows' => 2)); ?>
        </div>
    </div>

    <section class="section-head">
        <h3>Inventory Details</h3>
    </section>

    <div class="form-group">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped table-bordered order-column" id="inventory-detail">
                <thead>
                    <tr>
                        <th style="width: 8%">#</th>
                        <th style="width: 40%">SKU</th>                        
                        <th style="width: 12%">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( isset($this->request->data["InventoryDetail"]) ): ?>
                    <?php foreach($this->request->data["InventoryDetail"] as $i => $inv_detail): ?>
                    <tr>
                        <?php if ($disabled): ?>
                            <td>
                                <?= $i + 1 ?>
                            </td>
                            <td class="product_name"><?= $sku_list[$inv_detail['product_id']] ?></td>
                            <td><?= abs($inv_detail["invoice_qty"]) ?></td>
                        <?php else: ?>
                            <td>
                                <?= $i + 1 ?>
                                <?= $this->Form->hidden("InventoryDetail.$i.id", array("class" => "inventory_detail_id")) ?>
                                <?= $this->Form->hidden("InventoryDetail.$i.product_id", array("class" => "product_id")) ?>
                                <?= $this->Form->hidden("InventoryDetail.$i.invoice_qty") ?>
                                <?= $this->Form->hidden("InventoryDetail.$i.gst_per") ?>
                                <?= $this->Form->hidden("InventoryDetail.$i.rate") ?>
                                <?= $this->Form->hidden("InventoryDetail.$i.out_uom_id") ?>
                            </td>
                            <td class="product_name"><?= $sku_list[$inv_detail['product_id']] ?></td>
                            <td><?= abs($inv_detail["invoice_qty"]) ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>  

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue-madison" name="data[next]" value="1">Next</button>
        <button type="submit" class="btn blue">Submit</button>
        <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
    </div>
</div>

<script type="text/javascript">
    var type = '<?= $this->request->data[$model]['type'] ?>';
    var party_location_list = JSON.parse('<?= json_encode($party_location_list) ?>');
    var my_parent_location_list = JSON.parse('<?= json_encode($my_parent_location_list) ?>');
    
    $(document).on("click", "span.suggest-invoice", function()
    {
        $("#to_location_id").val("");
        $("#invoice_no").val($(this).attr("data-invoice_no"));
        
        $("#scan_code_type").val($(this).attr("data-scan_code_type"));
        $("#scan_code_type").trigger("change");
        
        var from_location_id = $(this).attr("data-from_location_id");
        $("#from_location_id").val(from_location_id).trigger("change");
        
        var to_location_id = $(this).attr("data-to_location_id");
        var len = $("#to_location_id option[value='" + to_location_id + "']").length;
        if (len == 0)
        {
            for(var location_id in my_parent_location_list)
            {
                if (my_parent_location_list[location_id] == to_location_id)
                {
                    to_location_id = location_id;
                }
            }
        }
        $("#to_location_id").val(to_location_id);
        $("#modal-get-my-invoices").modal("hide");
        $("#to_location_id").trigger("change");
    });
    
    $(document).ready(function() 
    {        
        $(".inventory-file-delete").click(function(e)
        {
            var _this = $(this);
            var href = $(this).attr("href");
            
            $("#text-to-speech").html("Are You sure to Delete. This can not be undo.").articulate('speak');
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
                                $("#text-to-speech").html("Can't be deleted, Please try again later").articulate('speak');
                                bootbox.alert("Can't be deleted, Please try again later");
                            }
                        });
                    }
                }
            });
            
            return false;
        });
        
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
                var html = '<div class="alert alert-warning"><strong>Warning!</strong> From Location and To Location have same parent location. you are recommend to use Stock transfer</div>';
                $("#to_location_id").parent().append(html);
            }
            
            var invoice_no = $("#invoice_no").val();
            if (!invoice_no)
            {
                return;
            }
            
            $("#btn-invoice-details").trigger("click");            
        });
        
        $("#btn-invoice-details").click(function()
        {
            var _this = $(this);
            _this.parent().find(".error-message").remove();
            
            var invoice_no = $("#invoice_no").val();
            if (!invoice_no)
            {
                bootbox.alert("Invoice No. is required");
                return;
            }
            
            var from_location_id = $("#from_location_id").val();
            if (!from_location_id)
            {
                bootbox.alert("From Location is required");
                return;
            }
            
            var to_location_id = $("#to_location_id").val();
            if (!to_location_id)
            {
                bootbox.alert("To Location is required");
                return;
            }
            
            var type = '<?= $this->request->data[$model]['type'] == INVENTORY_INCOMING ? INVENTORY_OUTGOING : INVENTORY_INCOMING ?>';
            
            to_location_id = from_location_id = 0;
            if ('<?= $this->request->data[$model]['type'] ?>' == '1')
            {
                to_location_id = $("#to_location_id").val();
            }
            else
            {
                to_location_id = $("#from_location_id").val();
            }
            
            $.get("/<?= $controller ?>/getInvoiceDetails/" + invoice_no + "/" + type + "/" + from_location_id + "/" + to_location_id, function(data)
            {
                var html = "";
                try
                {
                    data = JSON.parse(data);                    
                    if (jQuery.isEmptyObject(data))
                    {
                        _this.parent().append("<span class='error-message'>Invalid Invoice No.</span>");
                        $("#inventory-detail tbody").html(html);
                        return;
                    }
                }
                catch(e)
                {
                    bootbox.alert(data);
                    return;
                }
                
                $("#prev_inventory_id").val(data['Inventory']["id"]);
                
                var today = new Date(); 
                var current_date = today.getDate() + "-" + (today.getMonth() + 1) + "-" + today.getFullYear();
                for(var i in data['InventoryDetail'])
                {
                    var record = data['InventoryDetail'][i];
                    html += "<tr>";
                        html += "<td>" + (parseInt(i) + 1);
                            html += '<input type="hidden" name="data[InventoryDetail][' + i + '][product_id]" value="' + record["product_id"] + '" class="product_id" />';
                            html += '<input type="hidden" name="data[InventoryDetail][' + i + '][invoice_qty]" value="' + record["qty"] + '" />';
                            html += '<input type="hidden" name="data[InventoryDetail][' + i + '][date]" value="' + current_date + '" />';
                            html += '<input type="hidden" name="data[InventoryDetail][' + i + '][gst_per]" value="' + record["gst_per"] + '" />';
                            html += '<input type="hidden" name="data[InventoryDetail][' + i + '][rate]" value="' + record["rate"] + '" />';
                            html += '<input type="hidden" name="data[InventoryDetail][' + i + '][out_uom_id]" value="' + record["out_uom_id"] + '" />';
                        html += "</td>";
                        html += "<td class='product_name'>" + record["Product"]["sku"] + "</td>";                        
                        html += "<td>" + record["qty"] + "</td>";
                    html += "</tr>";
                }
                
                $("#inventory-detail tbody").html(html);
                $("#inventory-detail").find(".inventory-datepicker").datepickerExtend();
                $("#inventory-detail").find(".inventory-datepicker").datepicker("setDate", new Date());
            });
        });
        
        $("form").on('keyup keypress', function(e) 
        {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { 
              e.preventDefault();
              return false;
            }
        });
        
        var submit_confirm = '<?= $disabled ? 1 : 0 ?>';
        $("form").submit(function ()
        {
            if ($("table#inventory-detail tbody tr").length == 0)
            {
                bootbox.alert("No Any Inventory Detail. Please Enter valid invoice no");
                return false;
            }
            
            if (!submit_confirm)
            {
                bootbox.confirm({
                    message: "Are you sure to submit. Once you submit you can't change invoice and location",
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
                            submit_confirm = true;
                            $("form").trigger("submit");
                        }
                    }
                });

                return false;
            }
        });
        
        $("#get-my-invoices").click(function()
        {
            var _modal = $("#modal-get-my-invoices");
            var type = '<?= $this->request->data[$model]['type'] == INVENTORY_INCOMING ? INVENTORY_OUTGOING : INVENTORY_INCOMING ?>';
            _modal.find(".modal-body").load("/Inventories/ajaxGetMyInvoices/" + '<?= $auth_user['id'] ?>' + '/' + type, function ()
            {
                _modal.modal('show');
            });            
        });        
    });
</script>
    