<?php if ($records) : ?>
<?= $this->Html->link("Export CSV", array_merge(array("action" => "admin_csv"), $search), array("class" => "btn blue")); ?>
<?php endif; ?>

<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Party</th>
                    <th> <?= $this->Paginator->sort('awb', __('AWB')); ?> </th>
                    <th> <?= $this->Paginator->sort('mobile', __('mobile')); ?> </th>
                    <th> <?= $this->Paginator->sort('date_time', __('Date Time')); ?> </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= isset($party_list[$record[$model]['party_id']]) ? $party_list[$record[$model]['party_id']] : "-"; ?></td>
                    <td><?= $record[$model]['awb']; ?></td>
                    <td><?= $record[$model]['mobile']; ?></td>
                    <td><?= $record[$model]['date_time']; ?></td>
                    <td>
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
