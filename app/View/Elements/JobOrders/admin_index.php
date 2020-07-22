<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 6%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 15%;"> Location </th>
                    <th style="width : 10%;"> Job Order No </th>
                    <th> Job Type </th>
                    <th> Product Group </th>
                    <th> Batch </th>
                    <th> Qty </th>
                    <th> Rate Per Unit </th>
                    <th> GST(%) </th>
                    <th> Total Value </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= if_exist($location_list, $record[$model]['location_id']); ?></td>
                    <td><?= $record[$model]['job_order_no']; ?></td>
                    <td><?= if_exist($job_type_list, $record[$model]['job_type_id']); ?></td>
                    <td><?= if_exist($product_group_list, $record[$model]['product_group_id']); ?></td>
                    <td><?= if_exist($batch_list, $record[$model]['batch_id']); ?></td>
                    <td><?= $record[$model]['qty']; ?></td>
                    <td><?= $record[$model]['rate_per_unit']; ?></td>
                    <td><?= $record[$model]['gst_per']; ?></td>
                    <td><?= $record[$model]['total_amt_gst']; ?></td>
                    <td>
                        <?php if ( $record["GatePassJobOrder"]["id"] ) : ?>
                            <?php $url = $this->Html->url(array("action" => "admin_add_problems", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link">
                                Add Problems
                            </a>
                            <br/><br/>
                            <?php $url = $this->Html->url(array("action" => "admin_payments", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link">
                                Payments
                            </a>
                            <br/><br/>
                        <?php else : ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>

                            <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                                <i class="fa fa-trash-o icon font-red-sunglo"></i>
                            </a>
                            <br/><br/>
                        <?php endif; ?>
                        
                        <a href="javascript:void(0);" class="css-toggler"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">
                            Details
                        </a>
                    </td>
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden" style="background-color: #EEE">
                    <td></td>
                    <td colspan="3">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th style="width : 10%;">#</th>
                                    <th> Size </th>
                                    <th> Qty </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($record["JobOrderSize"] as $arr): $i++; ?>
                                <tr class="odd gradeX center">
                                    <td><?= $i ?></td>
                                    <td><?= if_exist($size_type_list, $arr["size_type_id"]) ?></td>
                                    <td><?= $arr["qty"] ?></td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                    </td>
                    <td colspan="6">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th style="width : 10%;">#</th>
                                    <th> Color </th>
                                    <th> Qty </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($record["JobOrderColor"] as $arr): $i++; ?>
                                <tr class="odd gradeX center">
                                    <td><?= $i ?></td>
                                    <td><?= if_exist($color_type_list, $arr["color_type_id"]) ?></td>
                                    <td><?= $arr["qty"] ?></td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                        
                        <h3>Problems</h3>
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>
                                    <th style="width : 10%;">#</th>
                                    <th> Item </th>
                                    <th> Problem </th>
                                    <th> Qty </th>
                                    <th> Deduct Amount </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; foreach ($record["JobOrderProblem"] as $arr): $i++; ?>
                                <tr class="odd gradeX center">
                                    <td><?= $i ?></td>
                                    <td><?= if_exist($item_list, $arr["item_id"]) ?></td>
                                    <td><?= if_exist($job_problem_type_list, $arr["job_problem_type_id"]) ?></td>
                                    <td><?= $arr["qty"] ?></td>
                                    <td><?= $arr["deduct_amount"] ?></td>
                                </tr>
                                <?php endforeach; ?>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
