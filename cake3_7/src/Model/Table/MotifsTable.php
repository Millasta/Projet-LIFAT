<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Motifs Model
 *
 * @property \App\Model\Table\MissionsTable|\Cake\ORM\Association\HasMany $Missions
 *
 * @method \App\Model\Entity\Motif get($primaryKey, $options = [])
 * @method \App\Model\Entity\Motif newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Motif[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Motif|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motif saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Motif patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Motif[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Motif findOrCreate($search, callable $callback = null, $options = [])
 */
class MotifsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('motifs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Missions', [
            'foreignKey' => 'motif_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('nom_motif')
            ->maxLength('nom_motif', 60)
            ->allowEmptyString('nom_motif');

        $validator
            ->boolean('est_dans_liste')
            ->allowEmptyString('est_dans_liste');

        return $validator;
    }
}
