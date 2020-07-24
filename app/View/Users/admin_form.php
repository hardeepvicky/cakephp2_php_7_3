<?php
$disabled = $action == "admin_edit" ? "disabled" : "";
?>

<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
        </div>
        <div class="col-md-3 pull-right" style="text-align: right; margin-top: 4px;">
            <a href="<?= $this->Html->url(array("action" => "admin_index")); ?>" class="btn btn-circle blue-madison">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>
    </div>
</div>

<?= $this->element("page_header", array("title" => $title_for_layout)); ?>

<?php echo $this->Session->flash(); ?>

<div class="form__structure">
    <?php
        echo $this->Form->create($model, array(
            'type' => 'file',
            "class" => "form-horizontal form-row-seperated",
            'inputDefaults' => array(
                'label' => false, 'div' => false, 'div' => false, "escape" => false,
                "class" => "form-control", "type" => "text"
            )
        ));

        echo $this->Form->hidden('id');
    ?>
        <div class="form-body">
            <section class="section-head">
                <h3>Login Details</h3>
            </section>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Group <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('group_id', array(
                        "id" => "group_id",
                        "type" => "select",
                        "class" => "form-control select2me  ",
                        'options' => $group_list,
                        "empty" => EMPTY_SELECT
                        )); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Username <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('username', array('placeholder' => 'Username')); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Password <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('password', array('type' => 'password')); ?>
                </div>
            </div>

            <section class="section-head">
                <h3>Basic Details</h3>
            </section>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">First Name <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('firstname', array('placeholder' => 'First Name', array($disabled))); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Last Name :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('lastname', array('placeholder' => 'Last Name', array($disabled))); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Email <span>*</span> :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?= $this->Form->input('email', array('placeholder' => 'Email')); ?>
                </div>
            </div>
            
            
            <section class="section-head">
                <h3>Other Details</h3>
            </section>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-4 col-xs-12">Status :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="mt-checkbox-inline">
                        <label class="mt-checkbox mt-checkbox-outline">
                            <?= $this->Form->input('is_active', array('type' => 'checkbox')); ?> Active
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="action-buttons">
            <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
                <button type="submit" href="javascript:;" class="btn blue">Submit</button>
                <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $("select#group_id").change(function()
    {
        if ($(this).val() == "<?= GROUP_ADMIN ?>")
        {
            $("div.sub-admin").hide().find("select.required-input, input.required-input").removeAttr("required").attr("disabled", true);
        }
        else
        {
            $("div.sub-admin").show().find("select.required-input, input.required-input").attr("required", true).removeAttr("disabled");
        }
    });
    
    $(".user-doc-delete").click(function()
    {
        var href = $(this).attr("href");
        var tr = $(this).parents("tr");

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
                            tr.remove();
                        }
                        else
                        {
                            bootbox.alert("Can't be deleted, Please try again later");
                        }
                    });
                }
            }
        });

        return false;
    });
    
    $("#get_bank_detail_from_ifsc_code").click(function()
    {
        var code = $("#bank_ifsc_code").val();
        
        if (!code)
        {
            bootbox.alert("Enter Bank IFSC Code");
            return;
        }
        
        $.get("/Users/ajaxGetBankDetailFromIFSCCode/" + code, function(response) 
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
                var data = response["data"];
                console.log(data);
                
                var html = "";
                
                html += "<table class='table table-striped table-bordered order-column'>";
                    html += "<tr>";
                        html += "<th>Bank</th>";
                        html += "<td>";
                            html += data["BANK"];
                            html += '<input type="hidden" name="data[User][bank_name]" value="' + data["BANK"] + '" />';
                        html += "</td>";
                    html += "</tr>";
                    
                    html += "<tr>";
                        html += "<th>Bank Code</th>";
                        html += "<td>";
                            html += data["BANKCODE"];
                        html += "</td>";
                    html += "</tr>";
                    
                    html += "<tr>";
                        html += "<th>Branch</th>";
                        html += "<td>";
                            html += data["BRANCH"];
                        html += "</td>";
                    html += "</tr>";
                    
                    html += "<tr>";
                        html += "<th>Address</th>";
                        html += "<td>";
                            html += data["ADDRESS"];
                        html += "</td>";
                    html += "</tr>";
                html += "</table>";
                
                $("#bank_ifsc_code").parent().find(".help-block").html(html);
            }
            else
            {
                bootbox.alert(response["msg"]);
                return;
            }
        });
    });
    
    $("#salary_payment_mode").change(function () 
    {
        var v = $(this).val();
        
        if (v == '<?= PAYMENT_MODE_BANK_TRANSFER ?>')
        {
            $(".bank_transfer").find("input, select").attr("required", true).removeAttr("disabled");
            $(".bank_transfer").show();
        }
        else
        {
            $(".bank_transfer").find("input, select").attr("disabled", true).removeAttr("required");
            $(".bank_transfer").hide();
        }
    });

    $("select#group_id").trigger("change");
    
    $(".dept_id").trigger("change", { pageLoad : true});
    
    $("#salary_payment_mode").trigger("change", { pageLoad : true});
    
    $(".desg_id").change(function()
    {
        $(".auxllary_desg_id").val($(this).val()).trigger("change");
    });
});
</script>