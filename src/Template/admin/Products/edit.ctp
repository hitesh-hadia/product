<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $product->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
    </ul>
</nav> -->
<div class="products form large-12 medium-12 columns content">
    <?= $this->Form->create($product, ['enctype' => "multipart/form-data"]) ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            // echo $this->Form->control('seller_id', ['options' => $sellers]);
            echo $this->Form->control('name');
            echo $this->Form->control('brand');
            echo $this->Form->control('mrp');
            echo $this->Form->control('price');
            echo $this->Form->control('color');
            echo $this->Form->control('modelname');
            echo $this->Form->control('form_factor');
            echo $this->Form->control('certification');
            echo $this->Form->control('description');
            echo $this->Form->control('image[]', ['type' => 'file', 'multiple' => 'true', 'label' => 'image',]);
            $status = ['active' => 'Active', 'pending ' => 'Pending ', 'blocked' => 'Block'];
            echo $this->Form->control('status',['options' => $status]);
            echo $this->Form->control('category_id', ['options' => $categories]);
        ?>
        <input type="hidden" name="old_sub" id="old_sub" value="<?php echo $product->sub_category_id; ?>">
        <label for="sub_category">Sub Category</label>
        <select id="sub_category" name="sub_category_id">
            
        </select>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <br><br>
    <div class="row">
        <h4 style="display: block;width: 100%"><?= __('Product Image') ?></h4>
        <div class="row">
            <?php if($product->product_images){ ?>
                <?php foreach ($product->product_images as $productImage) { ?>
                    <div class="col-md-3" style="width: 20%; position: relative; padding: 15px">
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'imagedelete', $productImage->id , $productImage->product_id], ['confirm' => __('Are you sure you want to delete # {0}?', $productImage->id)]) ?>
                        <?php $path = '/'.WWW_ROOT.'img/product_images'; ?>
                        <img src='/product/webroot/img/product_images/<?= $productImage['image']; ?>' style="width: 100%;">
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php
    echo $this->Html->script('product');
?>