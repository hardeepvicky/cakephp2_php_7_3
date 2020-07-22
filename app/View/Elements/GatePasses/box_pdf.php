<?= $this->element("pdf_css") ?>

<div class="page" style="background-color: #FFF; color: #000;">
    <div style="border-bottom: 1px solid #000;  margin-bottom: 20px;">
        <div style="text-align: center; ">
            <p style="font-size: 22px;">Seven Rocks International</p>
        </div>
        <div>
            <div style="float:left; width : 60%">
                <p><b>Carrier : </b> <?= $record["Carier"]["name"] ?></p>
                <p><b>Picker Name : </b> <?= $record["GatePass"]["picker_name"] ?></p>
                <p><b>Picker Mobile: </b> <?= $record["GatePass"]["picker_mobile"] ?></p>
                <p><b>Is Returnable: </b> <?= $record["GatePass"]["is_returnable"] ? "Yes" : "No" ?></p>
                <p><b>Comments: </b> <?= $record["GatePass"]["comments"] ?></p>
            </div>
            <div style="float:right; width : 40%; text-align: right">
                <p><b>Gate Pass : </b> <?= $record["GatePass"]["gate_pass_no"] ?></p>
                <img style="height : 120px; width : auto" src="<?= $record["GatePass"]["gate_pass_no_base64"] ?>">
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
    
    <h2>Summary</h2>    
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 10%;"># </th>
                <th class="ceil">Location</th>
                <th class="ceil">Box</th>
                <th class="ceil">Weight(K.g.)</th>
                <th class="ceil">Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $b = 0; 
            foreach ( $boxes as $location_id => $location): 
                foreach ( $location["Box"] as $box): 
                $b++; 
            ?>
            <tr class="center">
                <td class="ceil"><?= $b ?></td>
                <td class="ceil"><?= $location["name"] ?></td>
                <td class="ceil"><?= $box["box_no"] ?></td>
                <td class="ceil"><?= $box["weight"] ?></td>
                <td class="ceil"><?= $box["qty"] ?></td>
            </tr>
            <?php endforeach; endforeach; ?>
        </tbody>
    </table>
        
    <h2>Detail</h2>
    <?php foreach ( $boxes as $location_id => $location): ?>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil" style="width : 20%;">Box </th>
                <th class="ceil">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($location["Box"] as $box): ?>
            <tr>
                <td class="ceil center"><?= $box["box_no"] ?></td>    
                <td class="ceil">
                    <?php if (isset($box["products"])) : ?>
                        <table>
                            <thead>
                                <tr class="summary_header_footer center">
                                    <th class="ceil" style="width : 10%;">#</th>
                                    <th class="ceil">Sku</th>
                                    <th class="ceil">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $box["products"] as $i => $product): ?>
                                    <tr class="center">
                                        <td class="ceil"><?= $i + 1 ?></td>
                                        <td class="ceil"><?= $product['sku'] ?></td>
                                        <td class="ceil"><?= $product['qty'] ?></td>
                                    </tr>                
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    
                    <?php if (isset($box["items"])) : ?>
                        <table>
                            <thead>
                                <tr class="summary_header_footer center">
                                    <th class="ceil" style="width : 10%;">#</th>
                                    <th class="ceil">Item</th>
                                    <th class="ceil">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $box["items"] as $i => $item): ?>
                                    <tr class="center">
                                        <td class="ceil"><?= $i + 1 ?></td>
                                        <td class="ceil"><?= $item['name'] ?></td>
                                        <td class="ceil"><?= $item['qty'] ?></td>
                                    </tr>                
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br/><br/>
    <?php endforeach; ?>
</div>