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
        padding : 8px 10px;
        border : 1px solid #000;
    }
    
    .summary_header_footer{
        background-color: #EEE;
    }
</style>
                
<div class="page" style="background-color: #FFF; color: #000;">
    <table>
        <thead style="border : 1px solid #000;">
            <tr>
                <th colspan="3" style="text-align: center; padding : 8px 10px;">
                    <p style="font-size: 26px; line-height: 14px;">Seven Rocks International</p>
                </th>
            </tr>
            <tr>
                <th><b>Party :</b> <?= $this->request->data["InventoryPickList"]["party_name"] ?></th>
                <th><b>Location :</b> <?= $this->request->data["InventoryPickList"]["location_name"] ?></th>
                <th><b>Pick List Name :</b> <?= $this->request->data["InventoryPickList"]["name"] ?></th>
            </tr>
            <tr>
                <th><b>Pick List Id :</b> <?= $this->request->data["InventoryPickList"]["id"] ?></th>
                <th><b>Created :</b> <?= $this->request->data["InventoryPickList"]["created"] ?></th>
                <th><b>Created By :</b> <?= $this->request->data["InventoryPickList"]["created_by"] ?></th>
            </tr>
        </thead>
    </table>
    <table style="width : 40%; margin: 20px 0;">
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil">Product Group</th>                    
                <th class="ceil"  style="width : 20%;">Qty</th>                    
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; foreach ( $pg_list as $pg_name => $qty ): $c++; ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $pg_name?></td>
                    <td class="ceil"><?= $qty ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 8%;">Sr. No.</th>
                <th class="ceil" style="width : 15%;">Sku</th>                    
                <th class="ceil">Old Sku</th>                    
                <th class="ceil" style="width : 20%;">Sub Location</th>
                <th class="ceil" style="width : 10%;">Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; foreach ( $records as  $record ): $c++; ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $record['sku'] ?></td>
                    <td class="ceil"><?= implode(", ", $record['old_sku_list']) ?></td>
                    <td class="ceil summary_header_footer"><b>Total<b/></td>
                    <td class="ceil summary_header_footer"><?= $record['qty'] ?></td>
                </tr>
                <?php foreach ( $record["sub_location_list"] as $sub_location):?>
                <tr class="center">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="ceil"><?= $sub_location["name"] ?></td>
                    <td class="ceil"><?= $sub_location["qty"] ?></td>
                </tr>
                <?php endforeach; ?>
                <?php foreach ( $record["comments"] as $comment):?>
                <tr class="center">
                    <td></td>
                    <td></td>
                    <td class="ceil" style="text-align: right">Comment</td>
                    <td class="ceil" colspan="2"> <?= $comment ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>