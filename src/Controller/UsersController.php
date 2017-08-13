<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Utility\Security;

class UsersController extends AppController
{
	public function beforeFilter(Event $event)
    {
		
		parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['add', 'logout','kyc','sendMail']);
    }

	public function sendMail(){
		if ($this->request->is('post')) {
			$this->loadModel('VerifiedEmails');
			$email = $this->request->data['email'];
			
			$from = "me@example.com";
			$subject = "Verify Email";
			$key = Security::hash($email, 'sha256', true);
			$host = $this->request->domain();
			//$LinkUrl = "http://".$host."/cake1/v/verifyMail?key=".$key;
			$LinkUrl = ROOTPATH."/v/verifyMail?key=".$key;
		//	echo $LinkUrl;
		//	exit;
			$message = "<p>Please click on the link below to verify your email:</p><p>".$LinkUrl."</p>";
						
			if($this->sendMails($email,$from,$message,$subject)){
				$data['email'] = $email;
				$data['v_key'] = $key;
				$VerifiedEmails = $this->VerifiedEmails->newEntity();
				$user = $this->VerifiedEmails->patchEntity($VerifiedEmails, $data);
				$this->VerifiedEmails->save($user);

				die("success");
			}else{
				die("fail");	
			}
		}
	}
	
    public function login()
    {
		
        if ($this->request->is('post')) {
			//var_dump($_POST);
            $user = $this->Auth->identify();
			//debug($user); die;
			//print_r($user);
			//exit;
            if ($user){
				if( $user['role'] == 'user') {
					$this->Auth->setUser($user);
					//	print_r($this->Auth->user());
					return $this->redirect($this->Auth->redirectUrl());
				}else{
					$this->Auth->setUser($user);
					//	print_r($this->Auth->user());
					return $this->redirect(['controller' => 'Admindashboard','action' => 'index']);
				}
			}else{
				
			//$this->set('loginerror', 'tryagain');
            $this->Flash->error(__('Invalid username or password, try again'));
			}
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
	
	public function reset(){
		//print_r($this->Auth->user());
		//exit;
		$this->autoRender = false;
		if($this->request->is('get') && isset($this->request->query['key'])){
			$this->loadModel('ResetPasswords');
			$key = $this->request->query['key'];
			$userData = $this->ResetPasswords->findByVKey($key)->first();
			$username =	$userData['username']; 
			$data = $this->ResetPasswords->updateAll(array("modified = now(),v_key='' "),array("v_key"=>$key));
			
			if($data){
				$user['username'] = $username;
				$this->Auth->setUser($user);
				
				$this->Flash->set('This is for one time login only. Please change your password.');
				$this->redirect('/change_password');
				
			}else{
				$this->Flash->set('Link has been expired or already used');
				$this->redirect(['controller' => 'users','action' => 'login']);
			}
			
			//print_r($key);
		}else if (!empty($this->request->data)) {
			//$this->autoRender = false;
			$data = $this->request->data;
			$this->loadModel('ResetPasswords');
			$user = $data['user'];
			$user = $this->Users->findByUsername($user)->first();
			$email = $user['email'];

			$Rand = rand();
			$from = "me@example.com";
			$subject = "Reset Password";
			$key = Security::hash($email.$Rand, 'sha256', true);
			$host = $this->request->domain();
			//$LinkUrl = "http://".$host."/cake1/reset?key=".$key;
			$LinkUrl = ROOTPATH."/reset?key=".$key;
			$message = "<p>Please click on the link below to reset your password:</p><p>".$LinkUrl."</p><p>This is for one time only. Please change your password after login.</p>";
			//echo $LinkUrl;
			if($this->sendMails($email,$from,$message,$subject)){
				$data['username'] = $user['username'];
				$data['v_key'] = $key;
				$ResetPasswords = $this->ResetPasswords->newEntity();
				$ResetPassword = $this->ResetPasswords->patchEntity($ResetPasswords, $data);
				$this->ResetPasswords->save($ResetPassword);

				die("success");
			}else{
				die("fail");	
			}
		}
		// $this->set('user', $user);
		
	}
	
/*
     public function index()
     {
        $this->set('users', $this->Users->find('all'));
    }

    public function view($id)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }
*/
    public function changePassword()
    {
		$data = $this->request->data;
		$user= $this->Auth->user();
		$data['username'] = $user['username'];
		
		$user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Password has been changed successfully.'));
              //  return $this->redirect(['action' => 'add']);
            }else{
            	$this->Flash->error(__('Unable to change the password.'));
			}
        }
        $this->set('user', $user);
    }

		
	public function register(){
		$this->loadModel('Register');
		$session = $this->request->session();
		$user = $this->Register->newEntity();
	//	debug($user); die;
        if ($this->request->is('post')) {
			
			$email=$this->request->data['email'];
			$username = $this->request->data['username'];
			$pwd = $this->request->data['password'];
			
			
			$EmailStatus = $this->VerifyEmails($email,true);
			$userExist = $this->checkUser($username,true);
			
			if($userExist == "success"){
				$this->Flash->error(__('Username already exist.'));
				 return $this->redirect(['action' => 'register']);
			}
			
			if($EmailStatus == "success"){
				$data = $this->request->data;
				$data['salt'] = "f80679999ggggbde5e8478d5f906d639d175319045fabedf12cf079dc1d8e28c3bd59b43";
			//	print_r($data);
				//exit;
				$user = $this->Register->patchEntity($user, $data);
				if ($this->Register->save($user)) {
					$session->write('User.reg_username', $username);
					$session->write('User.reg_pwd', $pwd);
					$this->Flash->success(__('The user has been saved.'));
					return $this->redirect(['action' => 'kyc']);
				}else{
					 $this->Flash->error(__('Unable to add the user.'));
					 return $this->redirect(['action' => 'register']);
				}

			}else{
				$this->Flash->error(__('Email not Verified.'));
				 return $this->redirect(['action' => 'register']);
			}
           
        }
		//var_dump($user);
		//exit;
        $this->set('user', $user);
	}
	
	public function kyc(){
		$this->loadModel('Kycs');
		$this->loadModel('Register');
		$session = $this->request->session();
		
		$user = $session->read('User.reg_username');
		$pwd = $session->read('User.reg_pwd');
		if(!$user){
			return $this->redirect(['action' => 'register']);
		}
		//echo $user."<br>";
		$img_types = array("image/png","image/jpeg","image/jpg");
		$kyc = $this->Kycs->newEntity();
        if ($this->request->is('post') ){
			
						// Initialize filename-variable
			$filename = null;
			$path = WWW_ROOT .'files' . DS . 'kyc' . DS .$user;
		//	$path = WWW_ROOT .'files' . DS . 'kyc';
			//echo $path;
			if(!file_exists($path)){
				mkdir($path,0777,true);
			}
			if (!empty($this->request->data['pan_card']['tmp_name']) && is_uploaded_file($this->request->data['pan_card']['tmp_name']) 
				&& in_array($this->request->data['pan_card']['type'],$img_types)
				&& ($this->request->data['pan_card']['size'] <= '100000')) {
				
				// Strip path information
				$filename = $user.'_pan_card_'.time();
				
				move_uploaded_file($this->request->data['pan_card']['tmp_name'],$path. DS . $filename);
				$this->request->data['pan_card'] = $filename;
			}
			
			
			if (!empty($this->request->data['id_proof']['tmp_name']) && is_uploaded_file($this->request->data['id_proof']['tmp_name']) 
				&& in_array($this->request->data['id_proof']['type'],$img_types)
				&& ($this->request->data['id_proof']['size'] <= '100000')) {
				
				// Strip path information
				$filename = $user.'_id_proof_'.time();
				move_uploaded_file(
					$this->request->data['id_proof']['tmp_name'],
					$path. DS . $filename
				);
				$this->request->data['id_proof'] = $filename;
			}
			
			
			if (!empty($this->request->data['address_proof']['tmp_name']) && is_uploaded_file($this->request->data['address_proof']['tmp_name']) 
				&& in_array($this->request->data['address_proof']['type'],$img_types)
				&& ($this->request->data['address_proof']['size'] <= '100000')) {
				// Strip path information
				$filename = $user.'_address_proof_'.time(); 
				move_uploaded_file(
					$this->request->data['address_proof']['tmp_name'],
					$path. DS . $filename
				);
				$this->request->data['address_proof'] = $filename;
			}

			// Set the file-name only to save in the database
			
			$this->request->data['username'] = $user;
			
			//$this->request->data['pan_card'] = "yes";
			//print_r($this->request->data);
			//exit;
			
            $kyc = $this->Kycs->patchEntity($kyc, $this->request->data);
            if ($this->Kycs->save($kyc)) {
				//echo $user;
				$userData = $this->Register->findByUsername($user)->first();
				$usesArray['username'] = $user;
				$usesArray['email'] = $userData['email'];
				$usesArray['password'] = $pwd;
				
				$users = $this->Users->newEntity();
				$users = $this->Users->patchEntity($users, $usesArray);
				$this->Users->save($users);
				$this->Auth->setUser($users);
              //  $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['controller' => 'Dashboard','action' => 'index']);
            }else{
				 $this->Flash->error(__('Unable to add the user.'));
				 return $this->redirect(['action' => 'register']);
			}
           
        }
		//exit;
        $this->set('user', $kyc);
	}
	
}

?>