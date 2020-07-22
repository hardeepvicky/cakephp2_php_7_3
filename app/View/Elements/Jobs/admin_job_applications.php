<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th>Job Title</th>
                    <th>Apply Date Time</th>
                    <th>Applicant</th>
                    <th>Applicant Email</th>
                    <th>Applicant Resume</th>
                    <th><?= $this->Paginator->sort('is_accept', __('Accept / Reject')); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td class="id"><?= $record[$model]['id']; ?></td>
                    <td><?= $job_list[$record[$model]['job_id']]; ?></td>
                    <td><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATETIME_OUT_FORMAT); ?></td>
                    <td class="name"><?= $record[$model]['name']; ?></td>
                    <td class="email"><?= $record[$model]['email']; ?></td>
                    <td>
                        <a href="/<?= $record[$model]['resume']; ?>" target="_blank">Download Resume</a>
                    </td>
                    <td>
                        <?php if ($record[$model]["is_accept"] == 0): ?>
                            <a href="javascript:void(0);" class="btn btn-success job-applicant-accept"> Accept</a>
                            <a href="javascript:void(0);" class="btn btn-danger job-applicant-reject"> Reject</a>
                        <?php elseif ($record[$model]["is_accept"] == "-1"): ?>
                            <label class="label label-danger">Rejected</label>
                        <?php elseif ($record[$model]["is_accept"] == 1): ?>
                            <label class="label label-success">Accepted</label>
                            <div style="margin-top : 8px;">
                                <label class="label label-info">Interview Date Time : <?= $record[$model]['interveiw_datetime']; ?></label>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
