<?php
$disabled = $this->request->data[$model]["is_disable"] ? "disabled" : "";
?>

<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Location <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?=
            $this->Form->input('location_id', array(
                "type" => "select",
                "class" => "form-control select2me",
                "options" => $location_list,
                "empty" => DROPDOWN_EMPTY_VALUE
            ));
            ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Shipment No. <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('shipment_no', array("readOnly" => true)); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Party Shipment No. <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('party_shipment_no'); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Dispatch Deadline <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('dispatch_deadline',[
                "id" => "dispatch_deadline",
                "class" => "form-control date-picker",
                "data-date-start" => 0,
                "placeholder" => "dd-MMM-YYYY",
                "auto"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Delivery Date <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('delivery_date',[
                "class" => "form-control date-picker",
                "data-date-start" => "#dispatch_deadline",
                "placeholder" => "dd-MMM-YYYY"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Promise Return Days <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('promise_return_days', [
                "class" => "form-control validate-int"
            ]); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Mode Of Payment <span>*</span> :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?=
            $this->Form->input('mode_of_payment', array(
                "type" => "select",
                "class" => "form-control select2me",
                "options" => PurchaseOrder::PAYMENT_MODE_LIST,
                "empty" => DROPDOWN_EMPTY_VALUE
            ));
            ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12"></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="mt-checkbox-inline">
                <label class="mt-checkbox mt-checkbox-outline">
                    <?= $this->Form->input('is_gst_apply', array('type' => 'checkbox')); ?> GST Apply
                    <span></span>
                </label>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Comments :</label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?= $this->Form->input('comments', array('placeholder' => 'Comments', 'type' => 'textarea', 'rows' => 2)); ?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Documents :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <input type="file" name="data[files][]" multiple="multiple">
            <?php if ( isset($this->validationErrors[$model]['files']) ): ?>
            <ul class="error-message">
                <?php foreach ($this->validationErrors[$model]['files'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <table class="table table-bordered order-column table-template">
                <tbody>
                    <?php 
                    if (isset($this->request->data["PurchaseOrderFile"]) && $this->request->data["PurchaseOrderFile"]):
                        foreach($this->request->data["PurchaseOrderFile"] as $i => $file):
                            echo $this->Form->hidden("PurchaseOrderFile.$i.id");
                            echo $this->Form->hidden("PurchaseOrderFile.$i.file");
                    ?>
                    <tr>
                        <td>
                            <?php 
                                $name = pathinfo($file['file'], PATHINFO_BASENAME); 
                                $name = explode("?", $name)[0];
                                echo $name;
                            ?>
                        </td>
                        <td>
                            <a href="<?= FileUtility::get($file['file']); ?>" target="_blank">Download</a>
                        </td>
                        <td>
                            <a href="<?= $this->Html->url(array("action" => "admin_delete_file", $file["id"])) ?>" class="file-delete" data-id="<?= $file['id'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; endif;?>      
                </tbody>
            </table>
        </div>
    </div>
    
    <?php if (!$disabled): ?>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Product File :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <input type="file" name="data[product_file]">
            <?php if ( isset($this->validationErrors[$model]['product_file']) ): ?>
            <ul class="error-message">
                <?php foreach ($this->validationErrors[$model]['product_file'] as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="col-md-2 col-sm-6 col-xs-12">
            <?php if (isset($sample)) : ?>
            <a href="/<?= $sample ?>" download>Sample</a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</div>

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" class="btn blue" name="is_next" value="1">Next</button>
        <?php if ($action == "admin_edit"): ?>
            <button type="submit" class="btn blue">Submit</button>
        <?php endif; ?>
    </div>
</div>

<?php if (isset($errors)): ?>
<h3 class="section">
    Errors
    <?php if (isset($import_log_id)): ?>
        <a class="btn btn-default" href="<?= $this->Html->url(array("controller" => "Logs", "action" => "admin_download_import_error_log", $import_log_id)) ?>">Download Error Log</a>
    <?php endif; ?>
</h3>

<ol>
    <?php foreach($errors as $error): ?>
        <li>
            <span class="error-message"><?= $error ?></span>
        </li>
    <?php endforeach; ?>
</ol>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready(function()
    {
        $(".file-delete").click(function()
        {
            var _this = $(this);
            var href = $(this).attr("href");
            
            bootbox.confirm({
                message: "Are You sure to Delete. This can not be undo.",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) 
                {
                    if (result)
                    {
                        $.get(href, function(data)
                        {
                            if (data == "1")
                            {
                                _this.closest("tr").remove();
                            }
                            else
                            {
                                bootbox.alert(data);
                            }
                        });
                    }
                }
            });
            
            return false;
        });
    });
</script>