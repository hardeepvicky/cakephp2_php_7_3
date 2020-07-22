<div class="form__structure">
    <?php
        echo $this->Form->create($model, array(
            'type' => 'file',
            "class" => "form-horizontal form-row-seperated validate",
            'inputDefaults' => array(
                'label' => false, 'div' => false, 'div' => false, "escape" => false,
                "class" => "form-control invalid-sql-char ", "type" => "text"
            )
        ));
        
        echo $this->Form->hidden('id');
    ?>
    <div class="form-body">
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered order-column table-template">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <span class="row-adder">                                        
                                    <i class="fa fa-plus-circle font-green-meadow icon"></i>
                                </span>
                            </th>
                            <th>Box</th>
                            <th>Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hidden template-row">
                            <td class="text-center">
                                <span class="row-deleter">
                                    <i class="fa fa-times-circle font-red-sunglo icon"></i>
                                </span>
                            </td>
                            <td>
                                <?= $this->Form->input('GatePassReturnBox.{{id}}.box_no', array("class" => "form-control unique-list validate-alpha-numeric")); ?>
                            </td>
                            <td>
                                <?= $this->Form->input('GatePassReturnBox.{{id}}.weight', array("class" => "form-control validate-float")); ?>
                            </td>
                        </tr>
                        <?php if (isset($this->request->data['GatePassReturnBox'])) :
                                    foreach($this->request->data['GatePassReturnBox'] as $id => $field_data) : 
                                ?>
                                <tr class="template-row" data-row-id="<?= $id ?>">
                                    <td class="text-center">
                                        <?= ($id + 1) ?>
                                    </td>
                                    <td>
                                        <?= $this->Form->input("GatePassReturnBox.$id.box_no", array("class" => "form-control unique-list validate-alpha-numeric")); ?>
                                    </td>
                                    <td>
                                        <?= $this->Form->input("GatePassReturnBox.$id.weight", array("class" => "form-control validate-float")); ?>
                                    </td>
                                </tr>
                        <?php 
                            endforeach; 
                           endif;
                       ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="action-buttons">
        <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
            <button type="submit" href="javascript:;" class="btn blue">Submit</button>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<script type="text/javascript">
    $(document).ready(function()
    {
        $(".table-template").tableTemplate({
            onRowAdd : function (tr, opt)
            {
                tr.find("select").attr("required", true);
                tr.find("input[type='text']").attr("required", true);
            }
        });
        
        $("form").submit(function()
        {
            var result = true;
            var error_ele = null;
            var list = [];
            $(".unique-list").each(function()
            {
                var v = $(this).val().trim();
                if (list.indexOf(v) === -1)
                {
                    list.push(v);
                }
                else
                {
                    $(this).parents("td").append('<span class="error-message">Duplicate Field</span>');
                    error_ele = $(this).parents("td").find(".error-message");
                    result = false;
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