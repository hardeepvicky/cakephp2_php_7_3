<div id="modal-inventory-tag" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Inventory Tag</h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-4 col-xs-12">Name <span>*</span> :</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $this->Form->input('name', array('placeholder' => 'Name', "id" => "inventory-tag-name", "class" => "form-control invalid-sql-char")); ?>
                            <span class="error-message"></span>
                        </div>
                    </div>    

                </div>
            </div>
            <div class="modal-footer">
                <span class="btn blue save">Save</span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("#add-inventory-tag").click(function()
        {
            $("#modal-inventory-tag").modal("show");
            //casecade_fill($("#inventory_tag_id"), response['list']);
        });
        
        $("#modal-inventory-tag .save").click(function()
        {
            var obj = $("#inventory-tag-name").parent();
            obj.find(".error-message").html("");
            
            var data = {
                name : $("#inventory-tag-name").val()
            };
            
            $.post("/InventoryTags/ajaxAdd", data, function(response)
            {
                try
                {
                    response = JSON.parse(response);
                }
                catch(e)
                {
                    bootbox.alert(response);
                    return false;
                }
                
                if (response['status'] == 1)
                {
                    casecade_fill($("#inventory_tag_id"), response['list']);
                    $("#inventory-tag-name").val("");
                    $("#modal-inventory-tag").modal("hide");
                }
                else
                {
                    if (typeof response['errors']['name'] != "undefined")
                    {
                        obj.find(".error-message").html(response['errors']['name']);
                    }
                }
            });
        });
    });
</script>