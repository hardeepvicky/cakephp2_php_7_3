<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column sr-databtable">
            <thead>
                <tr>
                    <th style="width : 10%;" dat-search-clear="1"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th data-search="1"> Type </th>
                    <th data-search="1"> From Email </th>
                    <th data-search="1"> To Email </th>
                    <th data-search="1"> Subject </th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                    <th style="width : 12%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $record[$model]['id']; ?></td>
                    <td class="text-center"><?= isset(StaticArray::$email_code_list[$record[$model]['code']]) ? StaticArray::$email_code_list[$record[$model]['code']] : $record[$model]['code']; ?></td>
                    <td><?= $record[$model]['from_email']; ?></td>
                    <td><?= $record[$model]['to_email']; ?></td>
                    <td><?= $record[$model]['subject']; ?></td>
                    <td class="text-center"><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>
                    <td class="text-center">
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
                </tr>
                <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="5" style="background-color:#EEE;">
                        <?= $record[$model]["body"] ?>
                    </td>
                    <td></td>
                 </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>