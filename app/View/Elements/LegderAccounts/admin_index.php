<?php if ($records): ?>
<div class="row">
    <div class="col-md-6">
        <a class="btn blue" href="<?= $this->Html->url(array_merge(array("action" => "admin_csv"), $search)); ?>">Export CSV</a>
    </div>
    <div class="col-md-6 text-right">
    </div>
</div>
<?php endif; ?>

<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="summary">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Legder Group</th>
                    <th> <?= $this->Paginator->sort('is_virtual', __('Ledger Account')); ?> </th>
                    <th> <?= $this->Paginator->sort('is_primary', __('Virtual')); ?> </th>
                    <th> <?= $this->Paginator->sort('is_primary', __('Primary')); ?> </th>
                    <th> <?= $this->Paginator->sort('is_admin', __('Admin')); ?> </th>
                    <th> <?= $this->Paginator->sort('is_supplier', __('Supplier')); ?> </th>
                    <th>Opening Balance</th>
                    <th>Closing Balance</th>
                    <th style="width : 12%;" data-csv="0"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['legder_group']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td>
                        <?= $record[$model]['is_virtual'] ? '<span class="label label-success"> Yes </span>' : '<span class="label label-danger"> No </span>' ?>
                    </td>
                    <td>
                        <?= $record[$model]['is_primary'] ? '<span class="label label-success"> Yes </span>' : '<span class="label label-danger"> No </span>' ?>
                    </td>
                    <td>
                        <?= $record[$model]['is_admin'] ? '<span class="label label-success"> Yes </span>' : '<span class="label label-danger"> No </span>' ?>
                    </td>
                    <td>
                        <?= $record[$model]['is_supplier'] ? '<span class="label label-success"> Yes </span>' : '<span class="label label-danger"> No </span>' ?>
                    </td>
                    <td><?= round($record[$model]['opening_balance'], ROUND_DIGIT); ?></td>
                    <td><?= round($record[$model]['opening_balance'] + $record[0]['closing_balance'], ROUND_DIGIT); ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <?php if ($url) : ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>
                        <?php endif; ?>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <?php if ( !$record[$model]['is_primary'] && $url) : ?>
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
