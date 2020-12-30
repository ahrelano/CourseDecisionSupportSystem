<?php
namespace App\Controller;
require_once ROOT . DS . 'src/Lib/fpdf/fpdf.php';
require_once ROOT . DS . 'src/Lib/fpdf/html_table.php';

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\App;

class TestsController extends AppController
{
	public function beforeFilter(Event $event){
		$this->loadModel('Choices');
		$this->loadModel('Users');
		$this->loadModel('Schools');
		$this->loadModel('Scorelists');
		$this->loadModel('Userdetails');
		$this->viewBuilder()->layout('test');
		$this->Auth->allow('register');
	}

	public function index(){

	}

	public function schoolLists($id = null){
		$this->viewBuilder()->layout('');
		if (!$this->request->is('ajax')) {
			return $this->redirect(['action'=>'index']);
		}
		$schools = $this->Schools->find('all', ['contain'=>'Locations'])->where(['Schools.location_id'=>$id])->order(['Schools.school']);
		$this->set(compact('schools'));
		$this->set('_serialize', ['schools']);
	}

	public function courseLists($id = null){
		$this->viewBuilder()->layout('');
		if (!$this->request->is('ajax')) {
			return $this->redirect(['action'=>'index']);
		}
		$this->loadModel('Courses');
		$courses = $this->Courses->find('list')->where(['Courses.school_id'=>$id])->order(['Courses.course']);
		$this->set(compact('courses'));
		$this->set('_serialize', ['courses']);
	}

	public function realTest(){
		$this->loadModel('Locations');
		$this->loadModel('Subjects');
		$this->loadModel('Courses');

		$find_no_average_details = $this->Userdetails->find('all', ['limit'=>1])->order(['id'=>'desc'])->where(['Userdetails.user_id'=> $this->request->session()->read('Auth.User.id'), 'Userdetails.average IS NULL']);
		$find_no_average_detail = 0;
		foreach ($find_no_average_details as $key => $value) {
			$all_current_save_scores = $this->Scorelists->find('all')->where(['Scorelists.userdetail_id'=>$value->id]);
			$find_no_average_detail = 1;
		}
		if ($find_no_average_detail == 0) {
			$subjects = $this->Subjects->find('all', ['order'=>'subject']);
		}else{
			$all_current_save_score = array();
			foreach ($all_current_save_scores as $key => $value) {
				$all_current_save_score[] = $value->subject_id;
			}
			$subjects = $this->Subjects->find('all', ['order'=>'subject'])->where(['Subjects.id NOT IN ('.implode(',',$all_current_save_score).')']);
		}
		$locations = $this->Locations->find('all')->order(['Locations.city']);
		$this->set(compact('subjects', 'locations'));
		$this->set('_serialize', ['subjects','locations']);
	}

	public function realtestSample($subject = null){
		$this->viewBuilder()->layout('');
		$this->loadModel('Questions');
		$questions = $this->Questions->find('all',['order'=>'rand()', 'contain'=>'Subjects', 'limit'=>50])->where(['subject_id'=>$subject, 'sample'=>'0']);
		$choices = $this->Choices->find('all');
		$this->set(compact('questions','choices'));
		$this->set('_serialize', ['questions','choices']);
	}

	public function realtestResult(){
		$this->viewBuilder()->layout('');
		$this->loadModel('Subjects');
		$this->loadModel('Questions');
		$this->loadModel('Locations');
		$this->loadModel('Schools');
		$this->loadModel('Courses');
		$this->loadModel('Userdetails');
		$this->loadModel('Schoollists');
		$this->loadModel('Courselists');
		$this->loadModel('Scorelists');
		$this->loadModel('Questionlists');
		$subjects = $this->Subjects->find('all', ['order'=>'subject']);
		$all_user_answers = 1;
		foreach ($subjects as $key => $value) {
			$count = 1;
			$index_answer = 0;
			if (isset($this->request->data[$value->id])) {
				$questions_id = explode(" ", $this->request->data[$value->id]);
				if (isset($this->request->data[$value->id."-number"])) {
					$question_number = explode(" ", $this->request->data[$value->id."-number"]);
					if (isset($this->request->data[$value->id."-answers"])) {
						$user_answers = explode(" ||| ", $this->request->data[$value->id."-answers"]);
						foreach ($questions_id as $qID) {
							if (is_numeric($qID)) {
								$question = $this->Questions->find('all',['contain'=>'Subjects', 'limit'=>1])->where(['Questions.id'=>$qID, 'sample'=>'0']);
								$question_lists[] = $this->Questions->find('all',['contain'=>'Subjects', 'limit'=>1])->where(['Questions.id'=>$qID, 'sample'=>'0']);
								foreach ($question_number as $qNO) {
									if ($qNO == $count) {
										$answer = $user_answers[$index_answer];
										foreach ($question as $key => $value) {
											if ($value->answer == $answer) {
												if (!isset($score[$value->subject->id])) {
													$score[$value->subject_id] = 1;
												}else{
													$score[$value->subject_id] = $score[$value->subject_id] + 1;
												}
												$user_answers_lists[$all_user_answers] = $answer;
											}else{
												if (!isset($score[$value->subject->id])) {
													$score[$value->subject_id] = 0;
												}
												$user_answers_lists[$all_user_answers] = $answer;
											}
										}
										$index_answer = $index_answer + 1;
									}
								}
							if (!isset($user_answers_lists[$all_user_answers])) {
								$user_answers_lists[$all_user_answers] = "No Answer";
								foreach ($question as $key => $value) {
									if (!isset($score[$value->subject->id])) {
										$score[$value->subject_id] = 0;
									}
								}	
							}
							//Number of items
							foreach ($question as $key => $value) {
								$number_items[$value->subject_id] = $count;
								//Each Subject average calculation
								$each_average[$value->subject_id] = ($score[$value->subject_id] / $number_items[$value->subject_id]) * 100;
							}
							$all_user_answers = $all_user_answers + 1;
								$count = $count + 1;
							}
						}
					}
				}
			}
		}
		if (!isset($questions_id)) {
			$this->redirect(['action'=>'index']);
		}else{
			unset($questions_id);
			foreach ($score as $key => $scores) {
				$score_subject = $this->Subjects->find('all', ['limit'=>1])->where(['id'=>$key]);
				foreach ($score_subject as $value_subject) {
					$score_details[$key] = $value_subject->subject . ": " . $scores;
					$score_details_ids[$key] = $scores;
				}
			}
			$user = $this->Users->get($this->request->session()->read('Auth.User.id'), ['contain'=>['Locations']]);
			$schools = $this->Schools->find('all', ['contain'=>['Locations']]);
			foreach($schools as $school){
				if ($school->location->city == $user->location->city) {
					if (!isset($school_lists[9])) {
						$school_lists[] = $school->school.' ('.$school->location->city.', Pampanga)';
						$school_ids[] = $school->id;
					}
				}
			}
			foreach($schools as $school){
				if ($school->location->city != $user->location->city) {
					if (!isset($school_lists[9])) {
						$school_lists[] = $school->school.' ('.$school->location->city.', Pampanga)';
						$school_ids[] = $school->id;
					}
				}
			}
			//Find all suitable courses
			$count_subjects = 0;
			$total_average = 0;
			foreach ($each_average as $key => $value) {
				$count_subjects = $count_subjects + 1;
				$total_average = $total_average + $value;
				$courses_list = $this->Courses->find('all', ['contain'=>'Subjects'])->where(['Courses.percentage <='=>$value, 'Courses.subject_id'=>$key]);
				foreach ($courses_list as $course) {
					$suit_courses[] = $course->course . " (".$course->subject->subject." ".$course->percentage."%)";
					$suit_courses_ids[] = $course->id;
				}
			}
			if ($count_subjects != 0) {
				$total_average = round($total_average / $count_subjects);
			}
			if (!isset($suit_courses)) {
				$suit_courses[] = 0;
				$suit_courses_ids[] = 0;
			}
			if (!isset($school_lists)) {
				$school_lists[] = 0;
				$school_ids[] = 0;
			}		
			$count_all_subject = $this->Questions->find('all', array('fields'=>'DISTINCT Questions.subject_id'));
			$count_all_subjects = 0;
			foreach ($count_all_subject as $key => $value) {
				$count_all_subjects = $count_all_subjects + 1;
			}
			$find_no_average_details = $this->Userdetails->find('all', ['limit'=>1])->order(['id'=>'desc'])->where(['Userdetails.user_id'=> $this->request->session()->read('Auth.User.id'), 'Userdetails.average IS NULL']);
			$find_no_average_detail = 0;
			foreach ($find_no_average_details as $key => $value) {
				$find_no_average_detail = 1;
				$find_id_detail = $value->id;
			}
			if ($count_all_subjects == count($score_details_ids)){
				$save_details = $this->Userdetails->newEntity();
				$save_details->user_id = $this->request->session()->read('Auth.User.id');
				$save_details->average = $total_average;
				if ($this->Userdetails->save($save_details)) {
				$find_users = $this->Userdetails->find('all', ['limit'=>1])->order(['id'=>'desc'])->where(['Userdetails.user_id'=> $this->request->session()->read('Auth.User.id')]);
				//Save user details
				if ($find_users) {
					foreach ($find_users as $find_user) {
						$test_id = $find_user->id;
						//Save all recommended schools
						foreach ($school_ids as $school_id) {
							$save_schools = $this->Schoollists->newEntity();

							$save_schools->userdetail_id = $find_user->id;
							$save_schools->school_id = $school_id;
							$this->Schoollists->save($save_schools);
						}
						//Save all recommended Courses
						foreach ($suit_courses_ids as $suit_courses_id) {
							$save_course = $this->Courselists->newEntity();

							$save_course->userdetail_id = $find_user->id;
							$save_course->course_id = $suit_courses_id;

							$this->Courselists->save($save_course);
						}
						//Save all Scores
						foreach ($score_details_ids as $key => $score_details_id) {
						$if_subject_exists = false;
							$save_score = array(
							    'Scorelists' => array(
							        'userdetail_id' => $find_user->id,
							        'subject_id' => $key,
							        'score' => $score_details_id,
							        'average' => round($each_average[$key]),
							        'total' => $number_items[$key],
							    )
							);
							$check_subject_exists = $this->Scorelists->find('all')->where(['Scorelists.userdetail_id'=>$find_user->id, 'Scorelists.subject_id'=>$key]);
							foreach ($check_subject_exists as $check_subject_exist) {
								$if_subject_exists = true;
							}
							$save_score = $this->Scorelists->newEntity();

							if ($if_subject_exists == false) {
								$save_score->userdetail_id = $find_user->id;
								$save_score->subject_id = $key;
								$save_score->score = $score_details_id;
								$save_score->average = round($each_average[$key]);
								$save_score->total = $number_items[$key];
								$this->Scorelists->save($save_score);
							}
						}
						//Save questions and answers
						$max_number = 0;
						foreach ($question_lists as $key => $question_list) {
							foreach ($question_list as $value) {
						$max_number = $max_number + 1;
							$save_question = $this->Questionlists->newEntity();

							$save_question->userdetail_id = $find_user->id;
							$save_question->question_id = $value->id;
							$save_question->answer = $user_answers_lists[$max_number];
							$this->Questionlists->save($save_question);
							}
						}
					}
				}
			}
			$this->redirect(['controller'=>'Userdetails','action'=>'view', $test_id]);
			}else if($find_no_average_detail == 0){
				$save_details = $this->Userdetails->newEntity();
				$save_details->user_id = $this->request->session()->read('Auth.User.id');
				$save_details->average = '';
				if ($this->Userdetails->save($save_details)) {
				$find_users = $this->Userdetails->find('all', ['limit'=>1])->order(['id'=>'desc'])->where(['Userdetails.user_id'=> $this->request->session()->read('Auth.User.id')]);
				//Save user details
				if ($find_users) {
					foreach ($find_users as $find_user) {
						$test_id = $find_user->id;
						//Save all recommended schools
						foreach ($school_ids as $school_id) {
							$save_schools = $this->Schoollists->newEntity();

							$save_schools->userdetail_id = $find_user->id;
							$save_schools->school_id = $school_id;
							$this->Schoollists->save($save_schools);
						}
						//Save all recommended Courses
						foreach ($suit_courses_ids as $suit_courses_id) {
							$save_course = $this->Courselists->newEntity();

							$save_course->userdetail_id = $find_user->id;
							$save_course->course_id = $suit_courses_id;

							$this->Courselists->save($save_course);
						}
						//Save all Scores
						foreach ($score_details_ids as $key => $score_details_id) {
						$if_subject_exists = false;
							$save_score = array(
							    'Scorelists' => array(
							        'userdetail_id' => $find_user->id,
							        'subject_id' => $key,
							        'score' => $score_details_id,
							        'average' => round($each_average[$key]),
							        'total' => $number_items[$key],
							    )
							);
							$check_subject_exists = $this->Scorelists->find('all')->where(['Scorelists.userdetail_id'=>$find_user->id, 'Scorelists.subject_id'=>$key]);
							foreach ($check_subject_exists as $check_subject_exist) {
								$if_subject_exists = true;
							}
							$save_score = $this->Scorelists->newEntity();

							if ($if_subject_exists == false) {
								$save_score->userdetail_id = $find_user->id;
								$save_score->subject_id = $key;
								$save_score->score = $score_details_id;
								$save_score->average = round($each_average[$key]);
								$save_score->total = $number_items[$key];
								$this->Scorelists->save($save_score);
							}
						}
						//Save questions and answers
						$max_number = 0;
						foreach ($question_lists as $key => $question_list) {
							foreach ($question_list as $value) {
						$max_number = $max_number + 1;
							$save_question = $this->Questionlists->newEntity();

							$save_question->userdetail_id = $find_user->id;
							$save_question->question_id = $value->id;
							$save_question->answer = $user_answers_lists[$max_number];
							$this->Questionlists->save($save_question);
							}
						}
					}
				}
			}
			$this->redirect(['controller'=>'Tests','action'=>'real-test']);
			}else if($count_all_subjects != count($score_details_ids) && $find_no_average_detail == 1){
				$find_users = $this->Userdetails->find('all', ['limit'=>1])->order(['id'=>'desc'])->where(['Userdetails.user_id'=> $this->request->session()->read('Auth.User.id'), 'Userdetails.id'=>$find_id_detail]);
				$find_all_save_scores = $this->Scorelists->find('all')->where(['Scorelists.userdetail_id'=>$find_id_detail]);
				$find_all_save_score = 0;
				$all_current_save = 0;
				foreach ($find_all_save_scores as $key => $value) {
					$find_all_save_score = $find_all_save_score + 1;
					$all_current_save = $value->average + $all_current_save;
				}
				if (($find_all_save_score + count($score_details_ids)) == $count_all_subjects) {
					$save_details = $this->Userdetails->get($find_id_detail);
					$save_details->average = round(($all_current_save + $total_average)/$count_all_subjects);
					$this->Userdetails->save($save_details);
				}
				//Save user details
				if ($find_users) {
					foreach ($find_users as $find_user) {
						$test_id = $find_user->id;
						//Save all recommended schools
						foreach ($school_ids as $school_id) {
							$save_schools = $this->Schoollists->newEntity();

							$save_schools->userdetail_id = $find_user->id;
							$save_schools->school_id = $school_id;
							$this->Schoollists->save($save_schools);
						}
						//Save all recommended Courses
						foreach ($suit_courses_ids as $suit_courses_id) {
							$save_course = $this->Courselists->newEntity();

							$save_course->userdetail_id = $find_user->id;
							$save_course->course_id = $suit_courses_id;

							$this->Courselists->save($save_course);
						}
						//Save all Scores
						foreach ($score_details_ids as $key => $score_details_id) {
						$if_subject_exists = false;
							$save_score = array(
							    'Scorelists' => array(
							        'userdetail_id' => $find_user->id,
							        'subject_id' => $key,
							        'score' => $score_details_id,
							        'average' => round($each_average[$key]),
							        'total' => $number_items[$key],
							    )
							);
							$check_subject_exists = $this->Scorelists->find('all')->where(['Scorelists.userdetail_id'=>$find_user->id, 'Scorelists.subject_id'=>$key]);
							foreach ($check_subject_exists as $check_subject_exist) {
								$if_subject_exists = true;
							}
							$save_score = $this->Scorelists->newEntity();

							if ($if_subject_exists == false) {
								$save_score->userdetail_id = $find_user->id;
								$save_score->subject_id = $key;
								$save_score->score = $score_details_id;
								$save_score->average = round($each_average[$key]);
								$save_score->total = $number_items[$key];
								$this->Scorelists->save($save_score);
							}
						}
						//Save questions and answers
						$max_number = 0;
						foreach ($question_lists as $key => $question_list) {
							foreach ($question_list as $value) {
						$max_number = $max_number + 1;
							$save_question = $this->Questionlists->newEntity();

							$save_question->userdetail_id = $find_user->id;
							$save_question->question_id = $value->id;
							$save_question->answer = $user_answers_lists[$max_number];
							$this->Questionlists->save($save_question);
							}
						}
					}
				}
				if (($find_all_save_score + count($score_details_ids)) == $count_all_subjects) {
					$this->redirect(['controller'=>'Userdetails','action'=>'view', $test_id]);
				}else{
					$this->redirect(['controller'=>'Tests','action'=>'real-test']);
				}
			}
			$this->set(compact('question_lists', 'choices_lists', 'answer_lists', 'user','user_answers_lists', 'score_details', 'number_items', 'each_average', 'school_lists', 'suit_courses'));	
	    	$this->render()->type('application/pdf'); //Rendering the pdf
	    	}
	}

	public function login(){
		$this->checkLogin();
		$this->viewBuilder()->layout('login');
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
			return $this->redirect(['controller'=>'Home', 'action'=>'index']);
			}else{
				$this->Flash->error('Your username or password is incorrect');
			}
		}
	}
	public function register(){
		$this->checkLogin();
		$this->viewBuilder()->layout('login');
		$this->loadModel('Users');
		$user = $this->Users->newEntity();
		if ($this->request->is('post')) {
			$this->request->data['firstname'] = strip_tags($this->request->data['firstname']);
			$this->request->data['lastname'] = strip_tags($this->request->data['lastname']);
        	$this->request->data['username'] = strip_tags($this->request->data['username']);
			if (preg_match('/\s/',$this->request->data['username'])) {
                $this->Flash->error(__('Invalid username!'));
                return $this->redirect(['action' => 'index']);
            }
			$user = $this->Users->patchEntity($user, $this->request->getData());
			if ($this->Users->save($user)) {
				$this->Flash->success(__('Successfully registered!'));
				$user = $this->Auth->identify();
                if ($user) {
                     $this->Auth->setUser($user);
                    return $this->redirect(['controller'=>'Users', 'action'=>'index']);
                }
			}
			$this->Flash->error('Failed to register, please try again!');
		}
		$locations = $this->Users->Locations->find('list', ['limit' => 200])->order("Locations.city");
		$this->set(compact('user', 'locations'));
        $this->set('_serialize', ['user', 'locations']);
	}
}