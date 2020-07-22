<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th> <?= $this->Paginator->sort('time_in_mintues', __('Time In Mintues')); ?> </th>
                    <th> Comments </th>
                    <th style="width : 16%;" colspan="2"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['time_in_mintues']; ?></td>
                    <td><?= $record[$model]['comments']; ?></td>
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
                    <td>
                        <a href="javascript:void(0)" class="css-toggler" data-toggler-target="#tr-<?= $record[$model]['id'] ?>" data-toggler-class="hidden">Details</a>
                    </td>
                </tr>
                <tr class="hidden" id="tr-<?= $record[$model]['id'] ?>">                    
                    <td></td>
                    <td colspan="4" style="background-color: #EEE;">
                        Comments : <?= $record[$model]['comments']; ?>
                        <h3 class="section">                            
                            Operation Rates
                            <a class="btn btn-default" target='_blank' href="<?= $this->Html->url(array("action" => "admin_add_rate", $record[$model]['id'])); ?>">
                                Add Rate
                            </a>
                        </h3>
                        
                        <table class="table table-striped table-bordered order-column">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ( $record['BasicOperationRate'] as $price): ?>
                                <tr>
                                    <td class="text-center"><?= DateUtility::getDate($price['date'], DateUtility::DATE_OUT_FORMAT); ?></td>
                                    <td class="text-center">&#8360 <?= $price['rate'] ?></td>
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
