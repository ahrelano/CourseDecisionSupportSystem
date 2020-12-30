<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth',[
            'authenticate'=>[
                'Form'=>[
                    'fields'=>[
                        'username'=>'username',
                        'password'=>'password'
                    ],
                    'userModel' => 'Users'
                ]
            ],
            'loginAction'=>[
                'controller'=>'Tests',
                'action'=>'login'
            ]
            ]);
    }
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function addPhotos($images){
        $imageFileName = null;
            if (!empty($images['name'])) {
                    $file = $this->request->data['img']; //put the data into a var for easy use
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/questions/' . $setNewFileName . '.' . $ext);
                        //prepare the filename for database entry 
                        if (isset($imageFileName)) {
                            $imageFileName = $imageFileName . ' ' . $setNewFileName . '.' . $ext;
                        }else{
                            $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
            }
        return $imageFileName;
    }

    public function addChoices($images){
        $imageFileName = null;
            if (!empty($images['name'])) {
                    $file = $images; //put the data into a var for easy use
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
                    $setNewFileName = time() . "_" . rand(000000, 999999);

                    //only process if the extension is valid
                    if (in_array($ext, $arr_ext)) {
                        //do the actual uploading of the file. First arg is the tmp name, second arg is 
                        //where we are putting it
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . '/img/choices/' . $setNewFileName . '.' . $ext);
                        //prepare the filename for database entry 
                        if (isset($imageFileName)) {
                            $imageFileName = $imageFileName . ' ' . $setNewFileName . '.' . $ext;
                        }else{
                            $imageFileName = $setNewFileName . '.' . $ext;
                        }
                    }
            }
        return $imageFileName;
    }

    public function checkLogin(){
        if ($this->request->session()->check('Auth.User')) {
            return $this->redirect(['controller'=>'Users', 'action'=>'index']);
        }
    }
}
