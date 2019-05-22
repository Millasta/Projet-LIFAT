<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fichier Entity
 *
 * @property int $id
 * @property string $nom
 * @property string|null $titre
 * @property string|null $description
 * @property \Cake\I18n\FrozenDate|null $date_upload
 * @property int|null $membre_id
 *
 * @property \App\Model\Entity\Membre $membre
 */
class Fichier extends Entity
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
        'nom' => true,
        'titre' => true,
        'description' => true,
        'date_upload' => true,
        'membre_id' => true,
        'membre' => true
    ];
}
