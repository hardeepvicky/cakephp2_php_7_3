<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column" id="sample_1_2">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th> <?= $this->Paginator->sort('caption', __('Caption')); ?> </th>
                    <th> Details </th>
                    <th> Image </th>
                    <th style="width : 6%;"> Show on Home Page </th>
                    <th style="width : 6%;">Display Order</th>
                    <th style="width : 12%;"> Actions </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['caption']; ?></td>
                    <td><?= $record[$model]['detail']; ?></td>
                    <td>
                        <a href="/<?= $record[$model]['image']; ?>" class="fancybox">
                            <img src="/<?= $record[$model]['image']; ?>"  style="width: 150px;"/>
                        </a>
                    </td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_toggleShowOnHomePage", $record[$model]['id'])); ?>
                        <?php if ($url) : ?>
                            <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_on_home_page" data-value="<?= (int)$record[$model]['is_on_home_page'] ?>">
                                <i class="fa <?= $record[$model]['is_on_home_page'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                    <td><?= $record[$model]['display_order']; ?></td>
                    <td>
                        <?php $url = $this->Html->url(array("action" => "admin_edit", $record[$model]['id'])); ?>
                        <?php if ($url) : ?>
                        <a href="<?= $url; ?>" title="Edit" class="summary-link">
                            <i class="fa fa-edit icon blue-madison"></i>
                        </a>
                        <?php endif; ?>

                        <?php $url = $this->Html->url(array("action" => "admin_delete", $record[$model]['id'])); ?>
                        <?php if ($url) : ?>
                        <a href="<?= $url; ?>" class="summary-link" data-toggle="confirmation" data-singleton="true" data-popout="true" data-original-title="Are you sure to Delete ?">
                            <i class="fa fa-trash-o icon font-red-sunglo"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>
