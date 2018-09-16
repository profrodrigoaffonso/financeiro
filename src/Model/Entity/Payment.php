<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Payment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property float $value
 * @property int $form_payment_id
 * @property int $category_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\FormPayment $form_payment
 * @property \App\Model\Entity\Category $category
 */
class Payment extends Entity
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
        'user_id' => true,
        'value' => true,
        'form_payment_id' => true,
        'category_id' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'form_payment' => true,
        'date_payment' => true,
        'hour_payment' => true,
        'obs' => true,
        'category' => true
    ];
}
