<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav> -->
<style type="text/css">
::-webkit-scrollbar {
  width: 0px;
}
</style>
<div class="products index large-12 medium-12 columns content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <th scope="col"><?= $this->Paginator->sort('image') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('color') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('id') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('mrp') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modelname') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('form_factor') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('certification') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('created') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modified') ?></th> -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $key=> $product): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td style="height: 200px; overflow-y: auto;  overflow-x: hidden; display: block;">
                    <?php foreach ($product->product_images as $key => $image) { ?>
                        <a href="/product/webroot/img/product_images/<?=$image->image ?>" target='_blank'><img src='/product/webroot/img/product_images/<?=$image->image ?>' style=" width: 200px; margin: 3px"></a>
                    <?php } ?>
                </td>
                <td><?= h($product->name) ?></td>
                <td><?= h($product->brand) ?></td>
                <td><?= getCurrencyFormated($product->price) ?></td>
                <td><?= h($product->color) ?></td>
                <!-- <td><?= $this->Number->format($product->id) ?></td> -->
                <!-- <td><?= getCurrencyFormated($product->mrp) ?></td> -->
                <!-- <td><?= h($product->modelname) ?></td> -->
                <!-- <td><?= h($product->form_factor) ?></td> -->
                <!-- <td><?= h($product->certification) ?></td> -->
                <!-- <td><?= h($product->created) ?></td> -->
                <!-- <td><?= h($product->modified) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('Add To Cart'), ['controller' => 'Carts', 'action' => 'add_to_cart', $product->id]) ?>
                    <!-- <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?> -->
                    <!-- <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?> -->
                    <!-- <?= $this->Html->link(__('Duplicate'), ['action' => 'duplicate', $product->id]) ?> -->
                    <!-- <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> -->
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
