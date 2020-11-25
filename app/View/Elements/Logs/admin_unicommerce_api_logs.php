<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('id', __('ID')); ?> </th>
                    <th style="width : 20%;"> Api Url </th>
                    <th> Operation Type </th>
                    <th> Status </th>                    
                    <th> Message </th>
                    <th style="width : 12%;">Error</th>
                    <th >Warning</th>
                    <th >Date</th>
                    <th style="width : 25%;"> Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
				foreach ($records as $record):
				if($record[$model]['successful'] == 1)
				{
					$status = "True";
				}	
				else
				{
					$status = "False";
				}	
				?>
                <tr class="odd gradeX">
                    <td class="text-center"><?= $record[$model]['id']; ?></td>
                    <td class="text-center"><?= $record[$model]['api_url']; ?></td>
                    <td class="text-center"><?= $record[$model]['operation_type']; ?></td>
                    <td class="text-center"><?= $status; ?></td>
                    <td class="text-center"><?= $record[$model]['message']; ?></td>
                    <td class="text-center"><?= $record[$model]['errors']; ?></td>
                    <td class="text-center"><?= $record[$model]['warnings']; ?></td>
                    <td class="text-center"><?php echo DateUtility::getDate($record[$model]['created'], "d-M-Y h:i:s"); ?></td>
                    <td class="text-center">
                         <a href="javascript:void(0);" class="css-toggler" data-toggler-class="hidden" data-toggler-target="tr#<?= $record[$model]['id']; ?>">Details</a>
                    </td>
                </tr>
				<tr id="<?= $record[$model]['id']; ?>" class="hidden">
                    <td></td>
                    <td colspan="6" style="background-color:#EEF2F5; text-align: left;">
                        <table class="table table-striped table-bordered order-column sub-table">
                            <thead>
                                <tr>                                    
                                    <th class="ceil" style="width : 3%;">Request</th>
                                    <th class="ceil" style="width : 6%;">Response</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="center">
                                    <td ><?= $record[$model]['request_data'] ?></td>
                                    <td ><?= $record[$model]['response_data'] ?></td>
                                </tr>
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