<style>
    body{
        font-size: 11px;
        margin: 0;
        padding: 0;
    }
    
    .page 
    {
        page-break-inside:avoid;
    }
    
    table{
        width : 100%;
        border-collapse: collapse;
    }
    
    .ceil
    {
        padding : 5px;
        border : 1px solid #000;
    }
    
    .summary_header_footer{
        background-color: #EEE;
    }
</style>
                
<div class="page" style="background-color: #FFF; color: #000;">
    <table style="margin-bottom: 10px;">
        <thead style="border : 1px solid #000;">
            <tr>
                <th colspan="3" style="text-align: center; padding : 8px 10px;">
                    <p style="font-size: 26px; line-height: 14px;">Seven Rocks International</p>
                </th>
            </tr>
        </thead>
    </table>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 8%;">#</th>
                <th class="ceil" style="width : 40%;">Target</th>                    
                <th class="ceil" style="width : 12%;">QR Code</th>
                <th class="ceil">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; foreach ( $records as  $record ): $c++; ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil">
                        Name : <?= $record['target_name'] ?><br/>
                        Operation Type : <?= $record['operation_type_name'] ?><br/>
                        Complete : <?= $record['complete_per'] ?> %<br/>
                        Expire On : <?= $record['target_datetime'] ?> <br/>
                        Expired: <?= $record['expired'] ?>
                    </td>
                    <td class="ceil">
                        <img style="height : 200px; width : auto" src="<?= $record["base64_code"] ?>">
                    </td>
                    <td class="ceil"><?= implode("<br/>", $record['sku_list']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>