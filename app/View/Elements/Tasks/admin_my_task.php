<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Assigner</th>
                    <th> <?= $this->Paginator->sort('title', __('Title')); ?> </th>
                    <th> <?= $this->Paginator->sort('start_date', __('Start Date')); ?> </th>
                    <th> <?= $this->Paginator->sort('end_date', __('End Date')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_completed', __('Completed')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_verified', __('Verified')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_expired', __('Expired')); ?> </th>
                    <th> <?= $this->Paginator->sort('complete_date', __('	Complete Date')); ?> </th>                    
                    <th> <?= $this->Paginator->sort('feedback', __('Feedback')); ?> </th>
                    <th style="width : 25%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record["AssignerUser"]['name']; ?></td>
                    <td><?= $record[$model]['title']; ?></td>
                    <td><?= $record[$model]['start_date']; ?></td>
                    <td><?= $record[$model]['end_date']; ?></td>
                    <td>
                        <?php if ($record[$model]['is_completed']): ?>
                            <span class="label label-info"> Completed </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($record[$model]['is_verified']): ?>
                            <span class="label label-warning"> Verified </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($record[$model]['is_expired']): ?>
                            <span class="label label-danger"> Expired </span>
                        <?php endif; ?>
                    </td>
                    <td><?= $record[$model]['is_completed'] ? $record[$model]['complete_date'] : ""; ?></td>
                    <td><?= $record[$model]['is_verified'] ? $record[$model]['feedback'] : ""; ?></td>
                    <td>
                        <?php if (!$record[$model]['is_completed'] && !$record[$model]['is_expired']):?>
                            <?php if ($record[$model]['not_complete_child_count'] == 0): ?>                                
                                <?php $url = $this->Html->url(array("action" => "admin_task_complete", $record[$model]['id'])); ?>
                                <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                    Complete Now
                                </a>
                            <?php else : ?>
                                <a href="#" title="Edit" class="summary-link not-complete-task">
                                    Complete Now
                                </a> 
                                <?= $this->Html->link("Sub Tasks", array("parent_id" => $record[$model]['id'])) ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_view", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="View" class="summary-link">
                            <i class="fa fa-eye icon font-green-meadow"></i>
                        </a>
                        
                        <?php if (!$record[$model]['is_completed'] && !$record[$model]['is_expired']):?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
         $(".not-complete-task").click(function()
         {
             bootbox.alert("Please complete the sub task firstly.");
             return false;
         })
    })
</script>