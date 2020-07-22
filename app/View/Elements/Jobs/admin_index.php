<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Job Title</th>
                    <th><?= $this->Paginator->sort('is_active', __('Status')); ?></th>
                    <th><?= $this->Paginator->sort('display_order', __('Display Order')); ?></th>
                    <th>Applications Received</th>
                    <th style="width : 20%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_toggleActive", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_active" data-value="<?= (int)$record[$model]['is_active'] ?>">
                            <i class="fa <?= $record[$model]['is_active'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        </a>
                    </td>
                    <td><?= $record[$model]['display_order']; ?></td>
                    <td>
                        <?php if (count($record["JobApplication"]) > 0): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_job_applications", "job_id" => $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" class="summary-link">
                                <?= count($record["JobApplication"]); ?> Applications
                            </a>
                        <?php else: ?>
                            <?= count($record["JobApplication"]); ?>
                        <?php endif; ?>
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
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
