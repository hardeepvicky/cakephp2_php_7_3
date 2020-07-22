<style>
    .template-table .block 
    {
        display: flex;
        justify-content : flex-start;
        align-items : center;
    }
    
    .template-table .up-down
    {
        font-size: 20px;
        color : #578EBE;
        display: flex;
        flex-direction : column;
        justify-content : space-between;
        align-items :center;
        border-right : 1px solid #ccc;
        padding-right : 10px;
        margin-right: 10px;
    }
</style>
<div class="form-body">
    <div class="form-group">
        <div class="col-md-offset-1 col-md-10 col-sm-12 col-xs-12">
            <table class="table table-striped table-bordered order-column template-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width : 80px;">
                            <span class="row-adder">                                        
                               <i class="fa fa-plus-circle font-green-meadow icon"></i>
                           </span>
                       </th>
                        <th style="width : 15%">
                            <?php if ($this->request->data[$model]["type"] == PROCESS_TYPE_CATEGORY): ?>
                                Operation Type
                            <?php else : ?>
                                Product Operation
                            <?php endif; ?>
                        </th>
                        <th style="width : 15%">
                            Ledger will affect if following Operation Type has been done
                            <span class="help-block">(You can left it empty to avoid dependency)</span>
                        </th>
                        <th style="width : 15%">Template</th>
                        <th>Can Change Process State</th>
                        <th>Can Scan Bundle</th>
                        <th>Bundle Reommandation Value</th>
                        <th>Days to Complete Operation Per Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="template-row hidden">
                        <td>
                            <div class="block">
                                <div class="up-down">
                                    <span class="row-up">
                                        <i class="fa fa-arrow-circle-up"></i>
                                    </span>
                                    <span class="row-down">
                                        <i class="fa fa-arrow-circle-down"></i>
                                    </span>
                                </div>
                                <div>
                                    <span class="row-deleter">
                                        <i class="fa fa-times-circle font-red-sunglo icon"></i>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?php 
                            if ($this->request->data[$model]["type"] == PROCESS_TYPE_CATEGORY)
                            {
                                echo $this->Form->input("ProcessNodeDetail.{{id}}.operation_type_id", array(
                                    "type" => "select",
                                    "options" => $operation_type_list,
                                    "class" => "form-control select2 is-required unique-list",
                                    "empty" => DROPDOWN_EMPTY_VALUE
                                ));
                            }      
                            else
                            {
                                echo $this->Form->input("ProcessNodeDetail.{{id}}.product_operation_id", array(
                                    "type" => "select",
                                    "options" => $product_operation_list,
                                    "class" => "form-control select2 is-required unique-list",
                                    "empty" => DROPDOWN_EMPTY_VALUE
                                ));
                            }
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("ProcessNodeDetail.{{id}}.legder_trigger_operation_type_id", array(
                                    "type" => "select",
                                    "options" => $operation_type_list,
                                    "class" => "form-control select2",
                                    "empty" => DROPDOWN_EMPTY_VALUE
                                )); 
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("ProcessNodeDetail.{{id}}.process_node_template_id", array(
                                    "type" => "select",
                                    "options" => $node_template_list,
                                    "class" => "form-control select2",
                                    "empty" => DROPDOWN_EMPTY_VALUE
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("ProcessNodeDetail.{{id}}.can_change_process_state", array(
                                    "type" => "checkbox",
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("ProcessNodeDetail.{{id}}.can_scan_bundle", array(
                                    "type" => "checkbox",
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("ProcessNodeDetail.{{id}}.bundle_recommandation_value", array(
                                    "type" => "text",
                                    "class" => "form-control validate-float"
                                ));
                            ?>
                        </td>
                        <td>
                            <?= $this->Form->input("ProcessNodeDetail.{{id}}.days_to_complete", array(
                                    "type" => "text",
                                    "class" => "form-control validate-int"
                                ));
                            ?>
                        </td>
                    </tr>
                    
                    <?php foreach($this->request->data["ProcessNodeDetail"] as $k => $process_node_detail) : $id = $process_node_detail["id"]; ?>
                        <tr data-row-id="<?= $k ?>">
                            <td>
                                <div class="block">
                                    <div class="up-down">
                                        <span class="row-up">
                                            <i class="fa fa-arrow-circle-up"></i>
                                        </span>
                                        <span class="row-down">
                                            <i class="fa fa-arrow-circle-down"></i>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php 
                                echo $this->Form->hidden("ProcessNodeDetail.$k.id");
                                if ($this->request->data[$model]["type"] == PROCESS_TYPE_CATEGORY)
                                {
                                    echo $operation_type_list[$process_node_detail["operation_type_id"]];
                                }      
                                else
                                {
                                    echo $product_operation_list[$process_node_detail["product_id"]];
                                }
                                ?>
                            </td>
                            <td>
                                <?= $this->Form->input("ProcessNodeDetail.$k.legder_trigger_operation_type_id", array(
                                        "type" => "select",
                                        "options" => $operation_type_list,
                                        "class" => "form-control select2me",
                                        "empty" => DROPDOWN_EMPTY_VALUE,
                                        "value" => $process_node_detail["legder_trigger_operation_type_id"]
                                    )); 
                                ?>
                            </td>
                            <td>
                                <?= $this->Form->input("ProcessNodeDetail.$k.process_node_template_id", array(
                                        "type" => "select",
                                        "options" => $node_template_list,
                                        "class" => "form-control select2me",
                                        "empty" => DROPDOWN_EMPTY_VALUE,
                                        "value" => $process_node_detail["process_node_template_id"]
                                    ));
                                ?>
                            </td>
                            <td>
                                <?= $this->Form->input("ProcessNodeDetail.$k.can_change_process_state", array(
                                        "type" => "checkbox",
                                        "checked" => $process_node_detail["can_change_process_state"]
                                    ));
                                ?>
                            </td>
                            <td>
                                <?= $this->Form->input("ProcessNodeDetail.$k.can_scan_bundle", array(
                                        "type" => "checkbox",
                                        "checked" => $process_node_detail["can_scan_bundle"]
                                    ));
                                ?>
                            </td>
                            <td>
                                <?= $this->Form->input("ProcessNodeDetail.$k.bundle_recommandation_value", array(
                                        "type" => "text",
                                        "class" => "form-control validate-float"
                                    ));
                                ?>
                            </td>
                            <td>
                                <?= $this->Form->input("ProcessNodeDetail.$k.days_to_complete", array(
                                        "type" => "text",
                                        "class" => "form-control validate-int"
                                    ));
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" href="javascript:;" class="btn blue">Submit</button>
        <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function()
    {
        $(".template-table").tableTemplate({
            onRowAdd : function (tr, e)
            {
                tr.find(".is-required").attr("required", true);
                tr.find(".select2").select2();
            }
        });
        
        $("form").submit(function()
        {
            $("form .error-message").remove();
            
            if ($("table.template-table tbody tr").length < 2)
            {
                bootbox.alert("At Least 2 rows are required");
                return false;
            }
            
            var result = true;
            var error_ele = null;
            var list = [];
            $(".unique-list").each(function()
            {
                var v = $(this).val();
                if (list.indexOf(v) === -1)
                {
                    list.push(v);
                }
                else
                {
                    $(this).parents("td").append('<span class="error-message">Duplicate Operation Type</span>');
                    error_ele = $(this).parents("td").find(".error-message");
                }
            });
            
            if (error_ele)
            {
                $('html, body').animate({
                    scrollTop: error_ele.offset().top - 300
                }, 1000);
            }
            
            return result;
        });
    });
</script>