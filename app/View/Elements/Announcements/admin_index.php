<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Priority</th>
                    <th style="width : 15%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['start_date']; ?></td>
                    <td><?= $record[$model]['end_date']; ?></td>
                    <td><?= $record[$model]['priority']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_view", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-eye icon green-haze"></i>
                        </a>
                        
                        <?php if ( DateUtility::compare(date("Y-m-d"), $record[$model]['start_date']) < 0): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>

                            <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>

                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                                <i class="fa fa-trash-o icon font-red-sunglo"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                
                <tr class="hidden" id="tr-<?= $record[$model]['id'] ?>" style="background-color: #EEE;">                    
                    <td colspan="2">
                        <?php 
                        $list = array(); 
                        foreach($record['AnnouncementDepartment'] as $arr)
                        {
                            $list[] = $dept_list[$arr['dept_id']];
                        } 
                        ?>
                        <b>Departments</b> : <?= implode(", ", $list); ?>
                    </td>
                    <td colspan="4">
                        <b>Description</b>: <?= $record[$model]['detail'] ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
