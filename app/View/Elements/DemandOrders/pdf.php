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
        font-size: 11px;
    }
    
    .ceil
    {
        padding : 8px 10px;
        border : 1px solid #000;
    }
    
    .summary_header_footer{
        background-color: #EEE;
    }
    
    tr.center td
    {
        text-align: center;
        vertical-align: middle;
    }
    
    .page_break { page-break-before: always; }
</style>
                
<div class="page" style="background-color: #FFF; color: #000;">
    <div style="border-bottom: 1px solid #000;  margin-bottom: 20px;">
        <div style="text-align: center; ">
            <p style="font-size: 22px;">Seven Rocks International</p>
            <p style="font-size: 18px;">Purchase Order</p>
        </div>
        <div>
            <div style="float:left; width : 40%">
                <p><b>Purchase Order No. : </b> <?= $record["DemandOrder"]["demand_order_no"] ?></p>
                <p><b>Company Address : </b> <?= $record["company_address"] ?></p>
                <p><b>Company Email : </b> <?= $record["contact_email"] ?></p>
                <p><b>Company Phone : </b> <?= $record["company_phone"] ?></p>
            </div>
            <div style="float:right; width : 40%; text-align: right">
                <h3>Bill To</h3>
                <p><b>Party : </b> <?= $record["Party"]["name"] ?></p>
                <p><b>Party GST No.: </b> <?= $record["Party"]["gst_no"] ?></p>
                <p><b>Address : </b> <?= $record["L"]["address"] ?>, <?= $record["City"]["name"] ?>, <?= $record["State"]["name"] ?></p>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
        
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 8%;">Sr. No.</th>
                <th class="ceil" style="width : 15%;">Item</th>                    
                <th class="ceil" style="width : 22%;">Sku</th>                      
                <th class="ceil" style="width : 7%;">UOM</th>                      
                <th class="ceil" style="width : 9%;">Price</th>
                <th class="ceil" style="width : 8%;">GST(%)</th>
                <th class="ceil" style="width : 8%;">Qty</th>
                <th class="ceil" style="width : 12%;">GST</th>
                <th class="ceil" style="width : 15%;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; $total_amt = 0; $total_gst = 0; 
            foreach ( $record["detail"] as $detail ): 
                $c++; 
            
                $amt = $detail["DOD"]["price"] * $detail["DOD"]["qty"];
                $gst = round($amt * $detail["DOD"]["gst_per"]/ 100, 2);
                
                $total_amt += $amt;
                $total_gst += $gst;
            ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $detail["P"]["name"] ?></td>
                    <td class="ceil"><?= $detail["P"]["sku"] ?></td>
                    <td class="ceil"><?= $detail["MU"]["short_name"] ?></td>
                    <td class="ceil"><?= $detail["DOD"]["price"] ?></td>
                    <td class="ceil"><?= $detail["DOD"]["gst_per"] ?></td>
                    <td class="ceil"><?= $detail["DOD"]["qty"] ?></td>
                    <td class="ceil"><?= $gst ?></td>
                    <td class="ceil"><?= $amt ?></td>
                </tr>                
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="center">
                <td class="ceil" colspan="7"></td>
                <td class="ceil"><?= $total_gst ?></td>
                <td class="ceil"><?= $total_amt ?></td>
            </tr>
            <tr class="center">
                <td class="ceil" colspan="8" style="text-align: right">Total Amount</td>
                <td class="ceil"><?= $total_gst + $total_amt ?></td>
            </tr>
        </tfoot>
    </table>
    
    <br/><br/>
    <b>Terms & Conditions</b><br/>
    <p><?= $record["demand_order_terms_and_conditions"] ?></p>
    
    <br/><br/>
    <p>Authorized Signature _____________________________________________________</p>
</div>