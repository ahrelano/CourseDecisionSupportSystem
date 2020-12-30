<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

class CoursesController extends AppController
{
    public function beforeFilter(Event $event){
        if ($this->request->session()->read('Auth.User.type') == 'client') {
            return $this->redirect(['controller'=>'Users','action' => 'index']);
        }
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Subjects','Schools']
        ];
        $courses = $this->paginate($this->Courses);
        $course_lists = $this->Courses->find('all')->order(['Courses.course']);
        foreach ($course_lists as $course_list) {
          $course_options[$course_list->course] = $course_list->course;
        }
        if ($this->request->is('post')) {
          $courses = $this->paginate($this->Courses->find('all')->where(['Courses.course'=>$this->request->data['course']]));
        }
        $this->set(compact('courses', 'course_options'));
        $this->set('_serialize', ['courses', 'course_options']);
    }

    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => ['Subjects', 'Schools']
        ]);

        $this->set('course', $course);
        $this->set('_serialize', ['course']);
    }

    public function add()
    {
        $course = $this->Courses->newEntity();
        if ($this->request->is('post')) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200])->order(['Subjects.subject']);
        $schools = $this->Courses->Schools->find('list', ['limit' => 200])->order(['Schools.school']);
        $this->set(compact('course', 'subjects' ,'schools'));
        $this->set('_serialize', ['course', 'subjects' ,'schools']);
    }

    public function edit($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The course could not be saved. Please, try again.'));
        }
        $subjects = $this->Courses->Subjects->find('list', ['limit' => 200])->order(['Subjects.subject']);
        $schools = $this->Courses->Schools->find('list', ['limit' => 200])->order(['Schools.school']);
        $this->set(compact('course', 'subjects','schools'));
        $this->set('_serialize', ['course' , 'subjects' ,'schools']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);
        if ($this->Courses->delete($course)) {
            $this->Flash->success(__('The course has been deleted.'));
        } else {
            $this->Flash->error(__('The course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
