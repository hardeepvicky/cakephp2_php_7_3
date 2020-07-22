<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Party')); ?> </th>
                    <th>GST No.</th>
                    <th>Bank Name</th>
                    <th>Bank IFSC Code</th>
                    <th>Bank Account</th>
                    <th> <?= $this->Paginator->sort('is_ecommerce', __('E-Commerce')); ?> </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['gst_no']; ?></td>
                    <td><?= $record[$model]['bank_name']; ?></td>
                    <td><?= $record[$model]['bank_ifsc_code']; ?></td>
                    <td><?= $record[$model]['bank_account']; ?></td>
                    <td><?= $record[$model]['is_ecommerce'] ? '<span class="label label-success">Yes</span>' : ''; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_save_charges", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            Charges
                        </a>
                        
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
