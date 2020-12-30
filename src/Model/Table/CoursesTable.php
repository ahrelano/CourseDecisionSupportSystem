<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Courses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Schools
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 * @property \Cake\ORM\Association\HasMany $Courselists
 *
 * @method \App\Model\Entity\Course get($primaryKey, $options = [])
 * @method \App\Model\Entity\Course newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Course[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Course|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Course patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Course[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Course findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CoursesTable extends Table
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

        $this->setTable('courses');
        $this->setDisplayField('course');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Courselists', [
            'foreignKey' => 'course_id'
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
            ->requirePresence('course', 'create')
            ->notEmpty('course');

        $validator
            ->integer('percentage')
            ->requirePresence('percentage', 'create')
            ->notEmpty('percentage');

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
        $rules->add($rules->existsIn(['school_id'], 'Schools'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));
        $rules->add($rules->isUnique(['school_id', 'course']));

        return $rules;
    }
}
