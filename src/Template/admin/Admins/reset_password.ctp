<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users form large-12 medium-12 columns content">
     <?= $this->Form->create('user') ?>
    <fieldset>
        <legend><?= __('Reset Password') ?></legend>
        <?php
            echo $this->Form->control('current_password',['type' => 'password']);
            echo $this->Form->control('password',['type' => 'password']);
            echo $this->Form->control('confirm_password',['type' => 'password']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>