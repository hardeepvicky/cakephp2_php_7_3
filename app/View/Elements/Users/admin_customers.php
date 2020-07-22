<div class="table__structure">
    <?= $this->element("pagination", array("with_info" => true)) ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered order-column">
            <thead>
                <tr>
                    <th style="width : 10%;"> <?= $this->Paginator->sort('id', __('Id')); ?> </th>
                    <th> <?= $this->Paginator->sort('name', __('Name')); ?> </th>
                    <th> <?= $this->Paginator->sort('username', __('Username')); ?> </th>
                    <th> <?= $this->Paginator->sort('mobile_no', __('Mobile')); ?> </th>
                    <th style="width : 8%;"> <?= $this->Paginator->sort('is_confirm', __('Confirm')); ?> </th>
                    <th style="width : 20%;" colspan="2"> <?= $this->Paginator->sort('is_active', __('Status')); ?> </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $record): ?>
                <tr class="odd gradeX center">
                    <td><?= $record[$model]['id']; ?></td>
                    <td><?= $record[$model]['name']; ?></td>
                    <td><?= $record[$model]['username']; ?></td>
                    <td>
                        <?php if ($record[$model]['mobile_no']) : ?>
                            <?= $record[$model]['is_mobile_confirm']; ?> 
                            <?php if ($record[$model]['is_confirm']): ?>
                                <span class="label label-success">Verified</span> 
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($record[$model]['is_confirm']): ?>
                            <span class="label label-success">Yes</span> 
                        <?php else: ?>
                            <span class="label label-danger">No</span> 
                        <?php endif; ?>
                    </td>
                    <td>
                        <label class="label label-info">Wallet : <span class="wallet-money"> <?= $record[$model]["wallet"] ?></span></label> <br/>
                        <?php $url = $this->Html->url(array("action" => "admin_customerAddWalletMoney", $record[$model]['id'])); ?>
                        <a class="wallet-modal-open" href="<?= $url ?>" data-customer_name="<?= $record[$model]['name']; ?>">Add Money to Wallet</a>
                    </td>
                    <td>
                       <?php $url = $this->Html->url(array("action" => "admin_customerActiveToggle", $record[$model]['id'])); ?>
                        <a href="<?= $url; ?>" class="toggle-tinyfield" data-field="is_active" data-value="<?= (int)$record[$model]['is_active'] ?>">
                            <i class="fa <?= $record[$model]['is_active'] ? "fa-check-circle-o font-green-meadow icon" : "fa-times-circle-o font-red-sunglo icon" ?>"></i>
                        </a>
                    </td>
                </tr>                
                <?php endforeach; ?>            
            </tbody>
        </table>
    </div>
    <?= $this->element("pagination") ?>
</div>