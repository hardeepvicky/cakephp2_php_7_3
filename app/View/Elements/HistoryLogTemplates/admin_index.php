<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Model</th>
                    <th>Action</th>
                    <th>Notification</th>
                    <th>Log</th>
                    <th style="width : 15%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= isset(StaticArray::$history_template_model_list[$record[$model]['model']]) ? StaticArray::$history_template_model_list[$record[$model]['model']] : "-"; ?></td>
                    <td><?= $record[$model]['action']; ?></td>
                    <td><?= $record[$model]['is_notification'] ? "Yes" : "No"; ?></td>
                    <td><?= $record[$model]['is_log'] ? "Yes" : "No"; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-clone icon green-meadow"></i>
                        </a>
                        
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
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                
                <tr class="hidden" id="tr-<?= $record[$model]['id'] ?>" style="background-color: #EEE;">                    
                    <td colspan="2">
                        <?php 
                        $list = array(); 
                        foreach($record['HistoryLogTemplateNotifyUser'] as $arr)
                        {
                            $list[] = $user_list[$arr['user_id']];
                        } 
                        ?>
                        <b>Users</b> : <?= implode(", ", $list); ?>
                    </td>
                    <td colspan="2">
                        <b>Notification Fields</b>: <?= $record[$model]['notify_fields'] ?>
                    </td>
                    <td colspan="3">
                        <b>Log Fields</b>: <?= $record[$model]['log_fields'] ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
