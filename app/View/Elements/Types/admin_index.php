<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Field In Database</th>
                    <th>Type</th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th> <?= $this->Paginator->sort('code', __('Code')); ?> </th>
                    <th>Value</th>
                    <th> <?= $this->Paginator->sort('display_order', __('Display Order')); ?> </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['type']; ?></td>
                    <td><?= isset(ProductAttrTypes::$list[$record[$model]['type']]) ? ProductAttrTypes::$list[$record[$model]['type']] : $record[$model]['type']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['code']; ?></td>
                    <td><?= $record[$model]['value']; ?></td>
                    <td><?= $record[$model]['display_order']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Copy" class="summary-link">
                            <i class="fa fa-clone icon font-green-meadow"></i>
                        </a>
                        
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
