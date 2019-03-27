<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Financements Model
 *
 * @property \App\Model\Table\ProjetsTable|\Cake\ORM\Association\HasMany $Projets
 *
 * @method \App\Model\Entity\Financement get($primaryKey, $options = [])
 * @method \App\Model\Entity\Financement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Financement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Financement|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Financement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Financement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Financement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Financement findOrCreate($search, callable $callback = null, $options = [])
 */
class FinancementsTable extends Table
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

        $this->setTable('financements');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Projets', [
            'foreignKey' => 'financement_id'
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
            ->boolean('international')
            ->allowEmptyString('international');

        $validator
            ->scalar('nationalite_financement')
            ->maxLength('nationalite_financement', 60)
            ->allowEmptyString('nationalite_financement');

        $validator
            ->boolean('financement_prive')
            ->allowEmptyString('financement_prive');

        $validator
            ->scalar('financement')
            ->maxLength('financement', 60)
            ->allowEmptyString('financement');

        return $validator;
    }
}
