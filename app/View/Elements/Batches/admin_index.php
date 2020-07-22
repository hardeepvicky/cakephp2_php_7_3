<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 5%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th style="width : 15%;">Category</th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th style="width : 8%;">Style</th>     
                    <th style="width : 8%;">Qty</th>
                    <th style="width : 8%;">Reconcile</th>
                    <th>Download</th>
                    <th style="width : 15%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>                    
                    <td><?= $category_list[$record[$model]['category_id']]; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $type_list[$record[$model]['style_type_id']]; ?></td>
                    <td><?= $record[$model]["qty"] ?></td>
                    <td>
                        <?php if ($record[$model]["is_complete"]): ?>
                            <span class="label label-success">Yes</span>
                        <?php else: ?>
                            <span class="label label-danger">No</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($record[$model]["qty"] > 0) : 
                                $barcode_file = "files/Batch/barcode_" . $record[$model]["id"] . ".pdf"; 
                                $barcode_small_file = "files/Batch/barcode_small_" . $record[$model]["id"] . ".pdf"; 
                        ?>
                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <?php if (file_exists($barcode_file)): ?>
                                    <a href="/<?= $barcode_file ?>" title="Download" class="btn btn-default" download>
                                        <i class="fa fa-download"></i> Barcode
                                    </a>
                                    <?php endif; ?>
                                    <br/>
                                    <?php if (file_exists($barcode_small_file)): ?>
                                    <a href="/<?= $barcode_small_file ?>" title="Download" class="btn btn-default" download>
                                        <i class="fa fa-download"></i> Small Barcode
                                    </a>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="col-md-3 col-sm-12">
                                    <?php $url = $this->Html->url(array("action" => "admin_download_bundle_pdf", $record[$model]['id'])); ?>
                                    <a href="<?= $url; ?>" title="Download" class="btn btn-default" target="_BLANK">
                                        <i class="fa fa-download"></i> Bundle
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="dropdown">
                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-download"></i> MRP
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a class="download-mrp-pdf" 
                                                      data-batch_id="<?= $record[$model]['id'] ?>"
                                                      data-party_id="0"
                                                      data-qty="<?= $record[$model]["qty"] ?>"
                                                    >
                                                    Default
                                                </a>
                                            </li>
                                            <?php foreach($party_list as $party_id => $party_name) : ?>
                                            <li>
                                                <a class="download-mrp-pdf" 
                                                      data-batch_id="<?= $record[$model]['id'] ?>" 
                                                      data-party_id="<?= $party_id ?>"
                                                      data-qty="<?= $record[$model]["qty"] ?>"
                                                    >
                                                    <?= $party_name ?>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_copy", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Copy" class="summary-link">
                            <i class="fa fa-clone icon font-green-meadow"></i>
                        </a>
                        
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>

                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        
                        <?php if ($record[$model]["qty"] > 0) : ?>
                        
                        <?php endif; ?>
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
            var party_id = $(this).data("party_id");
            var qty = parseInt($(this).data("qty"));
            var page = 1;
            while (qty > 0)
            {
                var url = "/admin/Batches/download_mrp_pdf/" + batch_id + "/" + party_id + "/0/" + page;
                open_window(url, (page - 1) * 500);
                qty -= 100;
                page++;
            }
        });
    });
</script>