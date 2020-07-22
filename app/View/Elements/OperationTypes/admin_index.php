<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th>Can Affect Ledger Transaction While Manufacture</th>
                    <th>Optional</th>
                    <th>Manufacture Target Mandatory</th>
                    <th>Manufacture Target Max Qty</th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $dept_list[$record[$model]['dept_id']]; ?></td>
                    <td><?= $record["Designation"]['name']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td>
                        <?php if ($record[$model]['can_affect_legder_account_in_manufacture']): ?>
                            <span class="label label-info"> Yes </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($record[$model]['is_optional']): ?>
                            <span class="label label-info"> Yes </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($record[$model]['is_manufacture_target_required']): ?>
                            <span class="label label-info"> Yes </span>
                        <?php endif; ?>
                    </td>
                    <td><?= $record[$model]['manufacture_target_max_qty']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>

                        <?php if ($url) : ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>
                        <?php endif; ?>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>

                        <?php if ($url) : ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
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