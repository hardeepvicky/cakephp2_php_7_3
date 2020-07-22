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
        
    <h2>Assets</h2>
    <?php foreach ( $assets as $location_id => $location): ?>
    <table>
        <thead>
            <tr class="summary_header_footer center">
                <th class="ceil center" style="width : 25%;">Location </th>
                <th class="ceil">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="ceil center"><?= $location["name"] ?></td>    
                <td class="ceil">
                    <table>
                        <thead>
                            <tr class="summary_header_footer center">
                                <th class="ceil" style="width : 10%;">#</th>
                                <th class="ceil">Asset</th>
                                <th class="ceil">Barcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach ( $location["Assets"] as $asset): $i++; ?>
                                <tr class="center">
                                    <td class="ceil"><?= $i ?></td>
                                    <td class="ceil"><?= $asset['name'] ?></td>
                                    <td class="ceil"><?= $asset['barcode'] ?></td>
                                </tr>                
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br/><br/>
    <?php endforeach; ?>
</div>