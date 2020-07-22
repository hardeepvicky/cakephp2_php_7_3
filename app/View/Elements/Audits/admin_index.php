<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Audit')); ?> </th>
                    <th> <?= $this->Paginator->sort('is_completed', __('Completed')); ?> </th>
                    <th> <?= $this->Paginator->sort('created', __('Created On')); ?> </th>
                    <th> Created By </th>
                    <th style="width : 18%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td>
                        <?php 
                        if ($record[$model]['is_completed'])
                        {
                            ?>
                                <span class="label label-success">Completed</span>
                            <?php
                        }
                        else
                        {
                            $url = $this->Html->url(array("action" => "admin_complete", $record[$model]['id']));
                            ?>                                
                                <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Complete ?">
                                    Complete Now
                                </a>
                            <?php
                        }
                        ?>
                    </td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td><?= if_exist($user_list, $record[$model]['created_by']); ?></td>
                    <td>
                        
                        
                        <?php if (!$record[$model]['is_completed']): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>

                            <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                                <i class="fa fa-trash-o icon font-red-sunglo"></i>
                            </a>             
                        
                            <?php $url = $this->Html->url(array("action" => "admin_scan", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Scan" class="btn btn-default btn-sm">
                                Scan
                            </a>
                        <?php else : ?>
                            <a class="btn btn-default btn-sm" href="<?= $this->Html->url(["action" => "admin_csv", $record[$model]['id']]) ?>">Export Scan Serial codes</a>
                            <a class="btn btn-default btn-sm" href="/<?= $record[$model]['csv_file'] ?>" download>Download Audit File</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
