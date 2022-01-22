<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cart[]|\Cake\Collection\CollectionInterface $carts
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cart'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav -->
<style type="text/css">
td .add-dec-btn{
    background-color: #fff;
    color: #000;
    padding: 5px 10px;
    font-size: 17px;
    border: 1px solid #d5d5d5;
    border-radius: 5px;
    margin: 0 3px 15px;
    min-width: 32px;
    display: inline-block;
    cursor: pointer;
}
</style>
<div class="carts index large-12 medium-12 columns content">
    <h3><?= __('Carts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('id') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('created') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modified') ?></th> -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($carts as $key=> $cart): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <!-- <td><?= $this->Number->format($cart->id) ?></td> -->
                <!-- <td><?= h($cart->customer->name) ?></td> -->
                <td><?= h($cart->product->name) ?></td>
                <td class="btn-gro"><i class="add-dec-btn" data-id='<?php echo $cart->id; ?>' data-operation='decrement'id='decrement'>-</i><span style="padding: 0 5px; margin: 0 5px"><?= $this->Number->format($cart->quantity) ?></span><i class="add-dec-btn" data-id='<?php echo $cart->id; ?>' data-operation='increment'id='increment'>+</i></td>
                <td class="cart-amount"><?= getCurrencyFormated($cart->amount) ?></td>
                <!-- <td><?= h($cart->created) ?></td> -->
                <!-- <td><?= h($cart->modified) ?></td> -->
                <td class="actions">
                    <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $cart->id]) ?> -->
                    <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cart->id]) ?> -->
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cart->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cart->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php if(count($carts) != 0): ?>
        <?= $this->Html->link(__('Buy Now'), ['controller' => 'Orders', 'action' => 'checkout']) ?>
    <?php endif ?>
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
<?php
    echo $this->Html->script('cart');
?>