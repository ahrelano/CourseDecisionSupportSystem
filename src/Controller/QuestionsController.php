<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class QuestionsController extends AppController
{
    public function beforeFilter(Event $event){
        $this->loadModel('Subjects');
        $this->loadModel('Choices');
        $this->loadModel('Historyquestions');
        $this->loadModel('Historychoices');
        $this->loadModel('Users');
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Subjects']
        ];
        $questions = $this->paginate($this->Questions);
        if ($this->request->is('post')) {
            if ($this->request->data['fromdate'] != '' && $this->request->data['todate'] != '') {
                $questions = $this->paginate($this->Questions->find('all')->where([
                    'Questions.subject_id'=>$this->request->data['subject'],
                    'Questions.created >='=>$this->request->data['fromdate'],
                    'Questions.created <='=>$this->request->data['todate'] . ' 23:59:59'
                    ]));
            }else if ($this->request->data['fromdate'] != '' && $this->request->data['todate'] == '') {
                $questions = $this->paginate($this->Questions->find('all')->where([
                    'Questions.subject_id'=>$this->request->data['subject'],
                    'Questions.created >='=>$this->request->data['fromdate']
                    ]));
            }else if ($this->request->data['fromdate'] == '' && $this->request->data['todate'] != '') {
                $questions = $this->paginate($this->Questions->find('all')->where([
                    'Questions.subject_id'=>$this->request->data['subject'],
                    'Questions.created <='=>$this->request->data['todate'] . ' 23:59:59'
                    ]));
            }else if ($this->request->data['fromdate'] == '' && $this->request->data['todate'] == '') {
                $questions = $this->paginate($this->Questions->find('all')->where(['Questions.subject_id'=>$this->request->data['subject']]));
            }
        }
        $historyquestions = $this->Historyquestions->find('all', ['contain'=>'Users']);
        $historychoices = $this->Historychoices->find('all');
        $subjects = $this->Subjects->find('list')->order(['Subjects.subject']);
        $this->set(compact('questions', 'subjects', 'historyquestions', 'historychoices'));
        $this->set('_serialize', ['questions', 'subjects', 'historyquestions', 'historychoices']);
    }

    public function view($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => ['Subjects']
        ]);
        $choices = $this->Choices->find('all')->where(['Choices.question_id'=>$id]);

        $this->set(compact('question', 'choices'));
        $this->set('_serialize', ['question', 'choices']);
    }

    public function add()
    {
        $question = $this->Questions->newEntity();
        $historyquestion = $this->Historyquestions->newEntity();
        if ($this->request->is('post')) {
            $imageFileName = $this->addPhotos($this->request->data['img']);
            $this->request->data['img'] = $imageFileName;
            $this->request->data['user_id'] = $this->request->session()->read('Auth.User.id');
            if (isset($this->request->data['choices'])) {
                for ($i=0; $i < count($this->request->data['choices']); $i++) {
                    if ($this->request->data['answer'] == ($i+1)) {
                        $this->request->data['answer'] = $this->request->data['choices'][$i];
                    }
                }
            }else{
                $choices_img = array();
                for ($i=0; $i < count($this->request->data['choices_img']); $i++) {
                    if ($this->request->data['answer'] == ($i+1)) {
                        $this->request->data['answer'] = $this->addChoices($this->request->data['choices_img'][$i]);
                        $choices_img[] = $this->request->data['answer'];
                    }else{
                        $choices_img[] = $this->addChoices($this->request->data['choices_img'][$i]);
                    }
                }
            }
            if (!$this->Questions->save($question)) {
                $this->Flash->success(__('The question could not be saved. Please, try again.'));
            }
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $last_question_id = $this->Questions->find('all',['limit'=>1])->order(['Questions.id'=>'DESC']);
                foreach ($last_question_id as $last_id) {
                    $this->request->data['question_id'] = $last_id->id;
                    $historyquestion = $this->Questions->patchEntity($historyquestion, $this->request->getData());
                    if ($this->Historyquestions->save($historyquestion)) {
                        $last_history_question_id = $this->Historyquestions->find('all',['limit'=>1])->order(['Historyquestions.id'=>'DESC']);
                        foreach ($last_history_question_id as $last_history_id) {
                            if (isset($this->request->data['choices'])) {
                                for ($i=0; $i < count($this->request->data['choices']); $i++) {
                                    $historychoices = $this->Historychoices->newEntity();
                                    $historychoices->historyquestion_id = $last_history_id->id;
                                    $historychoices->choice = $this->request->data['choices'][$i];
                                    $this->Historychoices->save($historychoices);
                                }
                            }else{
                                for ($i=0; $i < count($choices_img); $i++) {
                                    $historychoices = $this->Historychoices->newEntity();
                                    $historychoices->historyquestion_id = $last_history_id->id;
                                    $historychoices->choice = $choices_img[$i];
                                    $historychoices->img = 1;
                                    $this->Historychoices->save($historychoices);
                                }
                            }
                        }
                    }
                if (isset($this->request->data['choices'])) {
                    for ($i=0; $i < count($this->request->data['choices']); $i++) {
                        $choices = $this->Choices->newEntity();
                        $choices->question_id = $last_id->id;
                        $choices->choice = $this->request->data['choices'][$i];
                        $this->Choices->save($choices);
                    }
                }else{
                    for ($i=0; $i < count($choices_img); $i++) {
                        $choices = $this->Choices->newEntity();
                        $choices->question_id = $last_id->id;
                        $choices->choice = $choices_img[$i];
                        $choices->img = 1;
                        $this->Choices->save($choices);
                    }
                }
                }
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $subjects = $this->Questions->Subjects->find('list', ['limit' => 200])->order("Subjects.subject");
        $this->set(compact('question', 'subjects'));
        $this->set('_serialize', ['question']);
    }

    public function edit($id = null)
    {
        $question = $this->Questions->get($id, [
            'contain' => []
        ]);
        $historyquestion = $this->Historyquestions->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $imageFileName = $this->addPhotos($this->request->data['img']);
            $this->request->data['img'] = $imageFileName;
            if ($this->request->data['img']['name'] == '') {
                $this->request->data['img'] = $question->img;
            }
            $this->request->data['user_id'] = $this->request->session()->read('Auth.User.id');
            if (isset($this->request->data['choices'])) {
                for ($i=0; $i < count($this->request->data['choices']); $i++) {
                    if ($this->request->data['answer'] == ($i+1)) {
                        $this->request->data['answer'] = $this->request->data['choices'][$i];
                    }
                }
            }else{
                $choices_img = array();
                for ($i=0; $i < count($this->request->data['choices_img']); $i++) {
                    if ($this->request->data['answer'] == ($i+1)) {
                        if ($this->request->data['choices_img'][$i]['name'] == '') {
                            $this->request->data['answer'] = $this->request->data['old_choice'][$i];
                            $choices_img[] = '';
                        }else{
                            $this->request->data['answer'] = $this->addChoices($this->request->data['choices_img'][$i]);
                            $choices_img[] = $this->request->data['answer'];
                        }
                    }else{
                        if ($this->request->data['choices_img'][$i]['name'] == '') {
                            $choices_img[] = '';
                        }else{
                            $choices_img[] = $this->addChoices($this->request->data['choices_img'][$i]);
                        }
                    }
                }
            }
            $former_choices_img = array();
            $choices = $this->Choices->find('all')->where(['Choices.question_id'=>$id]);
            foreach ($choices as $key => $value) {
                $former_choices_img[] = $value->choice;
            }
            if (!$this->Questions->save($question)) {
                $this->Flash->success(__('The question could not be saved. Please, try again.'));
            }
            $question = $this->Questions->patchEntity($question, $this->request->getData());
            if ($this->Questions->save($question)) {
                $this->request->data['question_id'] = $id;
                $historyquestion = $this->Questions->patchEntity($historyquestion, $this->request->getData());
                if ($this->Historyquestions->save($historyquestion)) {
                    $last_history_question_id = $this->Historyquestions->find('all',['limit'=>1])->order(['Historyquestions.id'=>'DESC']);
                    foreach ($last_history_question_id as $last_history_id) {
                        if (isset($this->request->data['choices'])) {
                            for ($i=0; $i < count($this->request->data['choices']); $i++) {
                                $historychoices = $this->Historychoices->newEntity();
                                $historychoices->historyquestion_id = $last_history_id->id;
                                $historychoices->choice = $this->request->data['choices'][$i];
                                $this->Historychoices->save($historychoices);
                            }
                        }else{
                            for ($i=0; $i < count($choices_img); $i++) {
                                $historychoices = $this->Historychoices->newEntity();
                                $historychoices->historyquestion_id = $last_history_id->id;
                                if ($choices_img[$i] == '') {
                                    $historychoices->choice = $former_choices_img[$i];
                                }else{
                                    $historychoices->choice = $choices_img[$i];
                                }
                                $historychoices->img = 1;
                                $this->Historychoices->save($historychoices);
                            }
                        }
                    }
                }
                $choices = $this->Choices->find('all')->where(['Choices.question_id'=>$id]);
                $count = 0;
                if (isset($this->request->data['choices'])) {
                    foreach ($choices as $key => $value) {
                        $choice = $this->Choices->get($value->id);
                        $choice->choice = $this->request->data['choices'][$count];
                        $this->Choices->save($choice);
                        $count = $count + 1;
                    }
                }else{
                    foreach ($choices as $key => $value) {
                        $choice = $this->Choices->get($value->id);
                        if ($choices_img[$count] == '') {
                            $choice->choice = $choice->choice;
                        }else{
                            $choice->choice = $choices_img[$count];
                        }
                        $choice->img = 1;
                        $this->Choices->save($choice);
                        $count = $count + 1;
                    }
                }
                $this->Flash->success(__('The question has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The question could not be saved. Please, try again.'));
        }
        $choices = $this->Choices->find('all')->where(['Choices.question_id'=>$id]);
        $subjects = $this->Questions->Subjects->find('list', ['limit' => 200])->order("Subjects.subject");
        $this->set(compact('question', 'subjects', 'choices'));
        $this->set('_serialize', ['question', 'subjects', 'choices']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $question = $this->Questions->get($id);
        if ($this->Questions->delete($question)) {
            $this->Flash->success(__('The question has been deleted.'));
        } else {
            $this->Flash->error(__('The question could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
