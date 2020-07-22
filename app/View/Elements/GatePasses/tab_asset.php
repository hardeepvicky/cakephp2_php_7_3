<span id="add_location" class="btn btn-default">Add Location</span>

<div id="location_asset"></div>

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
    var gate_pass_id = '<?= $this->request->data[$model]["id"] ?>';
    $(document).ready(function ()
    {
        $("#add_location").click(function()
        {
            $("#modal_location").modal("show");
        });
        
        $("form#GatePassLocation").submit(function(e)
        {
            e.preventDefault();
            
            $.post("/<?= $controller ?>/ajaxLocationSave", $(this).serializeArray(), function(response)
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
                    get_location_box(response["data"]["id"]);
                }
                else
                {
                    console.log(response["errors"]);
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
        
        $("#location_asset").on("click", "a.delete_location", function (e)
        {
            e.preventDefault();
            var _this = $(this);
            var href = $(this).attr("href");
            
            are_you_sure_to_delete(href, function ()
            {
                _this.closest(".portlet").remove();
            });
            
            return false;
        });
        
        $("#location_asset").on("click", "a.delete_asset", function (e)
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
        
        $("#location_asset").on("click", ".add_asset", function (e)
        {
            var gpl_id = $(this).attr("data-gpl_id");
            var url = "/<?= $controller ?>/ajaxAssetSave/gate_pass_id:" + gate_pass_id + "/gate_pass_location_id:" + gpl_id;
            
            $("#modal_form .modal-body").load(url);
            $("#modal_form .modal-title").html("Add Asset");
            $("#modal_form").modal("show");
        });
        
        $("#location_asset").on("click", "a.edit_asset", function (e)
        {
            var id = $(this).attr("data-id");
            var gpl_id = $(this).attr("data-gpl_id");
            var url = "/<?= $controller ?>/ajaxAssetSave/" + id + "/gate_pass_id:" + gate_pass_id + "/gate_pass_location_id:" + gpl_id;
            
            $("#modal_form .modal-body").load(url);
            $("#modal_form .modal-title").html("Edit Asset");
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
                    
                    if (typeof response["data"]["gate_pass_location_id"] == "undefined")
                    {
                        get_location_box();
                    }
                    else
                    {
                        get_location_box(response["data"]["gate_pass_location_id"]);
                    }
                }
                else
                {
                    var error_input_found = false;
                    if (typeof response["errors"] != "undefined")
                    {
                        for(var model in response["errors"])
                        {
                            for(var field in response["errors"][model])
                            {
                                var errors = response["errors"][model][field];
                                var key = "[name='data[" + model+ "][" + field + "]']";
                                var input = $("#modal_form").find("input" + key);
                                var select = $("#modal_form").find("select" + key);
                                
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
                            }
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
        })
        
        function get_location_box(gpl_id)
        {
            if (typeof gpl_id == "undefined")
            {
                $("#location_asset").load("/<?= $controller ?>/ajaxGetLocationAsset/" + gate_pass_id);
            }
            else
            {
                $.get("/<?= $controller ?>/ajaxGetLocationAsset/" + gate_pass_id + "/" + gpl_id, function(response)
                {
                    if ($("#gpl_" + gpl_id).length > 0)
                    {
                        $("#gpl_" + gpl_id).replaceWith(response);
                    }
                    else
                    {
                        $("#location_asset").append(response);
                    }
                });
            }
        }
        
        get_location_box();
    });
    
</script>