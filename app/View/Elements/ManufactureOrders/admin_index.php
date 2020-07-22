<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 7%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> Location </th>
                    <th> Product Group </th>
                    <th> Batches </th>
                    <th> Qty </th>
                    <th style="width : 20%;"> Size & color </th>
                    <th> Allow For Pick </th>
                    <th> Info </th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= isset( $location_list[$record[$model]['location_id']] ) ? $location_list[$record[$model]['location_id']] : "-"; ?></td>
                    <td><?= isset( $product_group_list[$record[$model]['product_group_id']] ) ? $product_group_list[$record[$model]['product_group_id']] : "-"; ?></td>
                    <td><?= $record[$model]['batches']; ?></td>
                    <td>
                        Request Qty : <b><?= $record[$model]['qty']; ?></b> <br/>
                        Cut Qty : <b><?= $record[$model]['cut_qty']; ?></b> <br/>
                        Batch Qty : <b><?= $record[$model]['batch_qty']; ?></b> <br/>
                    </td>
                    <td>
                        <b>Size</b><br/>
                        <?= $record[$model]['sizes']; ?>
                        
                        <br/><br/>
                        <b>Color</b><br/>
                        <?= $record[$model]['colors']; ?>
                    </td>
                    <td>
                        <?php if ($record[$model]["is_distribute"]): ?>
                            <span class="label label-info"> Allowed For Pick </span>
                            <br/><br/>
                            Picked By : <?= isset( $user_list[$record[$model]['picked_by']] ) ? $user_list[$record[$model]['picked_by']] : "-"; ?>
                        <?php else :
                                $url = $this->Html->url(array("action" => "ajaxManufactureOrderDistribute", $record[$model]["id"], "admin" => false));
                            ?>
                            <a href="<?= $url ?>" class="manufacture-order-distribute">Allow For Pick Now</a>
                        <?php endif; ?>
                        
                    </td>
                    <td>
                        Order Placed On : <b><?= DateUtility::getDate($record[$model]['created'], DateUtility::DATE_OUT_FORMAT); ?></b><br/>
                        Order Placed By : <b><?= isset( $user_list[$record[$model]['created_by']] ) ? $user_list[$record[$model]['created_by']] : "-"; ?></b><br/>
                        <br/>
                        First Cut Approve On : <b><?= $record[$model]['first_cut_approve_datetime'] ? DateUtility::getDate($record[$model]['first_cut_approve_datetime'], DateUtility::DATE_OUT_FORMAT) : "-"; ?></b><br/>
                        First Cut Approve By : <b><?= isset( $user_list[$record[$model]['first_cut_approve_by']] ) ? $user_list[$record[$model]['first_cut_approve_by']] : "-"; ?></b><br/>
                        Bundle Complete On : <b><?= $record[$model]['bundle_complete_datetime'] ? DateUtility::getDate($record[$model]['bundle_complete_datetime'], DateUtility::DATE_OUT_FORMAT) : "-"; ?></b><br/>
                        <br/>
                        Order Completed : 
                        <?php if($record[$model]['is_completed']): ?>
                            <span class="label label-success"> Yes </span>
                            <br/>
                            Order Completed On : <b><?= $record[$model]['complete_datetime'] ? DateUtility::getDate($record[$model]['complete_datetime'], DateUtility::DATE_OUT_FORMAT) : "-"; ?></b><br/>
                            Order Completed By : <b><?= isset( $user_list[$record[$model]['completed_by']] ) ? $user_list[$record[$model]['completed_by']] : "-"; ?></b>
                        <?php else : ?>
                            <span class="label label-danger"> No </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a class="fancybox-ajax" href="<?= $this->Html->url(array("action" => "admin_view_comments" , $record[$model]['id'])); ?>">View Comments</a><br/>
                        <a target="_blank" href="<?= $this->Html->url(array("action" => "admin_add_comment" , $record[$model]['id'])); ?>" class="summary-link">
                            Add Comment
                        </a> <br/>
                            
                        <a target="_blank" href="<?= $this->Html->url(array("action" => "admin_add_manufacture_target" , $record[$model]['id'])); ?>" class="summary-link">
                            Set Target
                        </a> <br/>
                        
                        <?php if ($record[$model]['picked_by'] > 0 ) : ?>
                        <a target="_blank" href="<?= $this->Html->url(array("action" => "admin_product_consumption" , $record[$model]['id'])); ?>" class="summary-link">
                            Product Consumption
                        </a><br/>
                        <?php endif ; ?>
                        
                        <br/>
                        
                        <?php if (!$record[$model]["is_completed"]): ?>
                            <?php if ($record[$model]['is_cancel']) : ?>
                                <span class="label label-danger">Canceled</span>
                            <?php else : ?>
                                <a href="<?= $this->Html->url(array("action" => "admin_cancel" , $record[$model]['id'])); ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Cancel ?">
                                    Cancel Now
                                </a>
                            <?php endif ; ?>
                        
                            <br/> <br/>
                        <?php endif ; ?>
                        
                        <a href="<?= $this->Html->url(array("action" => "admin_view" , $record[$model]['id'])); ?>" title="View" class="summary-link">
                            <i class="fa fa-eye icon green-meadow"></i>
                        </a>
                        <?php if (!$record[$model]["is_completed"]): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>
                            
                        <?php endif; ?>
                            
                        <a class="summary-link" target="_BLANK" href="<?= $this->Html->url(array("action" => "pdf", $record[$model]['id'])) ?>">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>

<script type="text/javascript">
$(document).ready(function()
{
    $("a.manufacture-order-distribute").click(function()
    {
        var _td = $(this).parent();
        var href = $(this).attr("href");

        bootbox.confirm({
             message: "Are you sure. This step can not be undo",
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
                     $.get(href, function(response)
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
                         
                         if (response["status"] == "1")
                         {
                             _td.html('<span class="label label-info"> Allowed For Pick </span>');
                         }
                         else
                         {
                             bootbox.alert(response["msg"]);
                         }
                     });
                 }
             }
         });

        return false;
    });
});
</script>