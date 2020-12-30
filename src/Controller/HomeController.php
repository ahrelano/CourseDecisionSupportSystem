<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

class HomeController extends AppController
{
    public function beforeFilter(Event $event){
        $this->viewBuilder()->layout('home');
    }

    public function index(){
    }
}