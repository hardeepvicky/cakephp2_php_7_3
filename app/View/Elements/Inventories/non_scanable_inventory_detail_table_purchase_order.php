<section class="section-head">
    <h3>Inventory Details</h3>
</section>

<div class="table__structure">
    <div class="table-responsive">
        <table id="inventory" class="table table-striped table-bordered order-column">
        <thead>
            <tr class="center">
                <th style="width: 8%">#</th>
                <th>Sku</th>
                <th>GST (%)</th>
                <th>Rate</th>
                <th>PO Qty</th>
                <th>Invoice Qty</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->request->data['InventoryDetail'] as $i => $inv_detail): ?>
            <tr class="inventory center product-<?= $inv_detail['product_id'] ?>" data-product_id="<?= $inv_detail['product_id'] ?>" data-out_uom_id="<?= $inv_detail['out_uom_id'] ?>" data-inventory_detail_id="<?= $inv_detail["id"] ?>">
                <td><?= ($i + 1) ?></td>
                <td class="product-name"><?= $sku_list[$inv_detail['product_id']] ?></td>
                <td>
                    <span class="inventory-gst_per"><?= $inv_detail['gst_per'];?></span> 
                    <input type="hidden" class="inventory-gst_per" value="<?= $inv_detail['gst_per'];?>"/>
                </td>
                <td>
                    <span class="inventory-rate">&#8360 <?= $inv_detail['uom_rate']; ?></span> 
                    <input type="hidden" class="inventory-rate" value="<?= $inv_detail['rate']; ?>" />                    
                </td>
                <td><?= $inv_detail['invoice_qty']; ?></td>
                <td>
                    <span class="inventory-qty"><?= $inv_detail['uom_qty'] ?></span>
                    <input type="hidden" class="inventory-qty" value="<?= $inv_detail['qty']; ?>" />
                </td>
                <td>
                    <span class="out-uom-name"><?= $uom_list[$inv_detail['out_uom_id']] ?></span>
                </td>
            </tr>                    
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>

<script id="product-template" type="text/x-handlebars-template">
</script>


<script type="text/javascript">
    var party_list = JSON.parse('<?= json_encode($party_list) ?>');
    
    function update_inventory_total_amt ()
    {
        
    }
    
    function update_inventory_detail_amt()
    {
        
    }
    
    $(document).ready(function()
    {
        update_inventory_total_amt();
    });
</script>