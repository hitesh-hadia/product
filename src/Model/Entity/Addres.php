<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Addres Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $type
 * @property string $full_name
 * @property int $mobile_no
 * @property int $pin_code
 * @property string $house_no_building
 * @property string $area
 * @property string $lendmark
 * @property string $city
 * @property string $state
 * @property string $country
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Customer $customer
 */
class Addres extends Entity
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
        'customer_id' => true,
        'type' => true,
        'full_name' => true,
        'mobile_no' => true,
        'pin_code' => true,
        'house_no_building' => true,
        'area' => true,
        'lendmark' => true,
        'city' => true,
        'state' => true,
        'country' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
    ];
}
