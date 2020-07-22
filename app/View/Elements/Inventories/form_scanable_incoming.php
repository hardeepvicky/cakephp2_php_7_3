<div class="form-body">
    <?= $this->element("$controller/scanable_form", array("sub_location_will_appear" => true)) ?>
    
    <div class="portlet box blue-hoki" style="margin-top : 5px;">
        <div class="portlet-title">
            <div class="caption">Scan</div>
        </div>
        <div class="portlet-body">
            <div class="form-group" style="max-height : 300px; overflow-y: scroll;">
                <?= $this->element("$controller/scanable_scan_table", array("sub_location_will_appear" => true, "last_operation_done_on_serial_code" => true)) ?>
            </div>
        </div>
    </div>
    
    <?= $this->element("$controller/scanable_inventory_detail_table", array("sub_location_will_appear" => true)) ?>
</div>  

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue next" name="data[next]" value="1">Next</button>
    </div>
</div>

<?= $this->element("Inventories/common_js_scanable") ?>
<script type="text/javascript">
var inventory_id = '<?= $this->request->data[$model]["id"] ?>';
var inventory_type = JSON.parse('<?= $this->request->data[$model]['type']; ?>');
var another_location = JSON.parse('<?= json_encode($another_location); ?>');
var is_reffer = '<?= (int) $this->request->data[$model]['is_reffer'] ?>';

$(document).ready(function() 
{        
    var product_template = Handlebars.compile(document.getElementById("product-template").innerHTML);
    
    $("form").on('keyup keypress', function(e) 
    {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
          e.preventDefault();
          return false;
        }
    });
    
    function sent_request(request)
    {
        $.post("/<?= $controller ?>/ajaxScanSerialCode/" + inventory_id, request, function(response, status)
        {
            if (status != "success")
            {
                bootbox.alert("Request Failed. Please try again");
                return;
            }

            try
            {
                response = JSON.parse(response);
            }
            catch (e)
            {
                bootbox.alert(response);
                return;
            }
            
            $("#scan-error-msg").removeClass("alert-info alert-success alert-danger");
            
            if (response["status"] == "0")
            {
                $("#scan-error-msg").html(response["msg"]).addClass("alert-danger");
                $("#text-to-speech").html(response["msg"]).articulate('speak');
                return;
            }
            else
            {
                $("#scan-error-msg").html("Last Scan " + request["code"]).addClass("alert-success");
            }

            $("b#inventory-total-qty").html(response["inventory_qty"]);
            
            var tr = $("tr.product-" + response["Product"]['id']);
            if ( tr.length == 0 )
            {
                var context = {
                    i : $("table#inventory tbody tr.inventory").length + 1,
                    product_id : response["Product"]['id'],
                    sku : response["Product"]['sku'],
                    rate : response["inventory_detail"]["rate"],
                    gst_per : response["inventory_detail"]["gst_per"],
                    inventory_detail_id : response['inventory_detail']['id']
                };

                var html = product_template(context);
                $("table#inventory > tbody").prepend(html);
                tr = $("table#inventory > tbody tr.inventory:first");
            }
            else
            {
                tr.find("span.inventory-qty").html(Math.abs(response["inventory_detail"]["qty"]));                
            }
            
            update_inventory_detail_amt(tr);

            $("#scan-product-sku").html(response['Product']['sku']);

            if ( typeof response['Image']['thumbnail'] != "undefined")
            {
                $("img#scan-product-image").attr("src", response['Image']['thumbnail']);
            }
            else
            {
                $("img#scan-product-image").attr("src", "/img/dummy.jpg");
            }

            var sub_location_name = $("#sub_location_id option[value=" + request["sub_location_id"] + "]").text();
            
            var scan_data = {
                serial_code : request["code"],
                product_id : response["Product"]['id'],
                sku : response["Product"]['sku'],
                sub_location_id : request["sub_location_id"],
                sub_location : sub_location_name,
                box : request["box_no"],
                last_operation : response["last_operation"]
            };

            var uniuqe_row_id = "code-" + scan_data["serial_code"];
            insert_scan_table(uniuqe_row_id, scan_data);
            insert_inventory_detail_product_table(uniuqe_row_id, scan_data);

            uniuqe_row_id = "box-" + scan_data["box"] + "-sub_location-" + scan_data["sub_location_id"];
            insert_update_box_table(uniuqe_row_id, scan_data);
        });
    }
    
    
    $(document).on("keydown", "input#scan-code", function(e) 
    {
        var code = (e.keyCode ? e.keyCode : e.which);
        if( code == 13)// Enter key hit
        {
            var _this = $(this);
            var serial_code = $(this).val();
            
            $(this).val("");
            
            if ( !$("#scan-box").val() )
            {
                bootbox.alert("Enter Box no.");
                $("#text-to-speech").html("Enter Box Number").articulate('speak');
                return;
            }
            
            if ( !$("select#sub_location_id").val() )
            {
                bootbox.alert("Please Select Sub Location");
                $("#text-to-speech").html("Please Select Sub Location").articulate('speak');
                return;
            }
            
            sent_request({
                code : serial_code,
                sub_location_id : $("select#sub_location_id").val(),
                box_no : $("#scan-box").val()
            });
        }
    });
});
</script>