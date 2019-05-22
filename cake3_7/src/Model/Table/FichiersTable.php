<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fichiers Model
 *
 * @property \App\Model\Table\MembresTable|\Cake\ORM\Association\BelongsTo $Membres
 *
 * @method \App\Model\Entity\Fichier get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fichier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fichier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fichier|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fichier saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fichier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fichier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fichier findOrCreate($search, callable $callback = null, $options = [])
 */
class FichiersTable extends Table
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

        $this->setTable('fichiers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Membres', [
            'foreignKey' => 'membre_id'
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
            ->scalar('nom')
            ->maxLength('nom', 100)
            ->requirePresence('nom', 'create')
            ->allowEmptyString('nom', false)
            ->add('nom', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('titre')
            ->maxLength('titre', 100)
            ->allowEmptyString('titre');

        $validator
            ->scalar('description')
            ->maxLength('description', 500)
            ->allowEmptyString('description');

        $validator
            ->date('date_upload')
            ->allowEmptyDate('date_upload');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['nom']));
        $rules->add($rules->existsIn(['membre_id'], 'Membres'));

        return $rules;
    }
}
