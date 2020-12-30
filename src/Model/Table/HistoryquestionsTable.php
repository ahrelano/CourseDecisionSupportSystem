<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Historyquestions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Questions
 * @property \Cake\ORM\Association\BelongsTo $Subjects
 * @property \Cake\ORM\Association\HasMany $Historychoices
 *
 * @method \App\Model\Entity\Historyquestion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Historyquestion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Historyquestion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Historyquestion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Historyquestion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Historyquestion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Historyquestion findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class HistoryquestionsTable extends Table
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

        $this->setTable('historyquestions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Subjects', [
            'foreignKey' => 'subject_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Historychoices', [
            'foreignKey' => 'historyquestion_id'
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
            ->requirePresence('question', 'create')
            ->notEmpty('question');

        $validator
            ->allowEmpty('img');

        $validator
            ->boolean('sample')
            ->allowEmpty('sample');

        $validator
            ->requirePresence('answer', 'create')
            ->notEmpty('answer');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));
        $rules->add($rules->existsIn(['subject_id'], 'Subjects'));

        return $rules;
    }
}
