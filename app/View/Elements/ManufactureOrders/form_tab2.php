<?php $size_ratio_input_attr = $manufacture_order_approved_main_cut_count > 0 ? array("readonly" => true, 'class' => "form-control size-ratio") : array("required" => true, 'class' => "form-control size-ratio validate-float"); ?>
<div class="form-body">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-4 col-xs-12">Total Qty <span>*</span> :</label>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <?= $this->Form->input('qty', array("id" => "total_qty", "type" => "number", "min" => 1, "max" => 100000)); ?>
        </div>                
    </div> 
    
    <h3 class="section">
        Sizes
    </h3>
    <table class="table table-striped table-bordered order-column">
        <thead>
            <tr class="center">
                <th>Size</th>
                <th style="width : 100px;">Request Ratio</th>
                <th>Request Qty</th>
                <th>Amendment Ratio</th>
                <th>Amendment Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->request->data["ManufactureOrderRatioSize"] as $k => $size):?>
            <tr class="center">
                <td><?= $type_list[$size["size_type_id"]] ?></td>
                <td>
                    <?= $this->Form->hidden("ManufactureOrderRatioSize.$k.id") ?>
                    <?= $this->Form->hidden("ManufactureOrderRatioSize.$k.size_type_id") ?>
                    <?= $this->Form->input("ManufactureOrderRatioSize.$k.ratio", array_merge(array( "type" => "text", "min" => 0), $size_ratio_input_attr)) ?>
                </td>
                <td>
                    <span class="qty"></span>
                    <?= $this->Form->hidden("ManufactureOrderRatioSize.$k.qty", array("class" => "qty")) ?>
                </td>

                <td class="amendment_ratio">
                    <?php 
                        if (isset($this->request->data['ManufactureOrderRatioSize'][$k]))
                        {
                            echo $this->request->data['ManufactureOrderRatioSize'][$k]['amendment_ratio'];
                        }
                    ?>
                </td>
                <td>
                    <?php 
                        if (isset($this->request->data['ManufactureOrderRatioSize'][$k]))
                        {
                            echo $this->request->data['ManufactureOrderRatioSize'][$k]['amendment_qty'];
                        }
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h3 class="section">
        Colors
    </h3>
    <table class="table table-striped table-bordered order-column">
        <thead>
            <tr class="center">
                <th>Color</th>
                <th style="width : 100px;">Request Ratio</th>
                <th>Request Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->request->data["ManufactureOrderRatioColor"] as $k => $color): ?>
            <tr class="center">
                <td><?= $type_list[$color["color_type_id"]] ?></td>
                <td>
                    <?= $this->Form->hidden("ManufactureOrderRatioColor.$k.id") ?>
                    <?= $this->Form->hidden("ManufactureOrderRatioColor.$k.color_type_id") ?>
                    <?= $this->Form->input("ManufactureOrderRatioColor.$k.ratio", array( "type" => "text", "min" => 0, 'class' => "form-control color-ratio validate-float", "required" => true)) ?>
                </td>
                <td>
                    <span class="qty"></span>
                    <?= $this->Form->hidden("ManufactureOrderRatioColor.$k.qty", array("class" => "qty")) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h3 class="section">
        Brands
    </h3>
    <table class="table table-striped table-bordered order-column">
        <thead>
            <tr class="center">
                <th>Brand</th>
                <th style="width : 100px;">Ratio</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($this->request->data["ManufactureOrderRatioBrand"] as $k => $brand): ?>
            <tr class="center">
                <td><?= $type_list[$brand["brand_type_id"]] ?></td>
                <td>
                    <?= $this->Form->hidden("ManufactureOrderRatioBrand.$k.id") ?>
                    <?= $this->Form->input("ManufactureOrderRatioBrand.$k.ratio", array( "type" => "text", "min" => 0, 'class' => "form-control brand-ratio validate-float", "required" => true)) ?>
                </td>
                <td>
                    <span class="qty"></span>
                    <?= $this->Form->hidden("ManufactureOrderRatioBrand.$k.qty", array("class" => "qty")) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="action-buttons">
    <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
        <button type="submit" href="javascript:;" class="btn blue">Submit</button>
        <button type="submit" href="javascript:;" class="btn blue" name="next" value="1" style="max-width: 150px;">Save & Next</button>
        <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
    </div>
</div>

<script type="text/javascript">
    function check_total_qty()
    {
        var total_qty = $("#total_qty").val();
        
        if (!total_qty || parseInt(total_qty) <= 0)
        {
            return "Please Enter Total Qty";
        }
        
        return true;
    }
    
    function check_ratio(obj)
    {
        var total_qty = $("#total_qty").val();
        
        var total_ratio = 0; 
        var one_found = false;
        $(obj).each(function ()
        {
            var v = $(this).val();
            if (v)
            {
                if (v == "1")
                {
                    one_found = true;
                }
                total_ratio += parseFloat(v);
            }
        });
        
        if (total_ratio <= 0)
        {
            return "Enter at least one ratio";
        }
        
        if (!one_found)
        {
            return " There should be 1 among ratio";
        }
        
        $(obj).each(function()
        {
            var v = $(this).val();

            var fraction = 0;
            if (v && total_ratio)
            {
                fraction = v / total_ratio;
            }

            var tr = $(this).closest("tr");
            
            var qty = Math.ceil(total_qty * fraction);
            tr.find("span.qty").html(qty);
            tr.find("input.qty").val(qty);
        });
        
        return true;
    }
    
    function cal_size_ratio()
    {
        var r = check_total_qty();
        
        if (r !== true)
        {
            return r;
        }
        
        r = check_ratio($(".size-ratio"));
        
        if (r !== true)
        {
            return "Size Ratio : " + r;
        }
        
        return true;
    }
    
    function cal_color_ratio()
    {
        var r = check_total_qty();
        
        if (r !== true)
        {
            return r;
        }
        
        r = check_ratio($(".color-ratio"));
        
        if (r !== true)
        {
            return "Color Ratio : " + r;
        }
        
        return true;
    }
    
    function cal_brand_ratio()
    {
        var r = check_total_qty();
        
        if (r !== true)
        {
            return r;
        }
        
        r = check_ratio($(".brand-ratio"));
        
        if (r !== true)
        {
            return "Brand Ratio : " + r;
        }
        
        return true;
    }
    
    $(document).ready(function()
    {
        $(".size-ratio").blur(function(e)
        {
            cal_size_ratio();            
        });
        
        $(".color-ratio").blur(function()
        {
            cal_color_ratio();
        });
        
        $(".brand-ratio").blur(function()
        {
            cal_brand_ratio();
        });
        
        $("#total_qty").blur(function()
        {
            cal_size_ratio();
            cal_color_ratio();
            cal_brand_ratio();            
        });
        
        $("#total_qty").trigger("blur");
        
        var agree_with_amendment = true;
        $("form").submit(function()
        {
            var r = cal_size_ratio();
            
            if (r !== true)
            {
                bootbox.alert(r);
                return false;
            }
            
            var r = cal_color_ratio();
            
            if (r !== true)
            {
                bootbox.alert(r);
                return false;
            }
            
            var r = cal_brand_ratio();
            
            if (r !== true)
            {
                bootbox.alert(r);
                return false;
            }
            
            var prev_div = 0;
            var result = true;
            if (agree_with_amendment)
            {
                $("input.size-ratio").each(function ()
                {
                    var v = $(this).val();
                    if (v)
                    {
                        v = parseFloat(v);
                        var _tr = $(this).closest("tr");
                        var amend_ratio = parseFloat(_tr.find(".amendment_ratio").html());
                        if (amend_ratio == 0)
                        {
                        }
                        if (v == 0)
                        {
                            if (amend_ratio != 0)
                            {
                                result = false;
                            }
                        }
                        else if (amend_ratio > 0)
                        {
                            var div = v / amend_ratio;
                            console.log("ratio :" + v + " amend_ratio : " + amend_ratio + " div : " + div);
                            if (prev_div && div && prev_div != div)
                            {
                                result = false;
                                console.log("false");
                            }
                            prev_div = div;
                        }
                    }
                });
            }
            
            if (!result)
            {
                bootbox.confirm({
                    message: "Amendment ratio is not equivalent to requested ratio",
                    buttons: {
                        confirm: {                            
                            label: 'I am not agree with Amendment',
                            className: 'btn-danger'
                        },
                        cancel: {
                            label: 'Ok',
                            className: 'btn-success'
                        }
                    },
                    callback: function (result) 
                    {
                        if (result)
                        {
                            agree_with_amendment = false;
                            $("form").trigger("submit");
                        }
                    }
                });
                
                return false;
            }
        });
    });
</script>
