<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Saque Entity
 *
 * @property int $id
 * @property int|null $bank_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property float|null $value
 *
 * @property \App\Model\Entity\Bank $bank
 */
class Saque extends Entity
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
        'bank_id' => true,
        'user_id' => true,
        'created' => true,
        'date_saque' => true,
        'hour_saque' => true,
        'value' => true,
        'bank' => true
    ];
}
