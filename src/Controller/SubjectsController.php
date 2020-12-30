<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

class SubjectsController extends AppController
{
    public function beforeFilter(Event $event){
        if ($this->request->session()->read('Auth.User.type') == 'client') {
            return $this->redirect(['controller'=>'Users','action' => 'index']);
        }
    }

    public function index()
    {
        $subjects = $this->paginate($this->Subjects);

        $this->set(compact('subjects'));
        $this->set('_serialize', ['subjects']);
    }

    public function view($id = null)
    {
        $subject = $this->Subjects->get($id, [
            'contain' => ['Questions']
        ]);

        $this->set('subject', $subject);
        $this->set('_serialize', ['subject']);
    }

    public function add()
    {
        $subject = $this->Subjects->newEntity();
        if ($this->request->is('post')) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }
        $this->set(compact('subject'));
        $this->set('_serialize', ['subject']);
    }

    public function edit($id = null)
    {
        $subject = $this->Subjects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subject = $this->Subjects->patchEntity($subject, $this->request->getData());
            if ($this->Subjects->save($subject)) {
                $this->Flash->success(__('The subject has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subject could not be saved. Please, try again.'));
        }
        $this->set(compact('subject'));
        $this->set('_serialize', ['subject']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subject = $this->Subjects->get($id);
        if ($this->Subjects->delete($subject)) {
            $this->Flash->success(__('The subject has been deleted.'));
        } else {
            $this->Flash->error(__('The subject could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
