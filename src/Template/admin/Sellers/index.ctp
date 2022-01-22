<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seller[]|\Cake\Collection\CollectionInterface $sellers
 */
?>
<div class="customers col-md-12 col-12 content">
    <h3><?= __('Sellers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('products') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('password') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('created') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modified') ?></th> -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php  foreach ($sellers as $key => $seller): ?>
                <?php $couont = 0; ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= h($seller->name) ?></td>
                <td><?= count($seller->products) ? $this->Html->link(count($seller->products) , ['controller' => 'products', 'action' => 'index',  $seller->id]): '0' ?></td>
                <!-- <td><?= count($seller->products) ?></td> -->
                <td><?= h($seller->email) ?></td>
                <td><?= h($seller->status) ?></td>
                <!-- <td><?= h($seller->password) ?></td> -->
                <!-- <td><?= h($seller->created) ?></td> -->
                <!-- <td><?= h($seller->modified) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $seller->id]) ?> |
                    <?php if($seller->status != 'active'){ ?>
                        <?= $this->Html->link(__('Active'), ['action' => 'active', $seller->id]) ?> |
                    <?php } ?>
                    <?php if($seller->status != 'pending'){ ?>
                        <?= $this->Html->link(__('Pending'), ['action' => 'pending', $seller->id]) ?> |
                    <?php } ?>
                    <?php if($seller->status != 'blocked'){ ?>
                        <?= $this->Html->link(__('Block'), ['action' => 'blocked', $seller->id]) ?> |
                    <?php } ?>
                    <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $seller->id]) ?> -->
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $seller->id], ['confirm' => __('Are you sure you want to delete # {0}?', $seller->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
