<table class="table table-striped table-bordered order-column sr-databtable" id="pending_serial_codes">
    <thead>
        <tr>
            <th>#</th>
            <th data-search="1">SKU</th>
            <th data-search="1">Serial Code</th>
            <th data-search="1">Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $a = 0; 
            foreach ($serial_codes as $serial_code) : 
                $a++; 
                $serial_code["is_lost"] = $serial_code["BBSC"]["status"] == -1;
            ?>
            <tr class="<?= $serial_code["is_lost"] ? "" : "pending" ?> ">
                <td><?= $a ?></td>
                <td><?= $serial_code["P"]['sku'] ?></td>
                <td><?= $serial_code["BBSC"]["code"] ?></td>
                <td class="status"><?= StaticArray::$inventory_all_serial_code_status[$serial_code["BBSC"]["status"]] ?></td>
                <td>
                    <?php if ($serial_code["BBSC"]["status"] > -2) : ?>
                        <?php $url = $this->Html->url(array("controller" => "Batches", "action" => "ajaxSerialCodeLostToggle", $serial_code["BBSC"]["id"], "admin" => false)); ?>
                        <a href="<?= $url; ?>" class="toggle-serial-lost" data-field="is_lost" data-value="<?= $serial_code["is_lost"] ?>">
                            <?= $serial_code["is_lost"] ? "Declare as Found" : "Declare as Lost" ?>
                        </a>
                    <?php endif; ?>
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
    $("a.toggle-serial-lost").click(function()
    {
        var _this = $(this);
        var href = $(this).attr("href");
        var field = $(this).attr("data-field");
        var value = $(this).attr("data-value");

        var request = {};
        request[field] = value;

        $.post(href, request, function(data)
        {
            try
            {
                data = JSON.parse(data);
            }
            catch(e)
            {
                bootbox.alert(data);
                return;
            }

            if (data["status"] == "1")
            {
                _this.attr("data-value", data[field]);
                if (data[field] == "1")
                {
                    _this.html('Declare as Found');
                    _this.closest("tr").find(".status").html("Lost");
                    _this.closest("tr").removeClass("pending");
                }
                else
                {
                    _this.html('Declare as Lost');
                    _this.closest("tr").find(".status").html("Out");
                    _this.closest("tr").addClass("pending");
                }
            }
            else
            {
                bootbox.alert(data["msg"]);
            }
        });

        return false;
    });
    
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