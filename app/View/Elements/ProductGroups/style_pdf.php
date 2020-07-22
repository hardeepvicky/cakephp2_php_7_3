<style>
    body{
        font-size: 11px;
        margin: 0;
        padding: 0;
    }
    
    @page {
        padding: 50px 80px;
    }
    
    table{
        width : 100%;
        border-collapse: collapse;
    }
    
    .ceil
    {
        padding : 8px 10px;
        border : 1px solid #000;
    }
    
    .summary_header_footer{
        background-color: #EEE;
    }
    
    .page_break { page-break-before: always; }
</style>
                
<div class="page" style="background-color: #FFF; color: #000;">
    <div style="border-bottom: 1px solid #000;  margin-bottom: 20px;">
        <div style="text-align: center; ">
            <p style="font-size: 22px;">Seven Rocks International</p>
        </div>
        <div>
            <div style="float:left; width : 40%">
                <p><b>Product Group (Style) : </b> <?= $record["product_group"]["ProductGroup"]["name"] ?></p>
                <p><b>Category : </b> <?= $record["product_group"]["Category"]["name"] ?></p>
                <p><b>Brand : </b> <?= implode(", ", $record["brands"]) ?></p>
                <p><b>Product Count : </b> <?= count($record["products"]) ?></p>
            </div>
            <div style="float:right; width : 40%; text-align: right">
                <img style="height : 120px; width : auto" src="<?= $record["product_group"]["image"] ?>">
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
        
    <h2>Ideal Consumption</h2>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 30%;">Consumed Sku</th>                    
                <th class="ceil" style="width : 15%;">Avg. Price</th>
                <th class="ceil" style="width : 15%;">Avg. Qty</th>
                <th class="ceil" style="width : 15%;">Costing</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; $amt = 0; foreach ( $record["ideal_consmption"] as $ideal_consmption ): $c++; $amt += $ideal_consmption['amt'] ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $ideal_consmption['sku'] ?></td>
                    <td class="ceil"><?= $ideal_consmption['price'] ?></td>
                    <td class="ceil"><?= $ideal_consmption['qty'] ?></td>
                    <td class="ceil"><?= $ideal_consmption['amt'] ?></td>
                </tr>                
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="ceil" colspan="4"></td>
                <td class="ceil"><?= $amt ?></td>
            </tr>
        </tfoot>
    </table>
    
    <h2>Product Operations</h2>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 20%;">Operation Type</th>                    
                <th class="ceil" style="width : 15%;">Occurance</th>                    
                <th class="ceil" style="width : 15%;">Avg. Rate</th>
                <th class="ceil" style="width : 15%;">Costing</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; $amt = 0;  foreach ( $record["product_operation"] as $product_operation ):  $c++; $amt += $product_operation['amt'] ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $product_operation['operation_type'] ?></td>
                    <td class="ceil"><?= $product_operation['occurance'] ?></td>
                    <td class="ceil"><?= $product_operation['rate'] ?></td>
                    <td class="ceil"><?= $product_operation['amt'] ?></td>
                </tr>                
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td class="ceil" colspan="4"></td>
                <td class="ceil"><?= $amt ?></td>
            </tr>
        </tfoot>
    </table>
    
    <h4>Variable Cost : <?= $record["variable_cost"] ?></h4>
    <h4>Overhead : <?= round($record["overhead"] * $amt / 100, 2) ?></h4>
</div>