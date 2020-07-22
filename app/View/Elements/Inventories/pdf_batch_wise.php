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
            <p style="font-size: 12px;"><?= $company_address ?></p>
        </div>
        <div>
            <div style="float : left; width : 40%">
                <p><b>From : </b> <?= $record["FromLocation"]["name"] ?></p>
                <p><b>From Address : </b> <?= $record[0]["from_full_address"] ?></p>
                <p><b>Invoice No : </b> <?= $record["Inventory"]["invoice_no"] ?></p>
                <p><b>Challan No : </b> <?= $record["Inventory"]["challan_no"] ?></p>
            </div>
            <div style="float : right; width : 40%; text-align: right;">
                <p><b>To : </b> <?= $record["ToLocation"]["name"] ?></p>
                <p><b>To Address : </b> <?= $record[0]["to_full_address"] ?></p>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
        
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 30%;">Batch</th>                    
                <th class="ceil" style="width : 30%;">Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $batches as $c => $batch ): ?>
                <tr class="center">
                    <td class="ceil"><?= $c + 1 ?></td>
                    <td class="ceil"><?= $batch["B"]['name'] ?></td>
                    <td class="ceil"><?= $batch[0]['c'] ?></td>
                </tr>                
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="page_break"></div>