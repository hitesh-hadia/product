<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="products form large-12 medium-12 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <h3><?= __('Razorpay') ?></h3>
        <!-- <legend><?= __('Razorpay') ?></legend> -->
        <?php
            $status = ['Decibel','Enable'];
            echo $this->Form->input('razorpay_status',['options' => $status,'label'=>'Status']);
            echo $this->Form->input('razorpay_key_id',['type' => 'text','label'=>'Key Id', 'value'=>$paymentSetings['razorpay_key_id']]);
            echo $this->Form->input('razorpay_key_secret',['value'=>$paymentSetings['razorpay_key_secret'],'label' => 'Key Secret']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>