`<span id="add_location" class="btn btn-default">Add Location</span>

<div id="location_invoice"></div>

<div id="modal_location" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        echo $this->Form->create("GatePassLocation", array(
            "id" => "GatePassLocation",
            "class" => "form-horizontal form-row-seperated",
            'inputDefaults' => array(
                'label' => false, 'div' => false, 'div' => false, "escape" => false,
                "class" => "form-control invalid-sql-char", "type" => "text"
            )
        ));
        
        echo $this->Form->hidden("gate_pass_id", [ "value" => $this->request->data[$model]["id"]  ] );
    ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Location</h4>
                </div>
                <div class="modal-body" style="max-height: 80vh; overflow-y: scroll;">
                     <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Location <span>*</span> :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('location_id', [
                                    "id" => "location_id",
                                    "type" => "select",
                                    "options" => $location_list,
                                    "empty" => DROPDOWN_EMPTY_VALUE,
                                    "class" => "form-control select2me",
                                    "required" => true
                                ]); ?>
                            </div>
                        </div>
                         
                         <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Invoices <span>*</span> :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('GatePassInvoice.inventory_id', [
                                    "id" => "inventory_id",
                                    "type" => "select",
                                    "options" => [],
                                    "class" => "form-control select2me",
                                    "multiple" => true,
                                    "required" => true
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn blue">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    var gate_pass_id = '<?= $this->request->data[$model]['id'] ?>';
    $(document).ready(function()
    {
        $("#add_location").click(function()
        {
            $("#modal_location").modal("show");
        });
        
        $("select#location_id").change(function()
        {
            var v = $(this).val();
            v = v ? v : 0;
            
            $.get("/<?= $controller ?>/ajaxGetInvoiceList/" + v, function(response)
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
                
                if (response["status"] == "1")
                {
                    var html = '';
                    
                    for (var i in response["data"])
                    {
                        var name = response["data"][i];
                        
                        html += '<option value="' + i + '">' + name + '</option>';
                    }
                    
                    $("select#inventory_id").html(html);
                }
            });
        });
        
        $("form#GatePassLocation").submit(function (e)
        {
            e.preventDefault();
            
            $.post("/<?= $controller ?>/ajaxLocationInvoiceSave", $(this).serializeArray(), function(response)
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
                
                
                if (response["status"] == "1")
                {
                    $("#modal_location").find("select").val("").trigger("change");
                    $("#modal_location").modal("hide");
                    get_location_invoices();
                }
                else
                {
                    console.log(response["errors"]);
                }
            });
            
            return false;
        });
        
        
        function get_location_invoices()
        {
            $("#location_invoice").load("/<?= $controller ?>/ajaxGetLocationInvoice/" + gate_pass_id);
        }
        
        get_location_invoices();
    })
</script>
