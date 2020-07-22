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
            <p style="font-size: 26px;">Seven Rocks International</p>
        </div>
        <div>
            <div style="float : left; width : 40%">
                <p><b>Batch : </b> <?= $record["Batch"][0]["name"] ?></p>
                <p><b>Product Group (Style) : </b> <?= $record["ProductGroup"]["name"] ?></p>
                <p><b>Order Qty : </b> <?= $record["ManufactureOrder"]["qty"] ?></p>
            </div>
            <div style="float : right; width : 40%; text-align: right;">
                <p><b>Order On : </b> <?= DateUtility::getDate($record["ManufactureOrder"]["created"], DateUtility::DATETIME_OUT_FORMAT) ?></p>
                <p><b>Order By : </b> <?= $record["ManufactureOrder"]["created_by"] ?></p>
                <p><b>Order Completed : </b> <?= $record["ManufactureOrder"]["is_completed"] ? "Yes" : "No" ?></p>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
        
    <h2>Sizes</h2>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 30%;">Size</th>                    
                <th class="ceil" style="width : 15%;">Ratio</th>
                <th class="ceil" style="width : 15%;">Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $sizes as $c => $size ): ?>
                <tr class="center">
                    <td class="ceil"><?= $c + 1 ?></td>
                    <td class="ceil"><?= $size['code'] ?></td>
                    <td class="ceil"><?= $size['ratio'] ?></td>
                    <td class="ceil"><?= $size['qty'] ?></td>
                </tr>                
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h2>Colors</h2>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 20%;">Color Name</th>                    
                <th class="ceil" style="width : 20%;">Color Code</th>                    
                <th class="ceil" style="width : 15%;">Ratio</th>
                <th class="ceil" style="width : 15%;">Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $colors as $c => $color ): ?>
                <tr class="center">
                    <td class="ceil"><?= $c + 1 ?></td>
                    <td class="ceil"><?= $color['name'] ?></td>
                    <td class="ceil"><?= $color['code'] ?></td>
                    <td class="ceil"><?= $color['ratio'] ?></td>
                    <td class="ceil"><?= $color['qty'] ?></td>
                </tr>                
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="page_break"></div>
    
    <h2>Consumption Products</h2>
    <?php foreach($product_ideal_consumptions as $parent_category_name => $ideal_consumptions): ?>
        <h3><?= $parent_category_name ?></h3>
        <table>
            <thead>
                <tr class="summary_header_footer center">
                    <th class="ceil" style="width : 10%;">Sr. No.</th>
                    <th class="ceil" style="width : 30%;">Product</th>                    
                    <th class="ceil" style="width : 15%;">Qty</th>                    
                    <th class="ceil" style="width : 10%;">Unit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $ideal_consumptions as $c => $consumption ): ?>
                    <tr class="center">
                        <td class="ceil"><?= $c + 1 ?></td>
                        <td class="ceil"><?= $consumption['product'] ?></td>
                        <td class="ceil"><?= $consumption['qty'] ?></td>
                        <td class="ceil"><?= $consumption['unit'] ?></td>
                    </tr>                
                <?php endforeach; ?>
            </tbody>
        </table>
        <p style="text-align: center">
            ----------------------------------Cut Here-----------------------------------------------
        <p>
    <?php endforeach; ?>
</div>