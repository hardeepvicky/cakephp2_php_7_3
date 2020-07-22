<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Location')); ?> </th>
                    <th> <?= $this->Paginator->sort('ParentLocation.name', __('Parent Location')); ?> </th>
                    <th> Mobile </th>
                    <th style="width : 10%;"> Is Company Location </th>
                    <th style="width : 10%;"> Is Manufacture Location </th>
                    <th style="width : 10%;"> Is Sale </th>
                    <th style="width : 10%;"> Is Garbage </th>
                    <th>Party</th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_active', __('Status')); ?> </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record["ParentLocation"]['name']; ?></td>
                    <td><?= $record[$model]['mobile']; ?></td>
                    <td><?= $record[$model]['is_company_location'] ? 'Yes' : 'No'; ?></td>
                    <td><?= $record[$model]['is_manufacture_location'] ? 'Yes' : 'No'; ?></td>
                    <td><?= $record[$model]['is_sale_location'] ? 'Yes' : 'No'; ?></td>
                    <td><?= $record[$model]['is_garbage'] ? 'Yes' : 'No'; ?></td>
                    <td><?= isset($party_list[$record[$model]['party_id']]) ? $party_list[$record[$model]['party_id']] : "-"; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "ajaxToggleActive", $record[$model]['id'], "admin" => false)); ?>
                        <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_active" data-value="<?= (int) $record[$model]['is_active'] ?>">
                            <i class="fa <?= $record[$model]['is_active'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        </a>
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
