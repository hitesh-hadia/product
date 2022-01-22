<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Addres $addres
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Addres'), ['action' => 'edit', $addres->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Addres'), ['action' => 'delete', $addres->id], ['confirm' => __('Are you sure you want to delete # {0}?', $addres->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Address'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Addres'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="address view large-9 medium-8 columns content">
    <h3><?= h($addres->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer') ?></th>
            <td><?= $addres->has('customer') ? $this->Html->link($addres->customer->name, ['controller' => 'Customers', 'action' => 'view', $addres->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($addres->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Full Name') ?></th>
            <td><?= h($addres->full_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('House No Building') ?></th>
            <td><?= h($addres->house_no_building) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Area') ?></th>
            <td><?= h($addres->area) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lendmark') ?></th>
            <td><?= h($addres->lendmark) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($addres->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= h($addres->state) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Country') ?></th>
            <td><?= h($addres->country) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($addres->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mobile No') ?></th>
            <td><?= $this->Number->format($addres->mobile_no) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pin Code') ?></th>
            <td><?= $this->Number->format($addres->pin_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($addres->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($addres->modified) ?></td>
        </tr>
    </table>
</div>
