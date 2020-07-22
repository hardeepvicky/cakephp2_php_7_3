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
                            <th data-search="1">Asset</th>
                            <th style="width : 10%">Return</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 0; 
                        foreach($records as $l_id => $location): 
                            foreach($location["Assets"] as $gpa_id => $asset):
                            $i++; 
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $location["name"] ?></td>
                            <td><?= $asset["name"] ?> (<?= $asset["barcode"] ?>)</td>
                            <td>
                                <?php if ($asset["GPA"]["is_return"]): ?>
                                    <span class="label label-success">Received</span>
                                <?php else : ?>
                                <label class="mt-checkbox mt-checkbox-outline">
                                    <?= $this->Form->input("GPL." . $location["GPL"]["id"] . ".GPA." . $asset["GPA"]["id"], [
                                        "type" => "checkbox",
                                        "class" => ""
                                    ]) ?>
                                    Receive
                                    <span></span>
                                </label>
                                <?php endif; ?>
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
