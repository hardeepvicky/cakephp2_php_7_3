<div class="row">
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            <div class="col-md-4 col-sm-6 col-xs-12">
                Document Date : <b><?= $this->request->data[$model]['document_date'] ?></b>
                <?= $this->Form->hidden('document_date'); ?>
            </div>                
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?php
                    if ($this->request->data["Inventory"]['is_reffer'])
                    {
                       echo '<span class="label label-default">Invoice From Reffer</span>'; 
                    }
                    else if ($this->request->data["Inventory"]['is_stock_transfer'])
                    {
                        echo '<span class="label label-default">Stock Transfer</span>';
                    }
                ?> 
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="row">
                    <label class="control-label col-md-4 col-sm-6 col-xs-12">Scan Code</label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <input type="text" autocomplete="off" class="barcode-scan form-control validate-barcode" id="scan-code"/>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 col-sm-6 col-xs-12">
                From Location : <b><?= $this->request->data['FromLocation']['name'] ?></b>
                <?= $this->Form->hidden('FromLocation.name'); ?>
            </div>                
            <div class="col-md-4 col-sm-6 col-xs-12">
                To Location : <b><?=  $this->request->data['ToLocation']['name']  ?></b>
                <?= $this->Form->hidden('ToLocation.name'); ?>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="row">
                    <label class="control-label col-md-4 col-sm-6 col-xs-12">Scan Box</label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <input type="text" autocomplete="off"  class="barcode-scan form-control invalid-char validate-alpha-numeric" id="scan-box"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-4 col-sm-6 col-xs-12">
                Invoice No. : <b><?= $this->request->data[$model]['invoice_no'] ?></b>
                <?= $this->Form->hidden('invoice_no'); ?>
                <a class="fancybox" data-fancybox="qr-code" href="/<?= $inventory_qrcode_img ?>">View QR Code</a>
            </div>                
            <div class="col-md-4 col-sm-6 col-xs-12">
                Challan No. : <b><?=  $this->request->data[$model]['challan_no']  ?></b>
                <?= $this->Form->hidden('challan_no'); ?>
            </div> 
            <div class="col-md-4 col-sm-6 col-xs-12">
                <?php if ($sub_location_will_appear): ?>
                <div class="row">
                    <label class="control-label col-md-4 col-sm-6 col-xs-12">Sub Location</label>
                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <?= $this->Form->input("sub_location_id", array(
                            "id" => "sub_location_id",
                            "type" => "select",
                            "options" => $sub_location_list,
                            "empty" => DROPDOWN_EMPTY_VALUE,
                            "div" => false, "label" => false, "escape" => false,
                            "class" => "form-control select2me",
                        )) ?>
                    </div>
                </div>
                <?php endif; ?>
                <div style="margin-top: 15px;">
                    <p id="scan-error-msg" class="alert alert-info" style="padding : 5px 10px;">Scan Result</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-offset-1 col-md-3 col-sm-12">        
        <div>
            Total Invoice Quantity : <b id="inventory-total-qty" style="font-size : 38px;"><?= isset($this->request->data[$model]['total_qty']) ? $this->request->data[$model]['total_qty'] : 0 ?></b>
        </div>
        <div>
            Quantity Scan by you : <b id="inventory-scan-qty" style="font-size : 38px;"></b>
            <br/>
            <span class="btn blue hidden" id="update_by_counting_serial_codes" data-inventory_id="<?= $this->request->data[$model]['id'] ?>">Update By counting serial codes <br/></span> 
        </div>
        <div>
            <img id="scan-product-image" style="height: 150px;">
        </div>
        <span id="scan-sku" style="font-size:34px;"></span>
    </div>
</div>

<script type="text/javascript">
    function update_scan_qty(qty)
    {
        var scan_qty = parseInt($("#inventory-scan-qty").html());
        scan_qty = scan_qty ? scan_qty : 0;
        scan_qty += qty;
        
        if (scan_qty < 0)
        {
            scan_qty = 0;
        }
        
        $("#inventory-scan-qty").html(scan_qty);
    }
    function check_total_qty_scan_qty(force_hide)
    {
        var total_qty = $("#inventory-total-qty").html().trim();
        var scan_qty = $("#inventory-scan-qty").html().trim();
        
        if (scan_qty != "" && total_qty != "")
        {
            scan_qty = parseInt(scan_qty);
            total_qty = parseInt(total_qty);
            
            if (scan_qty !== null && total_qty !== null && scan_qty != total_qty)
            {
                $("#update_by_counting_serial_codes").removeClass("hidden");
            }
        }
        
        if (force_hide)
        {
            $("#update_by_counting_serial_codes").addClass("hidden");
        }
    }
    
    $(document).on("click", "#update_by_counting_serial_codes", function()
    {
        var inventory_id = $(this).attr("data-inventory_id");
        
        $.get("/Inventories/ajaxUpdateQtyBySeriaCodes/" + inventory_id, function(response)
        {
            try
            {
                response = JSON.parse(response);
            }
            catch(e)
            {
                bootbox.alert(response);
                return;
            }
            
            if (response["status"])
            {
                var scan_qty = $("#inventory-scan-qty").html().trim();
                scan_qty = parseInt(scan_qty);
                
                var total_qty = parseInt(response["total_qty"]);
                
                $("#inventory-total-qty").html(total_qty);
                
                if (scan_qty == total_qty)
                {
                    $("#update_by_counting_serial_codes").addClass("hidden");
                }
            }
            else
            {
                bootbox.alert(response["msg"]);
            }
        });
    });
</script>