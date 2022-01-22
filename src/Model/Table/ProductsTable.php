<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @property \App\Model\Table\SellersTable&\Cake\ORM\Association\BelongsTo $Sellers
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProductsTable extends Table
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

        $this->setTable('products');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Sellers');
        $this->belongsTo('Categories');
        $this->belongsTo('SubCategories');
        $this->hasMany('ProductImages');
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('brand')
            ->maxLength('brand', 255)
            ->requirePresence('brand', 'create')
            ->notEmptyString('brand');

        $validator
            ->integer('mrp')
            ->requirePresence('mrp', 'create')
            ->notEmptyString('mrp');

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->scalar('color')
            ->maxLength('color', 255)
            ->requirePresence('color', 'create')
            ->notEmptyString('color');

        $validator
            ->scalar('modelname')
            ->maxLength('modelname', 255)
            ->requirePresence('modelname', 'create')
            ->notEmptyString('modelname');

        $validator
            ->scalar('form_factor')
            ->maxLength('form_factor', 255)
            ->requirePresence('form_factor', 'create')
            ->notEmptyString('form_factor');

        $validator
            ->scalar('certification')
            ->maxLength('certification', 255)
            ->requirePresence('certification', 'create')
            ->notEmptyString('certification');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

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
        $rules->add($rules->existsIn(['seller_id'], 'Sellers'));
        // $rules->add($rules->existsIn(['categorie_id'], 'Categories'));
        // $rules->add($rules->existsIn(['sub_categorie_id'], 'SubCategories'));

        return $rules;
    }
}
