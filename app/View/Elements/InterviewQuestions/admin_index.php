<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 15%;">Question Group</th>
                    <th style="width : 30%;"> <?= $this->Paginator->sort('name', __('Question')); ?> </th>
                    <th style="width : 10%;">Time Limit</th>
                    <th>Media</th>
                    <th style="width : 10%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $que_group_list[$record[$model]['interview_question_group_id']]; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= Util::niceTime($record[$model]['time_limit']); ?></td>
                    <td>
                        <?php foreach($record["InterviewQuestionFile"] as $file): ?>
                            <?php if ($file["is_audio"]): ?>
                                <audio controls>
                                    <source src="<?= view_google_link($file["google_id"]) ?>" type="audio/mpeg">
                                  Your browser does not support the audio element.
                                </audio>
                            <?php else: ?>
                                <a class="fancybox" data-fancybox="que-<?= $record[$model]['id'] ?>" href="<?= view_google_link($file["google_id"]) ?>">
                                    <img src="<?= view_google_link($file["google_id"]) ?>" class="media-img" />
                                </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "ajaxGetAnswers", "admin" => false, $record[$model]['id'])); ?>
                        <a href="javascript:void(0);" class="css-toggler ajax-loader"  data-toggler-target="tr#record-<?= $record[$model]['id'] ?>" data-toggler-class="hidden"
                           data-loader-target="tr#record-<?= $record[$model]['id'] ?> .answers" data-loader-href="<?= $url; ?>"
                           >Answers</a>
                    </td>                    
                </tr>
                <tr id="record-<?= $record[$model]['id'] ?>" class="hidden" style="background-color: #EEE">
                    <td class="answers" colspan="5">
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
