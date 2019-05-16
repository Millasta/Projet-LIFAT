<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Thesis Entity
 *
 * @property int $id
 * @property string $sujet
 * @property string|null $type
 * @property \Cake\I18n\FrozenDate|null $date_debut
 * @property \Cake\I18n\FrozenDate|null $date_fin
 * @property string|null $signature
 * @property string|null $autre_info
 * @property bool|null $est_hdr
 * @property int|null $financement_id
 * @property int|null $auteur_id
 *
 * @property \App\Model\Entity\Membre $membre
 * @property \App\Model\Entity\Financement $financement
 * @property \App\Model\Entity\Dirigeant[] $dirigeants
 * @property \App\Model\Entity\Encadrant[] $encadrants
 */
class These extends Entity
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
        'sujet' => true,
        'type' => true,
        'date_debut' => true,
        'date_fin' => true,
        'autre_info' => true,
		'est_hdr' => true,
		'financement_id' => true,
        'auteur_id' => true,
		'financement' => true,
        'membre' => true,
        'dirigeants' => true,
        'encadrants' => true
    ];
}
