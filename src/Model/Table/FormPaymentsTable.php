<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FormPayments Model
 *
 * @property \App\Model\Table\ValuesTable|\Cake\ORM\Association\HasMany $Values
 *
 * @method \App\Model\Entity\FormPayment get($primaryKey, $options = [])
 * @method \App\Model\Entity\FormPayment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FormPayment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FormPayment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormPayment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FormPayment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FormPayment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FormPayment findOrCreate($search, callable $callback = null, $options = [])
 */
class FormPaymentsTable extends Table
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

        $this->setTable('form_payments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Values', [
            'foreignKey' => 'form_payment_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->allowEmpty('name');

        return $validator;
    }
}
