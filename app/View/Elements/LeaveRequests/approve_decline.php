<div id="leave-request-hidden-info" style="display: none">
    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-12">User :</label>
        <div class="col-md-6 col-sm-6 col-xs-12 user" style="padding-top : 7px"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-12">Start Date :</label>
        <div class="col-md-6 col-sm-6 col-xs-12 start_date" style="padding-top : 7px"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-12">End Date :</label>
        <div class="col-md-6 col-sm-6 col-xs-12 end_date" style="padding-top : 7px"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-12">Leave Count :</label>
        <div class="col-md-6 col-sm-6 col-xs-12 leave_count" style="padding-top : 7px"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-12">Paid Leave :</label>
        <div class="col-md-6 col-sm-6 col-xs-12 is_paid" style="padding-top : 7px"></div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4 col-xs-12">Leave Reason :</label>
        <div class="col-md-6 col-sm-6 col-xs-12 leave_reason" style="padding-top : 7px"></div>
    </div>
</div>

<div id="modal-leave-approve" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
                echo $this->Form->create($model, array(
                    "class" => "form-horizontal form-row-seperated",
                    'inputDefaults' => array(
                        'label' => false, 'div' => false, 'div' => false, "escape" => false,
                        "class" => "form-control invalid-sql-char", "type" => "text"
                    )
                ));

                echo $this->Form->hidden('id');
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Approve Leave</h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="leave-request-info"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-4 col-xs-12">Approve Remarks :</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $this->Form->input("approved_remarks", [
                                "type" => "textarea",
                                "rows" => 3,
                                "class" => "form-control invalid-sql-char"
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" href="javascript:;" class="btn blue">Approve</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<div id="modal-leave-decline" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php
                echo $this->Form->create($model, array(
                    "class" => "form-horizontal form-row-seperated",
                    'inputDefaults' => array(
                        'label' => false, 'div' => false, 'div' => false, "escape" => false,
                        "class" => "form-control invalid-sql-char", "type" => "text"
                    )
                ));

                echo $this->Form->hidden('id');
            ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Approve Leave</h4>
            </div>
            <div class="modal-body">
                <div class="form-body">
                    <div class="leave-request-info"></div>
                    <div class="form-group">
                        <label class="control-label col-sm-4 col-xs-12">Decline Reason <span>*</span> :</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <?= $this->Form->input("decline_reason", [
                                "type" => "textarea",
                                "rows" => 3,
                                "class" => "form-control invalid-sql-char",
                                "required"
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" href="javascript:;" class="btn red">Decline</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function ()
    {
        function fill_model_form(_modal, block)
        {
            _modal.find("input[name='data[LeaveRequest][id]']").val(block.find(".id").val());
            
            var request_info = $("#leave-request-hidden-info");
            request_info.find(".user").html(block.find(".user").html());
            request_info.find(".start_date").html(block.find(".start_date").html());
            request_info.find(".end_date").html(block.find(".end_date").html());
            request_info.find(".leave_count").html(block.find(".leave_count").html());
            request_info.find(".leave_reason").html(block.find(".leave_reason").html());
            request_info.find(".is_paid").html(block.find(".is_paid").html());
            
            _modal.find(".leave-request-info").html(request_info.html());
        }
        
        $(document).on("click", ".approve", function ()
        {
            var _modal = $("#modal-leave-approve");
            var request_block = $($(this).attr("data-request-block"));
            fill_model_form(_modal, request_block);
            _modal.modal("show");
        });
        
        $(document).on("click", ".decline", function ()
        {
            var _modal = $("#modal-leave-decline");
            var request_block = $($(this).attr("data-request-block"));
            fill_model_form(_modal, request_block);
            _modal.modal("show");
        });
        
        $("#modal-leave-approve form").submit(function(e)
        {
            e.preventDefault();
            
            var url = "/LeaveRequests/ajaxApproveOrDecline/" + '<?= LeaveRequest::APPROVE ?>';
            
            approve_decline(url , $(this).serialize());
            
            return;
        });
        
        $("#modal-leave-decline form").submit(function(e)
        {
            e.preventDefault();
            
            var url = "/LeaveRequests/ajaxApproveOrDecline/" + '<?= LeaveRequest::DECLINE ?>';
            
            approve_decline(url , $(this).serialize());
            
            return;
        });
        
        function approve_decline(url, data)
        {
            $.post(url, data, function (response)
            {
                try
                {
                    response = JSON.parse(response);
                }
                catch(e)
                {
                    bootbox.alert(response);
                    return;
                }
                
                if (response["status"])
                {
                    document.location.reload();
                }
                else
                {
                    bootbox.alert(response["msg"]);
                }
            });
        }
    });
</script>