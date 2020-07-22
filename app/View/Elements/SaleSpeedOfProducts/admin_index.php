<div class="form__structure">
    <?php
        echo $this->Form->create($model, array(
            'type' => 'file',
            "class" => "form-horizontal form-row-seperated",
            'inputDefaults' => array(
                'label' => false, 'div' => false, 'div' => false, "escape" => false,
                "class" => "form-control", "type" => "text"
            )
        ));
    ?>
    <div class="form-body">
        <div class="table__structure">
            <?= $this->element("pagination", array("with_info" => true)) ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered order-column" id="sample_1_2">
                    <thead>
                        <tr>
                            <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                            <th> Party </th>
                            <th> Product </th>
                            <th> Sale Speed </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0; 
                            foreach ($records as $record): 
                                $i++;
                                $record = $record[$model];
                                $party_id = $record["party_id"];
                                $sku_id = $record["product_id"];
                        ?>
                        <tr class="odd gradeX center">
                            <td><?= $i; ?></td>
                            <td><?= $record["party_name"]; ?></td>
                            <td><?= $record["sku"]; ?></td>
                            <td>
                                <?php 
                                    reset($sale_of_speed_list);
                                    $first_key = key($sale_of_speed_list);
                                    $value = isset($record["sale_speed_id"]) ? $record["sale_speed_id"] : $default_sale_speed_type_id; 
                                ?>
                                <?= $this->Form->input("$party_id.$sku_id.sale_speed_id", array(
                                    "type" => "select",
                                    "options" => $sale_of_speed_list,
                                    "empty" => DROPDOWN_EMPTY_VALUE,
                                    "value" => $value,
                                    "required"
                                )); 
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?= $this->element("pagination") ?>
        </div>
    </div>
    <div class="action-buttons">
        <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
            <button type="submit" href="javascript:;" class="btn blue">Submit</button>
            <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
