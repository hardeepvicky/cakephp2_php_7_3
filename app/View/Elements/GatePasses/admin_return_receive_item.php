<div class="form__structure">
    <?php
        echo $this->Form->create($model, array(
            'type' => 'file',
            "class" => "form-horizontal form-row-seperated validate",
            'inputDefaults' => array(
                'label' => false, 'div' => false, 'div' => false, "escape" => false,
                "class" => "form-control invalid-sql-char ", "type" => "text"
            )
        ));
    ?>
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered order-column sr-databtable">
                    <thead>
                        <tr>
                            <th  data-search-clear="1" style="width : 6%" class="text-center">#</th>
                            <th data-search="1">Location</th>
                            <th data-search="1">Item</th>
                            <th style="width : 10%">Sent Qty</th>
                            <th style="width : 10%">Return Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0; 
                        foreach($records as $location_id => $location): 
                            foreach($location["Items"] as $item_id => $item):
                            $i++; 
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $location["name"] ?></td>
                            <td><?= $item["name"] ?></td>
                            <td><?= $item["qty"] ?></td>
                            <td>
                                <?= $this->Form->input('GPL.' . $location["GPL"]["id"] . ".Item.$item_id.return_qty" , [
                                    "value" => $item["return_qty"],
                                    'class' => "form-control validate-float validate-less-than-equal",
                                    "data-less-than-equal-from" => $item["qty"], 
                                    "data-less-than-equal-msg" => "Reutrn qty can not be more than sent qty", 
                                ]); ?>
                            </td>
                        </tr>
                        <?php endforeach; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
            <button type="submit" href="javascript:;" class="btn blue">Submit</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
