<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lieus Model
 *
 * @method \App\Model\Entity\Lieus get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lieus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Lieus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lieus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lieus saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lieus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lieus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lieus findOrCreate($search, callable $callback = null, $options = [])
 */
class LieusTable extends Table
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

        $this->setTable('lieus');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('nom_lieu')
            ->maxLength('nom_lieu', 60)
            ->allowEmptyString('nom_lieu');

        $validator
            ->boolean('est_dans_liste')
            ->allowEmptyString('est_dans_liste');

        return $validator;
    }
}
