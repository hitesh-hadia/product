<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderDetail[]|\Cake\Collection\CollectionInterface $orderDetails
 */
?>
<style type="text/css">
::-webkit-scrollbar {
  width: 0px;
}
</style>
<div class="orderDetails index large-9 medium-8 columns content">
    <h3><?= __('Order Details') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <!-- <th scope="col"><?= $this->Paginator->sort('Order Date') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('order_id') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('payment method') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('Billing Address') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('product_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $totalAmount = 0; foreach ($orderDetails as $key=> $orderDetail): ?>
            <tr>
                <!-- <td><?= h(substr($orderDetail->created, 0, 7)) ?></td> -->
                <!-- <td><?= $orderDetail->has('order') ? $this->Html->link($orderDetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderDetail->order->id]) : '' ?></td> -->
                <!-- <td><?php echo 'Razorpay'; ?></td> -->
                <!-- <td><?= h($orderDetail->order->address_id) ?></td> -->
                <td><?= $key + 1 ?></td>
                <td style="max-height: 100px; overflow-y: auto; display: block;">
                    <?php foreach ($orderDetail->product->product_images as $key => $image) { ?>
                        <a href="/product/webroot/img/product_images/<?=$image->image ?>" target='_blank' ><img src='/product/webroot/img/product_images/<?=$image->image ?>' style=" height: 100px; width: 100%; margin: 3px"></a>
                    <?php } ?>
                </td>
                <td><?= h($orderDetail->product->name) ?></td>
                <?php if($orderDetail->quantity != 1){ $price = $orderDetail->amount / $orderDetail->quantity;}else{ $price = $orderDetail->amount;} ?>
                <td><?= getCurrencyFormated($price) ?></td>
                <td><?= h($orderDetail->quantity) ?></td>
                <td><?= getCurrencyFormated($orderDetail->amount) ?></td>
            </tr>
            <?php $totalAmount = $totalAmount + $orderDetail->amount; 
                      $Address = $orderDetail->order->addres->type; 
                      $date = date("d/m/Y", strtotime($orderDetail->created));
                      $id = $orderDetail->has('order') ? $this->Html->link($orderDetail->order->id, ['controller' => 'Orders', 'action' => 'view', $orderDetail->order->id]) : ''; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
        
    <!-- <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div> -->
</div>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <table style="margin: 61px 0 10px;width: 100%;" cellpadding="0" cellspacing="0">
        <tr>
            <th colspan="2"> <h4> Order Summary </h4> </th>
        </tr>
        <tr>
            <th><?php echo 'Total Cost'; ?></th>
            <td style="text-align: right;"><?= getCurrencyFormated($totalAmount) ?></td>
        </tr>
        <tr>
            <th><?php echo 'Tax'; ?></th>
            <td style="text-align: right;"><?= getCurrencyFormated(0) ?></td>
        </tr>
        <tr>
            <th><?php echo 'Shipping'; ?></th>
            <td style="text-align: right;"><?= getCurrencyFormated(0) ?></td>
        </tr>
        <tr>
            <th><?php echo 'Total Order'; ?></th>
            <td style="text-align: right;"><?= getCurrencyFormated($totalAmount) ?></td>
        </tr>
    </table>
    <table style="margin:0 10px;width: 100%;" cellpadding="0" cellspacing="0">
        <tr>
            <th colspan="2"><h5> Other </h5></th>
        </tr>
        <tr>
            <th><?php echo 'Address'; ?></th>
            <td style="text-align: right;"><?= $Address ?></td>
        </tr>
        <tr>
            <th><?php echo 'Payment Method'; ?></th>
            <td style="text-align: right;"><?php echo 'Razorpay'; ?></td>
        </tr>
        <tr>
            <th><?php echo 'Order Date'; ?></th>
            <td style="text-align: right;"><?php echo $date; ?></td>
        </tr>
        <tr>
            <th><?php echo 'Order'; ?></th>
            <td style="text-align: right;"><?php echo $id; ?></td>
        </tr>
        
    </table>
</nav>
