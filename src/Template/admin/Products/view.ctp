<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
    </ul>
</nav> -->
<div class="customers col-md-12 col-12 content">
    <h3><?= h($product->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <!-- <tr>
            <th scope="row"><?= __('Seller') ?></th>
            <td><?= $product->has('seller') ? $this->Html->link($product->seller->name, ['controller' => 'Sellers', 'action' => 'view', $product->seller->id]) : '' ?></td>
        </tr> -->
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand') ?></th>
            <td><?= h($product->brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Color') ?></th>
            <td><?= h($product->color) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Category') ?></th>
            <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sub Category') ?></th>
            <td><?= $product->has('sub_category') ? $this->Html->link($product->sub_category->name, ['controller' => 'SubCategories', 'action' => 'view', $product->sub_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modelname') ?></th>
            <td><?= h($product->modelname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Factor') ?></th>
            <td><?= h($product->form_factor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Certification') ?></th>
            <td><?= h($product->certification) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Mrp') ?></th>
            <td><?= getCurrencyFormated($product->mrp)?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= getCurrencyFormated($product->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4 style="display: block;width: 100%"><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>
    <div class="row">
        <h4 style="display: block;width: 100%; "><?= __('Product Image') ?></h4>
            <?php if($product->product_images){ ?>
                <?php foreach ($product->product_images as $productImage) { ?>
                    <div class="col-md-3">
                        <?php $path = '/'.WWW_ROOT.'img/product_images'; ?>
                        <a href="/product/webroot/img/product_images/<?= $productImage['image']; ?>" target='_blank' ><img src='/product/webroot/img/product_images/<?= $productImage['image']; ?>' style=" height: 300px; width: 100%"></a>
                    </div>
                <?php } ?>
            <?php } ?>
    </div>
</div>
