<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th>Holiday Count</th>
                    <th style="width : 20%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= count($record["HolidayDetail"]); ?></td>
                    <td>                        
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
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
                <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="2" style="background-color:#EEF2F5; text-align: left;">
                        <table class="table table-striped table-bordered order-column sub-table sr-databtable">
                            <thead>
                                <tr>
                                    <th style="width : 10%;" data-search-clear="1"> # </th>
                                    <th data-search="1">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 0;  foreach ($record["HolidayDetail"] as $arr): $a++; ?>
                                <tr class="odd gradeX center">
                                    <td><?= $a ?></td>
                                    <td><?= DateUtility::getDate($arr["date"], DateUtility::DATE_OUT_FORMAT) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td colspan="2" style="background-color:#EEF2F5; text-align: left;">
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr>
                                    <th data-search="1">Dept.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $a = 0;  foreach ($record["HolidayDepartment"] as $arr): $a++; ?>
                                <tr class="odd gradeX center">
                                    <td><?= $dept_list[$arr["dept_id"]] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
