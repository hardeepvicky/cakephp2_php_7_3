<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('title', __('Title')); ?> </th>
                    <th> Department </th>
                    <th> Member </th>
                    <th> <?= $this->Paginator->sort('start_date', __('Start Date')); ?> </th>
                    <th> <?= $this->Paginator->sort('end_date', __('End Date')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_completed', __('Completed')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_verified', __('Verified')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_expired', __('Expired')); ?> </th>
                    <th> <?= $this->Paginator->sort('complete_date', __('Complete Date')); ?> </th>
                    <th> <?= $this->Paginator->sort('feedback', __('Feedback')); ?> </th>
                    <th style="width : 20%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['title']; ?></td>
                    <td><?= $dept_list[$record[$model]['dept_id']]; ?></td>
                    <td><?= $user_list[$record[$model]['assignee_user_id']]; ?></td>
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
                        <?php 
                            if ($record[$model]['child_count'] > 0)
                            {
                                echo $this->Html->link("Sub Tasks", array("parent_id" => $record[$model]['id']));
                            }
                        ?>
                        
                        <?php $url = $this->Html->url(array("action" => "admin_view", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="View" class="summary-link">
                            <i class="fa fa-eye icon font-green-meadow"></i>
                        </a>
                        
                        <?php if (!$record[$model]['is_completed']): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>

                            <?php 
                            if ($record[$model]['child_count'] == 0):
                                $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); 
                            ?>
                                <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                                    <i class="fa fa-trash-o icon font-red-sunglo"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
