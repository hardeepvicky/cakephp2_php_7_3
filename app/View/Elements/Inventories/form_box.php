<table class="table table-striped table-bordered order-column">
    <thead>
        <tr>
            <th>#</th>
            <th>Box</th>
            <th>Qty</th>
            <th>Weight</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $a = 0; 
            foreach ($this->request->data["Box"] as $b => $box): 
                $a++;
            ?>
            <tr>
                <td><?= $a ?></td>
                <td><?= $box["box_no"] ?></td>
                <td><?= $box["qty"] ?></td>
                <td>
                    <?= $this->Form->hidden("Box.$b.id"); ?>
                    <?= $this->Form->hidden("Box.$b.box_no"); ?>
                    <?= $this->Form->hidden("Box.$b.qty"); ?>
                    <?= $this->Form->input("Box.$b.weight", [
                        "class" => "form-control validate-float",
                        "required"
                    ]); ?>
                </td>                
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($this->request->data[$model]["created_by"] == $auth_user["id"]): ?>
<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue submit" name="data[submit]" value="1">Submit</button>
    </div>
</div>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function()
{
    var submit_confirm = false;
    $("form").submit(function ()
    {
        if ($("table#pending_serial_codes").find("tr.pending").length > 0)
        {
            bootbox.alert("Some Serial Codes are not declared as lost, Please decalre them lost or scan it");
            return false;
        }
        
        if (!submit_confirm)
        {
            bootbox.confirm({
                message: "Are you sure to submit. Once you submit you can't edit",
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
                        $("button.submit").trigger("click");
                    }
                }
            });

            return false;
        }
    });
});
</script>