<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<nav class="col-12 col-md-12" id="actions-sidebar" style="text-align: right;">
    <ul class="side-nav">
        <!-- <li class="heading"><?= __('Actions') ?></li> -->
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<!--<nav class="col-md-12 col-12">
     <form action="/product/admin/products/" >
        <div class="row">
            <div class="col-2 form-group">
                <label for="sellername"> Seller Name</label>
                <input type="text" name="sellername" class="form-control" id="sellername" placeholder="Seller Name">
            </div>
            <div class="col-2 form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="col-2 form-group">
                <label for="Brand">Brand</label>
                <input type="text" name="brand" class="form-control" id="Brand" placeholder="Brand">
            </div>
            <div class="col-2 form-group">
                <label for="status">status</label>
                <select>
                    <option value=""> All </option>
                    <option value="active"> Active </option>
                    <option value="pending"> Pending </option>
                    <option value="blocked"> Block </option>
                </select>
            </div>
            <div class="col-2 form-group">
                <input type="submit" name="submit" class="form-control" value="submit">
            </div>
        </div>
    </form>
</nav> -->
<div class="customers col-md-12 col-12 content">
    <h3><?= __('Products') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('#') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('seller_id') ?></th> -->
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('brand') ?></th>
                <th scope="col"><?= $this->Paginator->sort('category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sub_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <!-- <th scope="col"><?= $this->Paginator->sort('mrp') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('price') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('color') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modelname') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('form_factor') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('certification') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('created') ?></th> -->
                <!-- <th scope="col"><?= $this->Paginator->sort('modified') ?></th> -->
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $key => $product): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <!-- <td><?= $product->has('seller') ? $this->Html->link($product->seller->name, ['controller' => 'Sellers', 'action' => 'view', $product->seller->id]) : '' ?></td> -->
                <td><?= h($product->name) ?></td>
                <td><?= h($product->brand) ?></td>
                <td><?= $product->has('category') ? $this->Html->link($product->category->name, ['controller' => 'Categories', 'action' => 'view', $product->category->categorie_id]) : '' ?></td>
                <td><?= $product->has('sub_category') ? $this->Html->link($product->sub_category->name, ['controller' => 'SubCategories', 'action' => 'view', $product->sub_category->id]) : '' ?></td>
                <td><?= h($product->status) ?></td>
                <!-- <td><?= $this->Number->format($product->mrp) ?></td> -->
                <!-- <td><?= $this->Number->format($product->price) ?></td> -->
                <!-- <td><?= h($product->color) ?></td> -->
                <!-- <td><?= h($product->modelname) ?></td> -->
                <!-- <td><?= h($product->form_factor) ?></td> -->
                <!-- <td><?= h($product->certification) ?></td> -->
                <!-- <td><?= h($product->created) ?></td> -->
                <!-- <td><?= h($product->modified) ?></td> -->
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?> |
                    <!-- <?php if($product->status != 'active'){ ?>
                        <?= $this->Html->link(__('Active'), ['action' => 'active', $product->id]) ?> |
                    <?php } ?>
                    <?php if($product->status != 'pending'){ ?>
                        <?= $this->Html->link(__('Pending'), ['action' => 'pending', $product->id]) ?> |
                    <?php } ?>
                    <?php if($product->status != 'blocked'){ ?>
                        <?= $this->Html->link(__('Block'), ['action' => 'blocked', $product->id]) ?> |
                    <?php } ?> -->
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?> |
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
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
