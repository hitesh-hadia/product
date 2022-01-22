<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seller $seller
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sellers'), ['action' => 'index']) ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $seller->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $seller->id)]
            )
        ?></li>
    </ul>
</nav> -->
<div class="sellers form large-12 medium-12 columns content">
    <?= $this->Form->create($seller) ?>
    <fieldset>
        <legend><?= __('Edit Seller') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            $status = ['active' => 'Active', 'pending ' => 'Pending ', 'blocked' => 'Block'];
            echo $this->Form->control('status',['options' => $status]);
            // echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
