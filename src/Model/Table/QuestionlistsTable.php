<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questionlists Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Userdetails
 * @property \Cake\ORM\Association\BelongsTo $Questions
 *
 * @method \App\Model\Entity\Questionlist get($primaryKey, $options = [])
 * @method \App\Model\Entity\Questionlist newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Questionlist[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Questionlist|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Questionlist patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Questionlist[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Questionlist findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionlistsTable extends Table
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

        $this->setTable('questionlists');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Userdetails', [
            'foreignKey' => 'userdetail_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
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
        $rules->add($rules->existsIn(['userdetail_id'], 'Userdetails'));
        $rules->add($rules->existsIn(['question_id'], 'Questions'));

        return $rules;
    }
}
