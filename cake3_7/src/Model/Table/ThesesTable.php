<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Theses Model
 *
 * @property \App\Model\Table\MembresTable|\Cake\ORM\Association\BelongsTo $Membres
 * @property \App\Model\Table\DirigeantsTable|\Cake\ORM\Association\BelongsToMany $Dirigeants
 * @property \App\Model\Table\EncadrantsTable|\Cake\ORM\Association\BelongsToMany $Encadrants
 *
 * @method \App\Model\Entity\Theses get($primaryKey, $options = [])
 * @method \App\Model\Entity\Theses newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Theses[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Theses|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theses saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Theses patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Theses[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Theses findOrCreate($search, callable $callback = null, $options = [])
 */
class ThesesTable extends Table
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

        $this->setTable('theses');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Membres', [
            'foreignKey' => 'auteur_id'
        ]);
        $this->belongsToMany('Dirigeants', [
            'foreignKey' => 'these_id',
            'targetForeignKey' => 'dirigeant_id',
            'joinTable' => 'dirigeants_theses'
        ]);
        $this->belongsToMany('Encadrants', [
            'foreignKey' => 'these_id',
            'targetForeignKey' => 'encadrant_id',
            'joinTable' => 'encadrants_theses'
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
            ->scalar('sujet')
            ->maxLength('sujet', 20)
            ->requirePresence('sujet', 'create')
            ->allowEmptyString('sujet', false);

        $validator
            ->scalar('type')
            ->maxLength('type', 20)
            ->allowEmptyString('type');

        $validator
            ->date('date_debut')
            ->allowEmptyDate('date_debut');

        $validator
            ->date('date_fin')
            ->allowEmptyDate('date_fin');

        $validator
            ->scalar('signature')
            ->maxLength('signature', 20)
            ->allowEmptyString('signature');

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
        $rules->add($rules->existsIn(['auteur_id'], 'Membres'));

        return $rules;
    }
}
