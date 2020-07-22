<?= $this->element("pdf_css") ?>
                
<div class="page" style="background-color: #FFF; color: #000;">
    <div style="border-bottom: 1px solid #000;  margin-bottom: 20px;">
        <div style="text-align: center; ">
            <p style="font-size: 22px;">Seven Rocks International</p>
        </div>
        <div>
            <div style="float:left; width : 60%">
                <p><b>Product Title : </b> <?= $record["product"]["Product"]["name"] ?></p>
                <p><b>Sku : </b> <?= $record["product"]["Product"]["sku"] ?></p>
                <p><b>Category : </b> <?= $record["product"]["Category"]["name"] ?></p>
                <p><b>Brand : </b> <?=  $record["brand"] ?></p>
            </div>
            <div style="float:right; width : 40%; text-align: right">
                <img style="height : 120px; width : auto" src="<?= $record["product"]["image"] ?>">
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
                <th class="ceil" style="width : 15%;">Price</th>
                <th class="ceil" style="width : 15%;">Qty</th>                
                <th class="ceil" style="width : 15%;">Costing</th>
                <th class="ceil" style="width : 15%;">Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; $ideal_amt = 0; foreach ( $record["ideal_consmption"] as $ideal_consmption ): $c++; $ideal_amt += $ideal_consmption['amt'] ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $ideal_consmption['sku'] ?></td>
                    <td class="ceil"><?= $ideal_consmption['price'] ?></td>
                    <td class="ceil"><?= $ideal_consmption['qty'] ?></td>
                    <td class="ceil"><?= $ideal_consmption['amt'] ?></td>
                    <td class="ceil"><?= $ideal_consmption['uom'] ?></td>
                </tr>                
            <?php endforeach; ?>
            <tr class="center"> 
                <td class="ceil" colspan="4"></td>
                <td class="ceil"><?= round($ideal_amt, 2) ?></td>
            </tr>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
    
    <h2>Operation Types</h2>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 20%;">Operation Type</th>                    
                <th class="ceil" style="width : 15%;">Total Rate</th>
                <th class="ceil" style="width : 15%;">Costing</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; $operation_amt = 0;  foreach ( $record["operation_types"] as $operation_type ):  $c++; $operation_amt += $operation_type['amt'] ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $operation_type['operation_type'] ?></td>
                    <td class="ceil"><?= $operation_type['rate'] ?></td>
                    <td class="ceil"><?= $operation_type['amt'] ?></td>
                </tr>                
            <?php endforeach; ?>
            <tr class="center">
                <td class="ceil" colspan="3"></td>
                <td class="ceil"><?= round($operation_amt, 2) ?></td>
            </tr>
        </tbody>
    </table>
    
    <h2>Variable Operation Types</h2>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 20%;">Operation Type</th>                    
                <th class="ceil" style="width : 15%;">Rate</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; $variable_operation_amt = 0;  foreach ( $record["variable_operation_types"] as $operation_type ):  $c++; $variable_operation_amt += $operation_type['rate'] ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $operation_type['operation_type'] ?></td>
                    <td class="ceil"><?= $operation_type['rate'] ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="center">
                <td class="ceil" colspan="2"></td>
                <td class="ceil"><?= round($variable_operation_amt, 2) ?></td>
            </tr>
        </tbody>
    </table>
    
    <h4>Consumption Variable Cost : <?= round($record["variable_cost"], 2) ?></h4>
    <?php
    $total = $ideal_amt + $operation_amt + $variable_operation_amt + $record["variable_cost"];
    ?>
    <h4>Total Cost : <?= round($total, 2) ?></h4>
    <h4>Overhead : <?= round($record["overhead"] * $total / 100, 2) ?></h4>
    
    <div class="page_break"></div>
    <h2>Annexure of Operations</h2>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;">Sr. No.</th>
                <th class="ceil" style="width : 20%;">Operation Type</th>                    
                <th class="ceil" colspan="5">Product Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php $c = 0; $amt = 0;  foreach ( $record["product_opreations"] as $ot ):  $c++; ?>
            <?php if (count($ot["operations"]) > 0): ?>
                <tr class="center">
                    <td class="ceil"><?= $c ?></td>
                    <td class="ceil"><?= $ot['name'] ?></td>
                    <th class="ceil">Operation Name</th>
                    <th class="ceil">Time</th>
                    <th class="ceil">Rate</th>
                    <th class="ceil">Occurance</th>
                    <th class="ceil">Amount</th>
                </tr>                
                <?php foreach ( $ot["operations"] as $operation ):  $amt += $operation["amt"] ?>
                <tr class="center">
                    <td></td>
                    <td></td>
                    <td class="ceil"><?= $operation['name'] ?></td>
                    <td class="ceil"><?= $operation['time_in_mintues'] ?></td>
                    <td class="ceil"><?= $operation['occurance'] ?></td>
                    <td class="ceil"><?= $operation['rate'] ?></td>
                    <td class="ceil"><?= $operation['amt'] ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php endforeach; ?>
            <tr class="center">
                <td class="ceil" colspan="6"></td>
                <td class="ceil"><?=round($amt, 2) ?></td>
            </tr>
        </tbody>
        
    </table>
</div>