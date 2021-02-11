<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
        </div>
        <div class="col-md-3 pull-right" style="text-align: right; padding-top: 4px;">
            <a id="create" href="/Users/acl" class="btn blue btn-circle">Create</a>
        </div>
    </div>
</div>
<style>
    .first-row
    {
        border-top: 2px solid #4c667f;
    }
</style>
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
    ?>

    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Group <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?=
                $this->Form->input('group_id', array(
                    "id" => "group_id",
                    "type" => "select",
                    "class" => "form-control select2me  ",
                    'options' => $group_list,
                    "empty" => EMPTY_SELECT
                ));
                ?>
            </div>
        </div>

        <div id="permission_block"></div>
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
    $(document).ready(function ()
    {
        $("#group_id").change(function ()
        {
            var v = $(this).val();
            v = v ? v : 0;
            
            if ($("#permission_block").not(":empty").length > 0)
            {
                bootbox.confirm({
                    message: "You have change permissions but did not save it, Are you sure to ignore changes",
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
                            $("#permission_block").html("");
                            if (v)
                            {
                                $("#permission_block").load("/Users/ajaxGetPermissions/" + v);
                            }
                        }
                    }
                });
            }
            else
            {
                $("#permission_block").html("");
                if (v)
                {
                    $("#permission_block").load("/Users/ajaxGetPermissions/" + v);
                }
            }
        });
        
        $("#create").click(function()
        {
            var url = $(this).attr("href");
            
            $.get(url);
            
            return false;
        })
        
        $("#group_id").trigger("change");
    });
</script>