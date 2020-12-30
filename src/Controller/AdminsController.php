<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

class AdminsController extends AppController
{
    public function beforeFilter(Event $event){
        $this->loadModel('Users');
        $this->loadModel('Locations');
        if ($this->request->session()->read('Auth.User.type') != 'superadmin') {
            return $this->redirect(['controller'=>'Users','action' => 'index']);
        }
    }

    public function index(){
        $this->paginate = ['contain' => []];
        $users = $this->paginate($this->Users->find('all', ['contain'=>['Locations']])->where(['Users.type'=>'admin']));

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function add(){
        $admin = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['firstname'] = strip_tags($this->request->data['firstname']);
            $this->request->data['lastname'] = strip_tags($this->request->data['lastname']);
            $this->request->data['username'] = strip_tags($this->request->data['username']);
            $this->request->data['type'] = 'admin';
            if (preg_match('/\s/',$this->request->data['username'])) {
                $this->Flash->error(__('Invalid username!'));
                return $this->redirect(['action' => 'index']);
            }
            $admin = $this->Users->patchEntity($admin, $this->request->getData());
            if ($this->Users->save($admin)) {
                $this->Flash->success(__('Successfully added!'));
                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error('Failed to add, please try again!');
        }
        $locations = $this->Users->Locations->find('list', ['limit' => 200])->order("Locations.city");
        $this->set(compact('admin', 'locations'));
        $this->set('_serialize', ['admin', 'locations']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $admin = $this->Users->get($id);
        if ($this->Users->delete($admin)) {
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function changePassword($id = null){
        $admin = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Users->patchEntity($admin, $this->request->getData());
            if ($this->Users->save($admin)) {
                $this->Flash->success(__('The password has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password could not be update. Please, try again.'));
        }
        $this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
    }

    public function updateProfile($id = null){
        $admin = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Users->patchEntity($admin, $this->request->getData());
            if ($this->Users->save($admin)) {
                $this->Flash->success(__('The profile has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be update. Please, try again.'));
        }
        $locations = $this->Users->Locations->find('list', ['limit' => 200])->order("Locations.city");
        $this->set(compact('admin', 'locations'));
        $this->set('_serialize', ['admin','locations']);
    }

}