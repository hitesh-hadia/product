<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property int $seller_id
 * @property string $name
 * @property string $brand
 * @property int $mrp
 * @property int $price
 * @property string $color
 * @property string $modelname
 * @property string $form_factor
 * @property string $certification
 * @property string $description
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Seller $seller
 */
class Product extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'seller_id' => true,
        'name' => true,
        'brand' => true,
        'mrp' => true,
        'price' => true,
        'color' => true,
        'modelname' => true,
        'form_factor' => true,
        'certification' => true,
        'description' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'seller' => true,
        'category_id' => true,
        'sub_category_id' => true,
    ];
}
