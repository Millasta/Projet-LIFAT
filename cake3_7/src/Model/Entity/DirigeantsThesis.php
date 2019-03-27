<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DirigeantsThesis Entity
 *
 * @property int $dirigeant_id
 * @property int $these_id
 *
 * @property \App\Model\Entity\Dirigeant $dirigeant
 * @property \App\Model\Entity\Thesis $thesis
 */
class DirigeantsThesis extends Entity
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
        'dirigeant' => true,
        'thesis' => true
    ];
}
