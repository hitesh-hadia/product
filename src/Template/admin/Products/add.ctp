<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
    </ul>
</nav> -->
<div class="products form large-12 medium-12 columns content">
    <?= $this->Form->create($product, ['enctype' => "multipart/form-data"]) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('brand');
            echo $this->Form->control('mrp');
            echo $this->Form->control('price');
            echo $this->Form->control('color');
            echo $this->Form->control('modelname');
            echo $this->Form->control('form_factor');
            echo $this->Form->control('certification');
            echo $this->Form->input('image[]', ['type' => 'file', 'multiple' => 'true', 'label' => 'image']);
            echo $this->Form->control('description');
            echo $this->Form->control('category_id', ['options' => $categories]);
        ?>
        <label for="sub_category">Sub Category</label>
        <select id="sub_category" name="sub_category_id">
            
        </select>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
<?php
    echo $this->Html->script('product');
?>

