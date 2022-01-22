<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Address Model
 *
 * @property \App\Model\Table\CustomersTable&\Cake\ORM\Association\BelongsTo $Customers
 *
 * @method \App\Model\Entity\Addres get($primaryKey, $options = [])
 * @method \App\Model\Entity\Addres newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Addres[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Addres|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Addres saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Addres patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Addres[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Addres findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AddressTable extends Table
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

        $this->setTable('address');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Customers', [
            'foreignKey' => 'customer_id',
            'joinType' => 'INNER',
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('type')
            ->maxLength('type', 255)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        $validator
            ->scalar('full_name')
            ->maxLength('full_name', 256)
            ->requirePresence('full_name', 'create')
            ->notEmptyString('full_name');

        $validator
            ->requirePresence('mobile_no', 'create')
            ->notEmptyString('mobile_no');

        $validator
            ->integer('pin_code')
            ->requirePresence('pin_code', 'create')
            ->notEmptyString('pin_code');

        $validator
            ->scalar('house_no_building')
            ->maxLength('house_no_building', 256)
            ->requirePresence('house_no_building', 'create')
            ->notEmptyString('house_no_building');

        $validator
            ->scalar('area')
            ->maxLength('area', 256)
            ->requirePresence('area', 'create')
            ->notEmptyString('area');

        $validator
            ->scalar('lendmark')
            ->maxLength('lendmark', 256)
            ->requirePresence('lendmark', 'create')
            ->notEmptyString('lendmark');

        $validator
            ->scalar('city')
            ->maxLength('city', 256)
            ->requirePresence('city', 'create')
            ->notEmptyString('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 256)
            ->requirePresence('state', 'create')
            ->notEmptyString('state');

        $validator
            ->scalar('country')
            ->maxLength('country', 256)
            ->requirePresence('country', 'create')
            ->notEmptyString('country');

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
        $rules->add($rules->existsIn(['customer_id'], 'Customers'));

        return $rules;
    }
}
