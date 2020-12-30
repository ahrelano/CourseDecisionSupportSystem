<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courselists Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Userdetails
 * @property \Cake\ORM\Association\BelongsTo $Courses
 *
 * @method \App\Model\Entity\Courselist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Courselist newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Courselist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Courselist|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Courselist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Courselist[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Courselist findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CourselistsTable extends Table
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

        $this->setTable('courselists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Userdetails', [
            'foreignKey' => 'userdetail_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Courses', [
            'foreignKey' => 'course_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['userdetail_id'], 'Userdetails'));
        $rules->add($rules->existsIn(['course_id'], 'Courses'));

        return $rules;
    }
}
