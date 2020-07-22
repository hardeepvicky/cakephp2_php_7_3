<?php
$disabled = $action == "admin_edit" ? "disabled" : "";
?>

<link rel="stylesheet" type="text/css" href="/assets/global/plugins/summer-note/summernote.css"/>
<script type="text/javascript" src="/assets/global/plugins/summer-note/summernote.min.js"></script>

<div class="page-bar">
    <div class="row">
        <div class="col-md-9 pull-left">
            <?php echo $this->element("breadcum"); ?>
        </div>
        <div class="col-md-3 pull-right" style="text-align: right; margin-top: 4px;">
            <a href="<?= $this->Html->url(array("action" => "admin_index")); ?>" class="btn btn-circle blue-madison">
                <i class="fa fa-angle-left"></i> Back
            </a>
        </div>
    </div>
</div>

<?= $this->element("page_header", array("title" => "Email Template")); ?>

<?php echo $this->Session->flash(); ?>

<div class="form__structure">
    <?php
    echo $this->Form->create($model, array(
        'type' => 'file',
        "class" => "form-horizontal form-row-seperated",
        'inputDefaults' => array(
            'label' => false, 'div' => false, 'div' => false, "escape" => false,
            "class" => "form-control invalid-sql-char", "type" => "text"
        )
    ));

    echo $this->Form->hidden('id');
    ?>
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Type <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?=
                $this->Form->input('code', array(
                    "type" => "select",
                    "options" => StaticArray::$email_code_list,
                    "empty" => DROPDOWN_EMPTY_VALUE,
                    "class" => "form-control select2me"
                ));
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Subject <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $this->Form->input('subject', array("placeholder" => "Subject")); ?>
            </div>
        </div>

        <?php if ($disabled): ?>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Body <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?= $this->Form->textarea('body', array("id" => "body")); ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-4 col-xs-12">Placeholders <span>*</span> :</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <?=
                $this->Form->input('EmailTemplatePlaceholder.email_placeholder_id', array(
                    "type" => "select",
                    "options" => $placeholder_list,
                    "class" => "form-control select2me",
                    "multiple" => true,
                    $disabled
                ));
                ?>
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <div class="col-md-offset-4 col-md-8 col-sm-offset-4 col-sm-8 col-xs-12">
            <button type="submit" href="javascript:;" class="btn blue">Submit</button>
            <a class="btn grey" href="<?= $this->Html->url(array("action" => "admin_index")) ?>">Cancel</a>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
    var email_placeholder_list = JSON.parse('<?= json_encode(isset($email_placeholder_list) ? $email_placeholder_list : array()) ?>');
    $(document).ready(function()
    {
        $("#body").summernote({
            height: 350,
            placeholder: 'Type with @ to open placeholder list',
            hint: {
                words: email_placeholder_list,
                match: /\B@(\w*)$/,
                search: function(keyword, callback) 
                {
                    callback($.grep(this.words, function(item) 
                    {
                        return item.indexOf(keyword) === 0;
                    }));
                },
                content: function (item) 
                {
                    return '@' + item;
                }    
            }
        });
    });
</script>
