<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order[]|\Cake\Collection\CollectionInterface $orders
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav> -->
<div class="orders index large-12 medium-12 columns content">
    <h3><?= __('Orders') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('id') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('razorpay_signature') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Order Date') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('created') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modified') ?></th> -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $key=> $order): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <!-- <td><?= $this->Number->format($order->id) ?></td> -->
                <td><?= $order->has('customer') ? $this->Html->link($order->customer->name, ['controller' => 'Customers', 'action' => 'view', $order->customer->id]) : '' ?></td>
                <td><?= h($order->transaction_id) ?></td>
                <td><?= h($order->order_id) ?></td>
                <td><?= h($order->razorpay_signature) ?></td>
                <td><?php echo date("d/m/Y", strtotime($order->created));?></td>
                <!-- <td><?= h($order->created) ?></td> -->
                <!-- <td><?= h($order->modified) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'OrderDetails','action' => 'orderdetails', $order->id]) ?>
                    <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $order->id]) ?> -->
                    <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $order->id], ['confirm' => __('Are you sure you want to delete # {0}?', $order->id)]) ?> -->
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
