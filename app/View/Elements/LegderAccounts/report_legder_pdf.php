<style>
    body{
        font-size: 10px;
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
        padding : 2px 5px;
        border : 1px solid #000;
    }
    
    .summary_header_footer{
        background-color: #EEE;
    }
    
    .page_break { page-break-before: always; }
</style>
                
<div class="page" style="background-color: #FFF; color: #000;">
    <table>
        <thead style="border : 1px solid #000;">
            <tr>
                <th style="text-align: center; padding : 8px 10px;">
                    <p style="font-size: 26px;">Seven Rocks International</p>
                    <p style="font-size: 20px;">Legder Report</p>
                </th>
            </tr>
        </thead>
    </table>
    <?php foreach($records as $record): ?>
        <table>
            <thead style="border : 1px solid #000;">
                <tr>
                    <th>Ledger Account : <?= $record["conditions"]["ledger_account"] ?></th>
                    <th>From Date : <?= $record["conditions"]["from_date"] ?></th>
                    <th>To Date : <?= $record["conditions"]["to_date"] ?></th>
                </tr>
                <tr>
                    <th>Opening Balance : <?= $record["opening_balance"] ?></th>
                    <th>Total Current : <?= $record["total_current"] ?></th>
                    <th>Closing Balance : <?= $record["closing_balance"] ?></th>
                </tr>
            </thead>
        </table>
        <table>
            <thead>
                <tr class="summary_header_footer center">
                    <th class="ceil" style="width : 5%;">Sr. No.</th>
                    <th class="ceil" style="width : 12%;">Party</th> 
                    <th class="ceil" style="width : 10%">Voucher</th>
                    <th class="ceil" style="width : 10%">Booked Datetime</th>
                    <th class="ceil" style="width : 10%">Amount</th>
                    <th class="ceil" style="width : 10%">Net Balance</th>
                    <th class="ceil" style="width : 12%">Created By</th>
                    <th class="ceil" style="width : 12%">Verified By</th>
                    <th class="ceil">Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $record["current"] as $c => $record ): ?>
                    <tr class="center">
                        <td class="ceil"><?= $c + 1 ?></td>
                        <td class="ceil"><?= $record['legder_account'] ?></td>
                        <td class="ceil"><?= $record['voucher_type'] ?> <br/> <?= $record['voucher_no']; ?></td>
                        <td class="ceil"><?= $record['datetime'];  ?></td>
                        <td class="ceil"><?= $record['amount'];?></td>
                        <td class="ceil"><?= $record['net_balance'];?></td>
                        <td class="ceil"><?= $record['created_by'];?></td>
                        <td class="ceil"><?= $record['verify_by'];?></td>
                        <td class="ceil"><?= $record['comments'];?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <div class="page_break"></div>
    <?php endforeach; ?>
</div>