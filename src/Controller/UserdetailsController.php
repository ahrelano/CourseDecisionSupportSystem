<?php
namespace App\Controller;
require_once ROOT . DS . 'src/Lib/fpdf/fpdf.php';
require_once ROOT . DS . 'src/Lib/fpdf/html_table.php';

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\App;

class UserdetailsController extends AppController
{

    public function beforeFilter(Event $event){
       $this->loadModel('Schoollists');
       $this->loadModel('Courselists');
       $this->loadModel('Scorelists');
       $this->loadModel('Questionlists');
       $this->loadModel('Courses');
       // if($this->request->session()->read('Auth.User.type') == 'client'){
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'=>['Locations']]
        ];
        if($this->request->session()->read('Auth.User.type') == 'client'){
          $userdetails = $this->paginate($this->Userdetails->find('all')->where(['Users.id'=>$this->request->session()->read('Auth.User.id'), 'Userdetails.average IS NOT NULL'])->order(['Userdetails.average'=>'DESC']));
        }else{
          $userdetails = $this->paginate($this->Userdetails->find('all')->order(['Userdetails.average'=>'DESC'])->where(['Userdetails.average IS NOT NULL']));
        }

        $this->set(compact('userdetails'));
        $this->set('_serialize', ['userdetails']);
    }

    public function view($id = null)
    {
       $this->viewBuilder()->layout('');
       if($this->request->session()->read('Auth.User.type') == 'superadmin' || $this->request->session()->read('Auth.User.type') == 'admin'){
         $userdetail = $this->Userdetails->get($id, ['contain'=>['Users'=>['Locations']], 'where'=>'Userdetails.average IS NOT NULL']);
         $score_details = $this->Scorelists->find('all', ['contain'=>'Subjects'])->where(['Scorelists.userdetail_id'=>$id])->order(['Scorelists.average'=>'DESC']);
         $question_lists = $this->Questionlists->find('all', ['contain'=>['Questions'=>['Subjects']]])->where(['Questionlists.userdetail_id'=>$id]);

        $school_lists = array();
        $suit_courses = array();
        $school_exists = false;
        foreach ($score_details as $key => $value) {
          $courses = $this->Courses->find('all', ['contain'=>['Schools'=>['Locations'], 'Subjects']])->where(['Courses.percentage <='=>$value->average, 'Courses.subject_id'=>$value->subject_id]);
          foreach ($courses as $course) {
              $suit_courses[$course->course]='';
              if (count($school_lists) == 0) {
                $school_lists[$course->school->school] = [
                  'course'=>$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                ];
              }else{
                foreach ($school_lists as $value) {
                  if(isset($school_lists[$course->school->school])){
                    $school_lists[$course->school->school] = [
                      'course'=>$value['course'].' ||| '.$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                    ];
                    $school_exists = true;
                  }
                }
                if ($school_exists == false) {
                  $school_lists[$course->school->school] = [
                    'course'=>$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                  ];
                }
                $school_exists = false;
              }
          }
        }
      }else{
        $userdetail = $this->Userdetails->get($id, ['contain'=>['Users'=>['Locations']], 'where'=>'Userdetails.average IS NOT NULL']);
         $score_details = $this->Scorelists->find('all', ['contain'=>['Userdetails'=>['Users'],'Subjects']])->where(['Scorelists.userdetail_id'=>$userdetail->id, 'Users.id'=>$this->request->session()->read('Auth.User.id')])->order(['Scorelists.average'=>'DESC']);
         $question_lists = $this->Questionlists->find('all', ['contain'=>['Userdetails'=>['Users'],'Questions'=>['Subjects']]])->where(['Questionlists.userdetail_id'=>$userdetail->id, 'Users.id'=>$this->request->session()->read('Auth.User.id')]);

        $school_lists = array();
        $suit_courses = array();
        $school_exists = false;
        foreach ($score_details as $key => $value) {
          $courses = $this->Courses->find('all', ['contain'=>['Schools'=>['Locations'], 'Subjects']])->where(['Courses.percentage <='=>$value->average, 'Courses.subject_id'=>$value->subject_id]);
          foreach ($courses as $course) {
              $suit_courses[$course->course]='';
              if (count($school_lists) == 0) {
                $school_lists[$course->school->school] = [
                  'course'=>$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                ];
              }else{
                foreach ($school_lists as $value) {
                  if(isset($school_lists[$course->school->school])){
                    $school_lists[$course->school->school] = [
                      'course'=>$value['course'].' ||| '.$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                    ];
                    $school_exists = true;
                  }
                }
                if ($school_exists == false) {
                  $school_lists[$course->school->school] = [
                    'course'=>$course->course.' ('.$course->subject->subject." ".$course->percentage.'%)'
                  ];
                }
                $school_exists = false;
              }
          }
        }

      }
      $this->set(compact('userdetail', 'school_lists', 'suit_courses', 'score_details', 'question_lists')); 
      $this->render()->type('application/pdf'); //Rendering the pdf
    }

    public function viewall()
    {
       $this->viewBuilder()->layout('');
       if($this->request->session()->read('Auth.User.type') == 'superadmin' || $this->request->session()->read('Auth.User.type') == 'admin'){
         $userdetails = $this->Userdetails->find('all', ['contain'=>['Users'=>['Locations']]])->where(['Userdetails.average IS NOT NULL'])->order(['Userdetails.average'=>'DESC']);
         $score_details = $this->Scorelists->find('all', ['contain'=>'Subjects'])->order(['Scorelists.average'=>'DESC']);
         $question_lists = $this->Questionlists->find('all', ['contain'=>['Questions'=>['Subjects']]]);
         $courses = $this->Courses->find('all', ['contain'=>['Schools'=>['Locations'], 'Subjects']]);
      $this->set(compact('userdetails', 'score_details', 'question_lists', 'courses')); 
      $this->render()->type('application/pdf'); //Rendering the pdf
      }else{
          return $this->redirect(['action' => 'index']);
      }
    }
}
