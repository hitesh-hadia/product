<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Addres $addres
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $addres->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $addres->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Address'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="address form large-9 medium-8 columns content">
    <?= $this->Form->create($addres) ?>
    <fieldset>
        <legend><?= __('Edit Addres') ?></legend>
        <?php
            // echo $this->Form->control('customer_id', ['options' => $customers]);
            $type = ['Office' => 'Office', 'Home ' => 'Home '];
            echo $this->Form->control('type',['options' => $type]);
            // echo $this->Form->control('type');
            echo $this->Form->control('full_name');
            echo $this->Form->control('mobile_no');
            echo $this->Form->control('pin_code');
            echo $this->Form->control('house_no_building');
            echo $this->Form->control('area');
            echo $this->Form->control('lendmark');
            echo $this->Form->control('city');
            echo $this->Form->control('state');
            echo $this->Form->control('country');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
