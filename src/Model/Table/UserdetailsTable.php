<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Userdetails Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Locations
 * @property \Cake\ORM\Association\BelongsTo $Courses
 * @property \Cake\ORM\Association\HasMany $Courselists
 * @property \Cake\ORM\Association\HasMany $Questionlists
 * @property \Cake\ORM\Association\HasMany $Schoollists
 * @property \Cake\ORM\Association\HasMany $Scorelists
 *
 * @method \App\Model\Entity\Userdetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\Userdetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Userdetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Userdetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Userdetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Userdetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Userdetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UserdetailsTable extends Table
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

        $this->setTable('userdetails');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Locations', [
            'foreignKey' => 'location_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Courselists', [
            'foreignKey' => 'userdetail_id'
        ]);
        $this->hasMany('Questionlists', [
            'foreignKey' => 'userdetail_id'
        ]);
        $this->hasMany('Schoollists', [
            'foreignKey' => 'userdetail_id'
        ]);
        $this->hasMany('Scorelists', [
            'foreignKey' => 'userdetail_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

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
        $rules->add($rules->existsIn(['location_id'], 'Locations'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));

        return $rules;
    }
}
