<?php
    $disabled = $action == "admin_edit" ? "disabled" : "";
    
    echo $this->Form->create($model, array(
        'type' => 'file',
        "class" => "form-horizontal form-row-seperated",
        'inputDefaults' => array(
            'label' => false, 'div' => false, 'div' => false, "escape" => false,
            "class" => "form-control", "type" => "text"
        )
    ));

    echo $this->Form->hidden('id');
    echo $this->Form->hidden('tab_name');
?>

<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Gate Pass No. :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('gate_pass_no', array("readOnly")); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Type <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('type', [
                "id" => "type",
                "type" => "select",
                "class" => "form-control select2me",
                "options" => GatePass::TYPE_LIST,
                "empty" => DROPDOWN_EMPTY_VALUE,
                $disabled
            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Carier <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('carier_id', [
                "type" => "select",
                "class" => "form-control select2me",
                "options" => $carrier_list,
                "empty" => DROPDOWN_EMPTY_VALUE,
            ]); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Picker Name <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('picker_name', array("placeholder" => "Picker Name")); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Picker Mobile <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('picker_mobile', ["placeholder" => "Picker Mobile", "class" => "form-control validate-mobile"]); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12"></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="mt-checkbox-inline">
                <label class="mt-checkbox mt-checkbox-outline">
                    <?= $this->Form->input('is_returnable', array('id' => 'is_returnable', 'type' => 'checkbox')); ?> Is Returnable
                    <span></span>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Comments :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('comments', array(
                "type" => "textarea",
                'placeholder' => 'Comments',
                "rows" => 4
            )); ?>
        </div>
    </div>

    <div class="form-group return">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Estimated Return Date <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('esitmated_return_date', [
                "placeholder" => "dd-MMM-YYY",
                "class" => "form-control date-picker", 
                "data-date-start" => 0, 
                "autocomplete" => "off"
            ]); ?>
        </div>
    </div>

    <div class="form-group return">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Return Comments <span>*</span>:</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('return_comments', array(
                "type" => "textarea",
                'placeholder' => 'Return Comments',
                "rows" => 4
            )); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Images :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div>
                <input type="file" name="data[files][]" multiple="multiple" accept="image/x-png,image/gif,image/jpeg" data-max-size='10mb' data-type='image'>
            </div>
            <span class="help-block">
                <ul>
                    <li>File size must not exceed 10mb</li>
                </ul>
            </span>
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
                    if (isset($this->request->data["GatePassImage"]) && $this->request->data["GatePassImage"]):
                        foreach($this->request->data["GatePassImage"] as $i => $file):
                            echo $this->Form->hidden("GatePassImage.$i.id");
                            echo $this->Form->hidden("GatePassImage.$i.image");
                    ?>
                    <tr>
                        <td>
                            <img class="small-img" src="<?= FileUtility::get($file['image']) ?>">
                            <br/>
                            <?php 
                                $name = pathinfo($file['image'], PATHINFO_BASENAME); 
                                $name = explode("?", $name)[0];
                                echo $name;
                            ?>
                        </td>
                        <td>
                            <a href="<?= FileUtility::get($file['image']); ?>" target="_blank">Download</a>
                        </td>
                        <td>
                            <a href="<?= $this->Html->url(array("action" => "admin_delete_file", $file["id"])) ?>" class="file-delete" data-id="<?= $file['id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; endif;?>      
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" name="data[next]" value="1" class="btn blue" style="max-width : 150px;">Save & Next</button>
        <?php if ($action == "admin_edit"): ?>
            <button type="submit" class="btn blue">Save</button>
        <?php endif; ?>
    </div>
</div>

<?php echo $this->Form->end(); ?>  

<script type="text/javascript">
    $(document).ready(function()
    {
        $("input[type=file]").fileValidator(
        {
            onValidation: function(files)
            {      
                $(this).parent().find(".error-message").remove();
            },
            onInvalid: function(validation, file) 
            {
                var msg = "";

                if (validation == "type")
                {
                    msg = "Invalid File Type";
                }
                else if (validation == "maxSize")
                {
                    msg = "File size can not greater than 10mb";
                }

                $(this).parent().append("<span class='error-message'>" + msg +"</span>")
                $(this).val(null);
            },
        });
    
        $(".file-delete").click(function()
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
        
        $("#is_returnable").change(function()
        {
           if (this.checked)
           {
                $(".return").find("input").attr("required", true).removeAttr("disabled");
                $(".return").show();
           }
           else
           {
                $(".return").find("input").attr("disabled", true).removeAttr("required");
                $(".return").hide();
           }
        });
        
        $("#is_returnable").trigger("change");
    });
</script>
