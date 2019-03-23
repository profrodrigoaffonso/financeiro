<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bank Entity
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property bool|null $correntista
 *
 * @property \App\Model\Entity\Saque[] $saques
 */
class Bank extends Entity
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
        'code' => true,
        'name' => true,
        'correntista' => true,
        'saques' => true
    ];
}
