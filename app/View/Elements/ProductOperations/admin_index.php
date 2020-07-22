<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="report">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 15%;">Operation Type</th>
                    <th>Product</th>                    
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('time_in_mintues', __('Time (in Mintues)')); ?> </th>
                    <th style="width : 10%;"> Occurance </th>
                    <th style="width : 10%;"> Current Rate </th>
                    <th style="width : 10%;"> Total Rate </th>
                    <th style="width : 18%;" data-csv="0"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php $total_rate = 0; foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $operation_type_list[$record[$model]['operation_type_id']]; ?></td>
                    <td><?= $product_list[$record[$model]['product_id']]; ?></td>
                    <td><?= $record[$model]['type'] == 1 ? $record['BasicOperation']['name'] : $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['type'] == 1 ? $record['BasicOperation']['time_in_mintues'] : $record[$model]['time_in_mintues']; ?></td>
                    <td><?= $record[$model]['occurance'] ?></td>
                    <td>
                        <?php
                        $rate = 0;
                        if ($record[$model]['type'] == 1)
                        {
                            $rate = isset($record['BasicOperation']['BasicOperationRate'][0]) ? $record['BasicOperation']['BasicOperationRate'][0]['rate'] : 0;
                            echo $rate ? $rate : "-";
                        }
                        else
                        {
                            $rate = isset($record['ProductOperationRate'][0]) ? $record['ProductOperationRate'][0]['rate'] : 0;
                            echo $rate ? $rate : "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                            $total_rate += $record[$model]['occurance'] * $rate;
                            echo $record[$model]['occurance'] * $rate;
                        ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['product_id'])); ?>
                        <a href="<?= $url; ?>" title="Copy" class="summary-link">
                            <i class="fa fa-clone icon font-green-meadow"></i>
                        </a>
                        
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['product_id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr class="hidden csv-export-not-include" id="tr-<?= $record[$model]['id'] ?>" style="background-color: #EEE;">                    
                    <td></td>
                    <td colspan="2">
                        Comments : <?= $record[$model]['type'] == 1 ? $record['BasicOperation']['comments'] : $record[$model]['comments']; ?>
                        <h3 class="section">                            
                            Operation Rates
                            <?php $controller = $record[$model]['type'] == 1 ? "BasicOperations" : "ProductOperations" ?>
                            <a class="btn btn-default" target='_blank' href="<?= $this->Html->url(array("controller" => $controller, "action" => "admin_add_rate", $record[$model]['id'])); ?>">
                                Add Rate
                            </a>
                        </h3>
                        
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if ($record[$model]['type'] == 1) : ?>
                                <?php foreach ( $record["BasicOperation"]['BasicOperationRate'] as $price): ?>
                                    <tr>
                                        <td class="text-center"><?= DateUtility::getDate($price['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                                        <td class="text-center">&#8360 <?= $price['rate'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php foreach ( $record['ProductOperationRate'] as $price): ?>
                                    <tr>
                                        <td class="text-center"><?= DateUtility::getDate($price['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                                        <td class="text-center">&#8360 <?= $price['rate'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
<label><b>Total Rate :</b> <?= $total_rate ?></label>