<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th>Party</th>
                    <th>Location</th>
                    <th>Request Qty</th>
                    <th>Found Qty</th>
                    <th>Download File</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $party_list[$record[$model]['party_id']]; ?></td>
                    <td><?= $location_list[$record[$model]['location_id']]; ?></td>
                    <td><?= $record[$model]['request_qty']; ?></td>
                    <td><?= $record[$model]['qty']; ?></td>
                    <td>
                        <a href="/<?= $record[$model]['pdf_file']; ?>" download>
                            <i class="fa fa-file-pdf"></i>
                            PDF
                        </a>
                    </td>
                    <td><?= $user_list[$record[$model]['created_by']]; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        
                        <?php $url = $this->Html->url(array("action" => "ajaxLockedDetails", "admin" => false, $record[$model]['id'])); ?>
                        <a href="javascript:void(0);" class="css-toggler ajax-loader"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden"
                           data-loader-target="tr#record-<?= $record[$model]['id'] ?> .lock-details" data-loader-href="<?= $url; ?>"
                           >Details</a>
                    </td>
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden">
                    <td></td>
                    <td class="lock-details" colspan="6">
                        
                    </td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>