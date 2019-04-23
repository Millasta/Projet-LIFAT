<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Membres Model
 *
 * @property \App\Model\Table\LieuTravailsTable|\Cake\ORM\Association\BelongsTo $LieuTravails
 *
 * @method \App\Model\Entity\Membre get($primaryKey, $options = [])
 * @method \App\Model\Entity\Membre newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Membre[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Membre|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Membre saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Membre patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Membre[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Membre findOrCreate($search, callable $callback = null, $options = [])
 */
class MembresTable extends Table
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

        $this->setTable('membres');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('LieuTravails', [
            'foreignKey' => 'lieu_travail_id'
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
            ->scalar('role')
            ->requirePresence('role', 'create')
            ->allowEmptyString('role', false);

        $validator
            ->scalar('nom')
            ->maxLength('nom', 25)
            ->allowEmptyString('nom');

        $validator
            ->scalar('prenom')
            ->maxLength('prenom', 25)
            ->allowEmptyString('prenom');

        $validator
            ->email('email')
            ->allowEmptyString('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('passwd')
            ->maxLength('passwd', 60)
            ->allowEmptyString('passwd');

        $validator
            ->scalar('adresse_agent_1')
            ->maxLength('adresse_agent_1', 80)
            ->allowEmptyString('adresse_agent_1');

        $validator
            ->scalar('adresse_agent_2')
            ->maxLength('adresse_agent_2', 60)
            ->allowEmptyString('adresse_agent_2');

        $validator
            ->scalar('residence_admin_1')
            ->maxLength('residence_admin_1', 80)
            ->allowEmptyString('residence_admin_1');

        $validator
            ->scalar('residence_admin_2')
            ->maxLength('residence_admin_2', 80)
            ->allowEmptyString('residence_admin_2');

        $validator
            ->scalar('type_personnel')
            ->allowEmptyString('type_personnel');

        $validator
            ->scalar('intitule')
            ->maxLength('intitule', 30)
            ->allowEmptyString('intitule');

        $validator
            ->scalar('grade')
            ->maxLength('grade', 30)
            ->allowEmptyString('grade');

        $validator
            ->scalar('im_vehicule')
            ->maxLength('im_vehicule', 10)
            ->requirePresence('im_vehicule', 'create')
            ->allowEmptyString('im_vehicule', false);

        $validator
            ->integer('pf_vehicule')
            ->requirePresence('pf_vehicule', 'create')
            ->allowEmptyString('pf_vehicule', false);

        $validator
            ->scalar('signature_name')
            ->maxLength('signature_name', 20)
            ->requirePresence('signature_name', 'create')
            ->allowEmptyString('signature_name', false)
            ->add('signature_name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('login_cas')
            ->maxLength('login_cas', 60)
            ->allowEmptyString('login_cas')
            ->add('login_cas', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('carte_sncf')
            ->maxLength('carte_sncf', 40)
            ->allowEmptyString('carte_sncf');

        $validator
            ->integer('matricule')
            ->allowEmptyString('matricule');

        $validator
            ->dateTime('date_naissance')
            ->allowEmptyDateTime('date_naissance');

        $validator
            ->boolean('actif')
            ->allowEmptyString('actif');

        $validator
            ->scalar('nationalite')
            ->maxLength('nationalite', 20)
            ->allowEmptyString('nationalite');

        $validator
            ->boolean('est_francais')
            ->allowEmptyString('est_francais');

        $validator
            ->scalar('genre')
            ->maxLength('genre', 1)
            ->allowEmptyString('genre');

        $validator
            ->boolean('hdr')
            ->allowEmptyString('hdr');

        $validator
            ->boolean('permanent')
            ->allowEmptyString('permanent');

        $validator
            ->boolean('est_porteur')
            ->allowEmptyString('est_porteur');

        $validator
            ->dateTime('date_creation')
            ->allowEmptyDateTime('date_creation');

        $validator
            ->dateTime('date_sortie')
            ->allowEmptyDateTime('date_sortie');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->isUnique(['signature_name']));
        $rules->add($rules->isUnique(['login_cas']));
        $rules->add($rules->existsIn(['lieu_travail_id'], 'LieuTravails'));

        return $rules;
    }
}
