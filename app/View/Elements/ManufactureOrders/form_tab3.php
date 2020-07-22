<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
        <table class="table table-striped table-bordered order-column">
            <tr>
                <td>Request Qty</td>
                <td>Tentative Qty</td>
            </tr>
            <tr>
                <td><?= $this->request->data[$model]["qty"] ?></td>
                <td><?= $total_qty ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <?php if ($this->request->data[$model]["is_distribute"]): ?>
            <span class="label label-info"> Allowed For Pick </span>
        <?php else :
                $url = $this->Html->url(array("action" => "ajaxManufactureOrderDistribute", $this->request->data[$model]["id"], "admin" => false));
            ?>
            <a href="<?= $url ?>" class="manufacture-order-distribute">Allow For Pick Now</a>
        <?php endif; ?>
    </div>
</div>

<h3 class="section">Sku Wise Details</h3>
<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th> # </th>
                    <th data-search="1" data-sort="alpha"> Product </th>
                    <th data-search="1" data-sort="alpha"> Brand </th>
                    <th data-search="1" data-sort="numeric"> Qty </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0;
                $product_not_found_in_ideal_consmption = array();
                
                    foreach ($product_brand_records as $record): 
                        $i++; 
                    
                        if (!in_array($record["product"], $list_of_product_have_ideal_consumption))
                        {
                            $product_not_found_in_ideal_consmption[$record["product"]] = $record["product"];
                        }
                ?>
                <tr class="odd gradeX center">
                    <td><?= $i ?></td>
                    <td><?= $record["product"] ?></td>
                    <td><?= $record["brand"] ?></td>
                    <td><?= $record["qty"] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<h3 class="section">Ideal Consumption Forecasting</h3>
<?php if (!empty($product_not_found_in_ideal_consmption)) : ?>
<label class="label label-danger">Some Product have no Ideal Consumption.</label> 
<a href="javascript:void(0)" class="css-toggler" data-toggler-target="#product_not_found_in_ideal_consmption" data-toggler-class="hidden">Details</a>
<div id="product_not_found_in_ideal_consmption" class="hidden bg-info" style="margin-top : 10px;">    
    <ol>
    <?php foreach($product_not_found_in_ideal_consmption as $sku): ?>
        <li><?= $sku ?></li>
    <?php endforeach; ?>
    </ol>
</div>
<?php endif; ?>
<span class="btn blue js-export-csv" data-js-export-csv-table="table#ideal-consumption" data-js-export-csv-filename="ideal-consumption-of-manufacture-order-<?= $this->request->data[$model]["id"] ?>">Export CSV</span>
<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable" id="ideal-consumption">
            <thead>
                <tr>
                    <th> # </th>
                    <th data-csv="0"> Actions </th>
                    <th data-search="1" data-sort="alpha"> Product </th>
                    <th data-search="1"> Consume Qty </th>
                    <th data-search="1"> Unit </th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach ($product_ideal_consumptions as $record): $i++; ?>
                <tr class="odd gradeX center">
                    <td><?= $i ?></td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#ideal-consumption #tr-<?= $i ?>" data-toggler-class="hidden">Details</a>
                    </td>
                    <td><?= $record["product"] ?></td>
                    <td><?= round($record["qty"], ROUND_DIGIT) ?></td>
                    <td><?= $record["unit"] ?></td>
                </tr>
                 <tr class="hidden csv-export-not-include" id="tr-<?= $i ?>">
                     <td></td>
                     <td colspan="3" style="background-color: #EEE">
                         <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Product </th>
                                    <th> Consumed By </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 0; foreach ($record["details"] as $detail): $a++; ?>
                                <tr class="odd gradeX center">
                                    <td><?= $a ?></td>
                                    <td><?= $detail["product"] ?></td>
                                    <td><?= round($detail["qty"], ROUND_DIGIT) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                         </table>
                     </td>
                 </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<h3 class="section">Cut & Batch Bundle Qty</h3>
<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th> Size </th>
                    <th> Cut Qty </th>
                    <th> Batch Qty </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_cut = $total_batch = 0; 
                    foreach ($cut_batch_qty_records as $size => $record):
                        $total_cut += $record["cut"];
                        $total_batch += $record["batch"];
                ?>
                <tr class="odd gradeX center">
                    <td><?= $size ?></td>
                    <td><?= $record["cut"] ?></td>
                    <td><?= $record["batch"] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="center">
                    <td></td>
                    <td><?= $total_cut ?></td>
                    <td><?= $total_batch ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<h3 class="section">Bundles</h3>
<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th> # </th>
                    <th> Batch </th>
                    <th> Bundle </th>
                    <th> Size </th>
                    <th> Color </th>
                    <th> qty </th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = $total_qty = 0; 
                    foreach ($batch_bundles as $batch_id => $records): 
                        foreach ($records as $k => $record): 
                        $i++;
                        $total_qty += $record["qty"];
                ?>
                    <tr class="odd gradeX center">
                        <td><?= $i; ?></td>
                        <td><?= $record["batch"] ?></td>
                        <td><?= ($k + 1) ?></td>
                        <td><?= $record["size"] ?></td>
                        <td><?= $record["color"] ?></td>
                        <td><?= $record["qty"] ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="center">
                    <td colspan="5"></td>
                    <td><?= $total_qty ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12"></label>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <span class="help-block">After Complete You can not edit Manufacture Order, All Bundle, Serial Codes, Manufacture nodes will generated. Please be sure all values are correct</span>
        </div>
    </div>
</div>
<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <?php if ($this->request->data[$model]["is_complete_noti_sent"]): ?>
            <?= $this->Form->hidden('is_completed', array('value' => 1)); ?>
            <?= $this->Form->hidden('completed_by', array('value' => $auth_user["id"])); ?>
            <?= $this->Form->hidden('complete_datetime', array('value' => date(DateUtility::DATETIME_FORMAT))); ?>
            <button type="submit" href="javascript:;" class="btn blue" style="max-width: 150px;">Complete Now</button>
            <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>"  style="max-width: 150px;">Back to Summary</a>
        <?php endif; ?>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function()
    {
        var submit_confirm = false;
        $("form").submit(function()
        {
            if (!submit_confirm)
            {
                bootbox.confirm({
                    message: "Are you sure to submit. Once you submit you can't edit",
                    buttons: {
                        confirm: {
                            label: 'Yes',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-danger'
                        }
                    },
                    callback: function (result) 
                    {
                        if (result)
                        {
                            submit_confirm = true;
                            $("form").trigger("submit");
                        }
                    }
                });
            }
            else
            {
                var data = $(this).serializeArray();
                console.log(data);

                var href= $(this).attr("action");
                
                Loader.onShown = function()
                {
                    $(".tf-loader-container .help-block").html('Generating Bundle, Serial Codes, Manufacture nodes. Please Wait... It Takes Some Time');
                }
                
                $.post(href, data, function(data)
                {
                    if (data == "1")
                    {
                        window.location.href = '<?= $this->Html->url(array("action" => "admin_index")) ?>';
                    }
                    else
                    {
                        bootbox.alert(data);
                    }
                });
                
            }
            
            return false;
        });
        
        $("a.manufacture-order-distribute").click(function()
        {
            var _td = $(this).parent();
            var href = $(this).attr("href");

            bootbox.confirm({
                 message: "Are you sure. This step can not be undo",
                 buttons: {
                     confirm: {
                         label: 'Yes',
                         className: 'btn-success'
                     },
                     cancel: {
                         label: 'No',
                         className: 'btn-danger'
                     }
                 },
                 callback: function (result) 
                 {
                     if (result)
                     {
                         $.get(href, function(response)
                         {
                            try
                            {
                                response = JSON.parse(response);
                            }
                            catch(e)
                            {
                                bootbox.alert(response);
                                return;
                            }

                            if (response["status"] == "1")
                            {
                                _td.html('<span class="label label-info"> Allowed For Pick </span>');
                            }
                            else
                            {
                                bootbox.alert(response["msg"]);
                            }
                         });
                     }
                 }
             });

            return false;
        });
    });
</script>
