<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true, "ajax" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 200px;" colspan="2">Actions</th>
                    <th style="width : 15%;"> Service Name </th>
                    <th style="width : 12%;"> User </th>
                    <th style="width : 10%;"> <?php echo $this->Paginator->sort('execution_time',  'Time Taken (Seconds)'); ?></th>
                    <th style="width : 8%;"><?php echo $this->Paginator->sort('status',  'Response Status'); ?></th>
                    <th style="width : 12%;"><?php echo $this->Paginator->sort('created',  'Datetime'); ?></th>
                    <th><?php echo $this->Paginator->sort('request_length',  'Request Size'); ?></th>
                    <th><?php echo $this->Paginator->sort('response_length',  'Response Size'); ?></th>
                    <th><?php echo $this->Paginator->sort('sql_count',  'Sql Count'); ?></th>
                    <th><?php echo $this->Paginator->sort('sql_exec_time',  'Sql Exec Time'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td>
                        <a href="/Logs/downloadWebServiceLog/<?= $record[$model]['id'] ?>/sql_log/txt" target="_blank">Download Sql Log</a>
                    </td>
                    <td>                        
                        <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
                    <td><?= isset($web_service_types[$record[$model]['type']]) ? $web_service_types[$record[$model]['type']] : "-"; ?></td>
                    <td><?= isset($user_list[$record[$model]['user_id']]) ? $user_list[$record[$model]['user_id']] : "-"; ?></td>
                    <td><?= $record[$model]['execution_time']; ?></td>
                    <td>
                        <i class="fa <?= $record[$model]['status'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                    </td>
                    <td><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>
                    <td><?= Util::niceBytes($record[$model]['request_length']) ?></td>
                    <td><?= Util::niceBytes($record[$model]['response_length']) ?></td>
                    <td><?= $record[$model]["sql_count"] ?></td>
                    <td><?= $record[$model]["sql_exec_time"] ?></td>
                </tr>
                <tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="10" style="background-color:#EEF2F5; text-align: left;">
                        <?php if ($record[$model]['info']) : ?>
                        <label><b>Highlights</b></label><br/>
                        <div class="portlet-body padding-5 has-margin-bottom-10">
                            <?= $record[$model]['info']; ?>
                        </div>
                        <?php endif; ?>

                        <div>
                            <label>
                                <b>Request</b> 
                                <?php if ($record[$model]['request_length'] > 10240): ?>
                                    <a href="/Logs/downloadWebServiceLog/<?= $record[$model]['id'] ?>/request" target="_blank">Download JSON (<?= Util::niceBytes($record[$model]['request_length']) ?>)</a><br/>
                                <?php else : ?>                            
                                    <span class="btn btn-default copy-value" data-copy-target="tr#<?= $record[$model]['id']; ?> .request-input">Copy</span>
                                    <input type="text" class="request-input" value="<?= htmlentities($record[$model]['request']); ?>" />
                                    <br/>
                                    <div class="portlet-body padding-5 has-margin-bottom-10 more-text request" data-more-text-char-len="200">
                                        <?= $record[$model]['request']; ?>
                                    </div>
                                <?php endif; ?>                            
                            </label>
                        </div>

                        <div>
                            <label>
                                <b>Response</b> 
                                <?php if ($record[$model]['response_length'] > 10240 || !$record[$model]['status']): ?>
                                    <a href="/Logs/downloadWebServiceLog/<?= $record[$model]['id'] ?>/response/html" target="_blank">Download(<?= Util::niceBytes($record[$model]['response_length']) ?>)</a><br/>
                                <?php else : ?>                            
                                    <span class="btn btn-default copy-value" data-copy-target="tr#<?= $record[$model]['id']; ?> .response-input">Copy</span>
                                    <input type="text" class="response-input" value="<?= htmlentities($record[$model]['response']); ?>" />
                                    <br/>
                                    <div class="portlet-body padding-5 more-text response" data-more-text-char-len="200">
                                        <?= $record[$model]['response']; ?>
                                    </div>
                                <?php endif; ?>
                            </label>
                        </div>                           
                    </td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination", array("ajax" => true)) ?>
</div>