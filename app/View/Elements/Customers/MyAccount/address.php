<style>
    .table-shopping-cart td{
        padding : 5px;
    }
    
    .table-shopping-cart tr:nth-child(even){
        background-color: #EEE;
    }
</style>
<div class="container m-t-15 m-b-15">
    <h1 class="m-b-20 row">
        <div class="col-md-9 col-sm-12">
            Address Book
        </div>
        <div class="col-md-3 col-sm-12" style="text-align : right">
            <span class="stext-101 cl0 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer add-shipping-address">
                Add New 
            </span>
        </div>
    </h1>
    <table class="table-shopping-cart main-table">
        <thead>
            <tr class="table_head">
                <td style='width : 10%'>#</td>
                <td>Contact Person</td>
                <td>Address</td>
                <td>City</td>
                <td>State</td>
                <td style='width : 10%'>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php $j = 0; foreach($records as $record): $j++; ?>
            <tr>
                <td><?= $j ?></td>
                <td>
                    <?= $record["CustomerAddress"]["contact_person_name"] ?><br/>
                    M : <?= $record["CustomerAddress"]["contact_no"] ?><br/>
                </td>
                <td>
                    <?= $record["CustomerAddress"]["address"] ?><br/>
                    <?= $record["CustomerAddress"]["address2"] ?><br/>
                    Pincode-<?= $record["CustomerAddress"]["pincode"] ?>
                </td>
                <td>
                    <?= $record["City"]["name"] ?>                    
                </td>
                <td>
                    <?= $record["State"]["name"] ?>    
                </td>
                <td>
                    <span class="btn btn-link pointer edit-shipping-address" data-id="<?= $record["CustomerAddress"]["id"] ?>">Edit</span>
                </td>                
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $(".add-shipping-address").click(function()
    {
        CustomerAddress.onSave = function() {
            window.location.reload();
        };
        CustomerAddress.show();
    });

    $(document).on("click", ".edit-shipping-address", function()
    {
        var id = $(this).attr("data-id");
        CustomerAddress.onSave = function() {
            window.location.reload();
        };
        CustomerAddress.show(id);
    });
});
</script>