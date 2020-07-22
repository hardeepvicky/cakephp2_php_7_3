<?php if ($records):
    $field_list = ProductAttrTypes::getFieldList();
    foreach($records as $record):
        $field = $field_list[$record['product_field']];
    ?>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-4 col-xs-12"><?= ProductAttrTypes::$list[$record['product_field']] ?> 
        <?php if (!in_array($record['product_field'], ProductAttrTypes::$inputFields)): ?>
            <span>*</span>
        <?php endif;?>
            :
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <?php if (in_array($record['product_field'], ProductAttrTypes::$inputFields)): ?>
            <?= $this->Form->input("Product." . $field, array("div" => false, "label" => false, "escape" => false, "class" => "form-control sku-field", 'data-field' => $record['product_field'])); ?>
        <?php else: ?>
            <?php
                $attr = "";
                if (isset($this->request->data['Product'][$field]) && $this->request->data['Product'][$field] > 0 && $record['is_sku_field'])
                {
                    $attr .= " disabled='disabled' ";
                }
            ?>
        
            <select required="required" name="data[Product][<?= $field ?>]" class="form-control select2me sku-field" data-field="<?= $record['product_field'] ?>" <?= $attr ?>>
                <option value=""><?= DROPDOWN_EMPTY_VALUE ?></option>
                <?php if (isset($type_list[$record['product_field']])): ?>
                    <?php foreach($type_list[$record['product_field']] as $type): 

                        $attr = "data-code='" . $type['code'] . "'";
                        if (isset($this->request->data['Product'][$field]) && $type['id'] == $this->request->data['Product'][$field])
                        {
                            $attr .= " selected='selected'";
                        }
                    ?>
                        <option value="<?= $type['id'] ?>" <?= $attr ?> ><?= $type['name'] ?> (<?= $type['code'] ?>)</option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        <?php endif; ?>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function()
{
    App.initAjax();
});
</script>