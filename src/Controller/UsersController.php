<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    public function index()
    {
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'), ['contain'=>['Locations']]);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function updateProfile()
    {
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The profile has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The profile could not be update. Please, try again.'));
        }
        $locations = $this->Users->Locations->find('list', ['limit' => 200])->order("Locations.city");
        $this->set(compact('user', 'locations'));
        $this->set('_serialize', ['user', 'locations']);
    }
    public function changePassword()
    {
        $user = $this->Users->get($this->request->session()->read('Auth.User.id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The password has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The password could not be update. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function logout(){
        $this->Flash->success('Successfully logged out');
        return $this->redirect($this->Auth->logout());
    }
}
