<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubCategory[]|\Cake\Collection\CollectionInterface $subCategories
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar" style="text-align: right;">
    <ul class="side-nav">
         <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sub Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav> -->
<nav class="col-12 col-md-12" id="actions-sidebar" style="text-align: right;">
    <ul class="side-nav">
        <!-- <li class="heading"><?= __('Actions') ?></li> -->
        <li><?= $this->Html->link(__('New Sub Category'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="subCategories index col-md-12 col-12 content">
    <h3><?= __('Sub Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('categorie_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('created') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modified') ?></th> -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subCategories as $subCategory): ?>
            <tr>
                <td><?= $this->Number->format($subCategory->id) ?></td>
                <td><?= $subCategory->has('category') ? $this->Html->link($subCategory->category->name, ['controller' => 'Categories', 'action' => 'view', $subCategory->category->id]) : '' ?></td>
                <td><?= h($subCategory->name) ?></td>
                <!-- <td><?= h($subCategory->created) ?></td> -->
                <!-- <td><?= h($subCategory->modified) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $subCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subCategory->id)]) ?>
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
