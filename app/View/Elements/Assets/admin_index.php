<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 7%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Asset')); ?> </th>
                    <th> Code </th>
                    <th> Brand </th>
                    <th> Value (&#8360)</th>
                    <th> <?= $this->Paginator->sort('date_of_bill', __('Date Of Bill')); ?> </th>
                    <th>Location</th>
                    <th style="width : 20%;" colspan="3"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['barcode']; ?></td>
                    <td><?= $record[$model]['brand']; ?></td>
                    <td><?= $record[$model]['value']; ?></td>
                    <td><?= $record[$model]['date_of_bill']; ?></td>
                    <td><?= if_exist($location_list, $record[$model]['location_id']) ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_assign", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" target="_blank">Assign To</a>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "ajaxIndexDetail", "admin" => false, $record[$model]['id'])); ?>
                        <a href="javascript:void(0);" class="css-toggler ajax-loader"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden"
                           data-loader-target="tr#record-<?= $record[$model]['id'] ?> .detail" data-loader-href="<?= $url; ?>"
                           >Details</a>
                    </td>                    
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden" style="background-color: #EEE">
                    <td></td>
                    <td class="detail" colspan="7">
                        
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
