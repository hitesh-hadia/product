<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Addres[]|\Cake\Collection\CollectionInterface $address
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Addres'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="address index large-9 medium-8 columns content">
    <h3><?= __('Address') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('full_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('mobile_no') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pin_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('house_no_building') ?></th>
                <th scope="col"><?= $this->Paginator->sort('area') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lendmark') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state') ?></th>
                <th scope="col"><?= $this->Paginator->sort('country') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($address as $addres): ?>
            <tr>
                <td><?= $this->Number->format($addres->id) ?></td>
                <td><?= $addres->has('customer') ? $this->Html->link($addres->customer->name, ['controller' => 'Customers', 'action' => 'view', $addres->customer->id]) : '' ?></td>
                <td><?= h($addres->type) ?></td>
                <td><?= h($addres->full_name) ?></td>
                <td><?= $this->Number->format($addres->mobile_no) ?></td>
                <td><?= $this->Number->format($addres->pin_code) ?></td>
                <td><?= h($addres->house_no_building) ?></td>
                <td><?= h($addres->area) ?></td>
                <td><?= h($addres->lendmark) ?></td>
                <td><?= h($addres->city) ?></td>
                <td><?= h($addres->state) ?></td>
                <td><?= h($addres->country) ?></td>
                <td><?= h($addres->created) ?></td>
                <td><?= h($addres->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $addres->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $addres->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $addres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $addres->id)]) ?>
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
