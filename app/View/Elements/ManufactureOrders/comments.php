<div class="table__structure">
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" style="min-width: 700px;">
            <thead>
                <tr>
                    <th style="width : 6%;"> # </th>
                    <th style="width : 40%;">Comment</th>
                    <th style="width : 20%;">User</th>
                    <th style="width : 25%;">Created</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach ($records as $record): $i++; ?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $i; ?></td>
                    <td><?= $record["ManufactureOrderComment"]['comment']; ?></td>
                    <td class="text-center"><?= $user_list[$record["ManufactureOrderComment"]['created_by']]; ?></td>
                    <td class="text-center"><?= DateUtility::getDate($record["ManufactureOrderComment"]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>