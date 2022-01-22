<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SubCategory $subCategory
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sub Category'), ['action' => 'edit', $subCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sub Category'), ['action' => 'delete', $subCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sub Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sub Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
    </ul>
</nav> -->
<div class="subCategories view col-md-12 col-12 content">
    <h3><?= h($subCategory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($subCategory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $subCategory->has('category') ? $this->Html->link($subCategory->category->name, ['controller' => 'Categories', 'action' => 'view', $subCategory->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($subCategory->name) ?></td>
        </tr>
        <!-- <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($subCategory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($subCategory->modified) ?></td>
        </tr> -->
    </table>
</div>
