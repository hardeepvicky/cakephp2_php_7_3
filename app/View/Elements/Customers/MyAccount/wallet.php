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
            Wallet Transactions
        </div>
    </h1>
    <table class="table-shopping-cart main-table">
        <thead>
            <tr class="table_head">
                <td style='width : 10%'>#</td>
                <td>Details</td>
                <td>Amount</td>
            </tr>
        </thead>
        <tbody>
            <?php $j = 0; foreach($records as $record): $j++; ?>
            <tr>
                <td><?= $j ?></td>
                <td>
                    <?= $record["CustomerWalletTransaction"]["detail"] ?>
                </td>
                <td>
                    <?= $record["CustomerWalletTransaction"]["amount"] ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>