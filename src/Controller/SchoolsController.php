<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

class SchoolsController extends AppController
{
    public function beforeFilter(Event $event){
        if ($this->request->session()->read('Auth.User.type') == 'client') {
            return $this->redirect(['controller'=>'Users','action' => 'index']);
        }
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Locations']
        ];
        $schools = $this->paginate($this->Schools);

        $this->set(compact('schools'));
        $this->set('_serialize', ['schools']);
    }

    public function view($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => ['Locations']
        ]);

        $this->set('school', $school);
        $this->set('_serialize', ['school']);
    }

    public function add()
    {
        $school = $this->Schools->newEntity();
        if ($this->request->is('post')) {
            $school = $this->Schools->patchEntity($school, $this->request->getData());
            if ($this->Schools->save($school)) {
                $this->Flash->success(__('The school has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school could not be saved. Please, try again.'));
        }
        $location = $this->Schools->Locations->find('all', ['limit' => 200, 'order'=>'city']);
        foreach ($location as  $value) {
            $locations[$value->id] = $value->city;
        }
        $this->set(compact('school', 'locations'));
        $this->set('_serialize', ['school']);
    }

    public function edit($id = null)
    {
        $school = $this->Schools->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $school = $this->Schools->patchEntity($school, $this->request->getData());
            if ($this->Schools->save($school)) {
                $this->Flash->success(__('The school has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school could not be saved. Please, try again.'));
        }
        $location = $this->Schools->Locations->find('all', ['limit' => 200, 'order'=>'city']);
        foreach ($location as  $value) {
            $locations[$value->id] = $value->city;
        }
        $this->set(compact('school', 'locations'));
        $this->set('_serialize', ['school']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $school = $this->Schools->get($id);
        if ($this->Schools->delete($school)) {
            $this->Flash->success(__('The school has been deleted.'));
        } else {
            $this->Flash->error(__('The school could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
