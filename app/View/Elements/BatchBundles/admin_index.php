<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 15%;"> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th style="width : 10%;">Batch </th>
                    <th style="width : 12%;">Barcode </th>
                    <th style="width : 10%;">Size </th>
                    <th style="width : 15%;">Color </th>
                    <th style="width : 10%;">Product </th>
                    <th style="width : 10%;">Qty </th>
                    <th> Download </th>
                    <th style="width : 15%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>                    
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $batch_list[$record[$model]['batch_id']]; ?></td>
                    <td><?= $record[$model]['barcode']; ?></td>
                    <td><?= isset($type_list[$record[$model]['size_type_id']]) ? $type_list[$record[$model]['size_type_id']] : "-" ; ?></td>
                    <td><?= isset($type_list[$record[$model]['color_type_id']]) ? $type_list[$record[$model]['color_type_id']] : "-"; ?></td>
                    <td><?= isset($product_list[$record[$model]['product_id']]) ? $product_list[$record[$model]['product_id']] : "-"; ?></td>
                    <td><?= $record[$model]['qty']; ?></td>
                    <td style="text-align: left;">
                        <?php if ($record[$model]["batch_bundle_serial_code_qty"] > 0) : 
                        ?>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-download"></i> MRP Pdf
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a class="download-mrp-pdf" 
                                              data-batch_id="<?= $record[$model]['batch_id'] ?>"
                                              data-batch_bundle_id="<?= $record[$model]['id'] ?>"
                                              data-party_id="0"
                                              data-qty="<?= $record[$model]["batch_bundle_serial_code_qty"] ?>"
                                            >
                                            Default
                                        </a>
                                    </li>
                                    <?php foreach($party_list as $party_id => $party_name) : ?>
                                    <li>
                                        <a class="download-mrp-pdf" 
                                              data-batch_id="<?= $record[$model]['batch_id'] ?>"
                                              data-batch_bundle_id="<?= $record[$model]['id'] ?>"
                                              data-party_id="<?= $party_id ?>"
                                              data-qty="<?= $record[$model]["batch_bundle_serial_code_qty"] ?>"
                                            >
                                            <?= $party_name ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Copy" class="summary-link">
                            <i class="fa fa-clone icon font-green-meadow"></i>
                        </a>
                        
                        <?php if ($record[$model]["batch_bundle_serial_code_qty"] <= 0): ?>
                            <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                            <a href="<?= $url; ?>" title="Edit" class="summary-link">
                                <i class="fa fa-edit icon blue-madison"></i>
                            </a>
                        <?php endif; ?>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
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
        function open_window(url, delay)
        {
            setTimeout(function()
            {
                window.open(url);
            }, delay);
        }
        
        $(".download-mrp-pdf").click(function()
        {
            var batch_id = $(this).data("batch_id");
            var batch_bundle_id = $(this).data("batch_bundle_id");
            var party_id = $(this).data("party_id");
            var qty = parseInt($(this).data("qty"));
            
            var page = 1;
            while (qty > 0)
            {                
                var url = "/admin/Batches/download_mrp_pdf/" + batch_id + "/" + party_id + "/" + batch_bundle_id + "/" + page;
                open_window(url, (page - 1) * 500);
                qty -= 100;
                page++;
            }
        });
    });
</script>