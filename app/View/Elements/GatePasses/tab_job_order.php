`<span id="add_location" class="btn btn-default">Add Location</span>

<div id="location_job_order"></div>

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
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Job Orders <span>*</span> :</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <?= $this->Form->input('GatePassJobOrder.job_order_id', [
                                    "id" => "job_order_id",
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

<div id="modal_form" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Box</h4>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: scroll;">
                
            </div>
            <div class="modal-footer">
                <span class="btn blue save">Save</span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var gate_pass_id = '<?= $this->request->data[$model]['id'] ?>';
    var current_gpjb_id = 0;
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
            
            $.get("/<?= $controller ?>/ajaxGetJobOrderList/" + v, function(response)
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
                    
                    $("select#job_order_id").html(html);
                }
            });
        });
        
        $("form#GatePassLocation").submit(function (e)
        {
            e.preventDefault();
            
            $.post("/<?= $controller ?>/ajaxLocationJobOrderSave", $(this).serializeArray(), function(response)
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
                    get_location_job_order(response["data"]["id"]);
                }
                else
                {
                    var error_input_found = false;
                    if (typeof response["errors"] != "undefined")
                    {
                        for(var model in response["errors"])
                        {
                            error_input_found = form_errors($("#modal_location"), model, response["errors"]);
                        }
                    }
                    
                    if (!error_input_found)
                    {
                        bootbox.alert(response["msg"]);
                    }
                }
            });
            
            return false;
        });
        
        function are_you_sure_to_delete(href, callback)
        {
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
                        $.get(href, function(response)
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
                                callback();
                            }
                            else
                            {
                                bootbox.alert(response["msg"]);
                            }
                        });
                    }
                }
            });
        }
        
        function form_errors(form, model, errors)
        {
            form.find(".error-message").remove();
            var error_input_found = false;
            for(var field in errors[model])
            {
                var errors = errors[model][field];
                var key = "[name='data[" + model+ "][" + field + "]']";
                var input = form.find("input" + key);
                var select = form.find("select" + key);
                

                if (input.length > 0)
                {
                    error_input_found = true;
                    for(var e in errors)
                    {
                        input.parent().append('<span class="error-message">' + errors[e] + '<span>');
                    }
                }
                
                if (select.length > 0)
                {
                    error_input_found = true;
                    for(var e in errors)
                    {
                        select.parent().append('<span class="error-message">' + errors[e] + '<span>');
                    }
                }
                
                key = "[name='data[" + model+ "][" + field + "][]']";
                select = form.find("select" + key);
                if (select.length > 0)
                {
                    error_input_found = true;
                    for(var e in errors)
                    {
                        select.parent().append('<span class="error-message">' + errors[e] + '<span>');
                    }
                }
            }
            
            return error_input_found;
        }
        
        $("#location_job_order").on("click", "a.delete_location, a.delete_job_order, a.delete_box, a.delete_item", function (e)
        {
            e.preventDefault();
            var _this = $(this);
            var href = $(this).attr("href");
            
            are_you_sure_to_delete(href, function ()
            {
                var obj = _this.attr("data-onDeleteRemove");
                $(obj).remove();
            });
            
            return false;
        });
        
        $("#location_job_order").on("click", ".add_box", function (e)
        {
            var gpl_id = $(this).attr("data-gpl_id");
            var gpjb_id = $(this).attr("data-gpjb_id");
            current_gpjb_id = gpjb_id;
            var url = "/<?= $controller ?>/ajaxBoxSave/gate_pass_id:" + gate_pass_id + "/gate_pass_location_id:" + gpl_id  + "/gate_pass_job_order_id:" + gpjb_id;
            
            $("#modal_form .modal-body").load(url);
            $("#modal_form .modal-title").html("Add Box");
            $("#modal_form").modal("show");
        });
        
        $("#location_job_order").on("click", "a.edit_box", function (e)
        {
            var id = $(this).attr("data-id");
            var gpl_id = $(this).attr("data-gpl_id");
            var gpjb_id = $(this).attr("data-gpjb_id");
            current_gpjb_id = gpjb_id;
            var url = "/<?= $controller ?>/ajaxBoxSave/" + id + "/gate_pass_id:" + gate_pass_id + "/gate_pass_location_id:" + gpl_id  + "/gate_pass_job_order_id:" + gpjb_id;
            
            $("#modal_form .modal-body").load(url);
            $("#modal_form .modal-title").html("Edit Box");
            $("#modal_form").modal("show");
        });
        
        $("#location_job_order").on("click", ".add_item", function (e)
        {
            var box_id = $(this).attr("data-box_id");
            var gpl_id = $(this).attr("data-gpl_id");
            current_gpjb_id = $(this).closest(".gate_pass_job_order").attr("data-id");
            var url = "/<?= $controller ?>/ajaxItemSave/gate_pass_id:" + gate_pass_id + "/gate_pass_location_id:" + gpl_id + "/box_id:" + box_id;
            
            $("#modal_form .modal-body").load(url);
            $("#modal_form .modal-title").html("Add Item");
            $("#modal_form").modal("show");
        });
        
        $("#location_job_order").on("click", "a.edit_item", function (e)
        {
            var id = $(this).attr("data-id");
            var gpl_id = $(this).attr("data-gpl_id");
            var box_id = $(this).attr("data-box_id");
            current_gpjb_id = $(this).closest(".gate_pass_job_order").attr("data-id");
            var url = "/<?= $controller ?>/ajaxItemSave/" + id + "/gate_pass_id:" + gate_pass_id + "/gate_pass_location_id:" + gpl_id + "/box_id:" + box_id;
            
            $("#modal_form .modal-body").load(url);
            $("#modal_form .modal-title").html("Edit Item");
            $("#modal_form").modal("show");
        });
        
        $("#modal_form").on("submit", "form", function(e)
        {
            e.preventDefault();
            
            var _this = $(this);
            
            $("#modal_form").find(".error-message").remove();
            
            $.post(_this.attr("action"), _this.serializeArray(), function(response)
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
                    $("#modal_form").modal("hide");
                    get_location_box(current_gpjb_id);
                }
                else
                {
                    var error_input_found = false;
                    if (typeof response["errors"] != "undefined")
                    {
                        for(var model in response["errors"])
                        {
                            error_input_found = form_errors($("#modal_form"), model, response["errors"]);
                        }
                    }
                    
                    if (!error_input_found)
                    {
                        bootbox.alert(response["msg"]);
                    }
                }
            });
            
            false;
        })
        
        $("#modal_form .save").click(function()
        {
            var form = $("#modal_form form");                
            if( form[0].checkValidity()) 
            {
                form.trigger("submit");
            }
            else
            {
                form[0].reportValidity();
            }
        });
        
        function get_location_box(gpjb_id)
        {
            $("#gpjb_" + gpjb_id).find(".box_item").load("/<?= $controller ?>/ajaxGetJobOrderBox/" + gpjb_id);
        }
        
        function get_location_job_order(gpl_id)
        {
            if (typeof gpl_id == "undefined")
            {
                $("#location_job_order").load("/<?= $controller ?>/ajaxGetLocationJobOrder/" + gate_pass_id);
            }
            else
            {
                $.get("/<?= $controller ?>/ajaxGetLocationJobOrder/" + gate_pass_id + "/" + gpl_id, function(response)
                {
                    if ($("#gpl_" + gpl_id).length > 0)
                    {
                        $("#gpl_" + gpl_id).replaceWith(response);
                    }
                    else
                    {
                        $("#location_job_order").append(response);
                    }
                });
            }
        }
        
        get_location_job_order();
    })
</script>
