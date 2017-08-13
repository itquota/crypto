<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Controller\Component\AuthComponent;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

	
	
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
		
      //  parent::initialize();

        //$this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
      //  $this->loadComponent('Csrf');
	 $this->loadComponent('Auth', [
		 'authorize' => 'Controller',
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
		
		//$this->Auth->config('authorize', ['Controller']);
	
    }

	public function isAuthorized($user = null)
    {
		/*
			// Any registered user can access public functions
			if (!$this->request->getParam('prefix')) {
				return true;
			}

			// Only admins can access admin functions
			if ($this->request->getParam('prefix') === 'admin') {
				return (bool)($user['role'] === 'admin');
			}
	*/
				
		if(($this->Auth->user('role')=="admin") && ($this->request->params['controller'] == "Admin")){
			return true;
		 }else if(($this->Auth->user('role')=="user") && ($this->request->params['controller'] != "Admin")){
			return true;
		 }else{
			$this->redirect(['controller' => 'Users', 'action' => 'logout']);	
			//$this->redirect('/logout');	
		}
        // Default deny
        return false;
    }

	
    public function beforeFilter(Event $event)
    {
		//print_r($this->controller);
	//	exit;
		      //  $this->Auth->deny();
		$this->set('authUser', $this->Auth->user());
        $this->Auth->allow(['reset','view', 'display','register','sendMails','VerifyEmails','services','portfolio','blog','contact']);
    }
	
	
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
	
	
	public function sendMails($to,$from,$message,$subject){
		//$email = $to;
		//print_r($to);
	$email = new Email('default');
		$email->from([$from => ''])
		->to($to)
		->subject($subject)
		->emailFormat('both')
		->send($message);
		
		$email = new Email('default');


		//print_r($email);
		return $email;
	}
	
	public function VerifyEmails($email,$return = false){
	
		$this->loadModel('VerifiedEmails');
		$verified_emails = $this->VerifiedEmails->find('all',array(
										 'conditions'=>array('email'=>$email,'status=1')
									 ));
		//$verified_emails->hydrate(false);
		$data = $verified_emails->first();
		
		//print_r($data);
		if(!empty($data)){
			$msg = "success";
		}else{
			$msg = "fail";	
		}
		if($return){
			return $msg;
		}else{
			echo $msg;
			exit;
		}
	}
	
	public function checkUser($username,$return = false){
	
		$this->loadModel('Users');
		$Users = $this->Users->find('all',array(
										 'conditions'=>array('username'=>$username,'status=1')
									 ));
		//$verified_emails->hydrate(false);
		$data = $Users->first();
		
	//	print_r($data);
		if(!empty($data)){
			$msg = "success";
		}else{
			$msg = "fail";	
		}
	//	echo $msg;
		if($return){
			return $msg;
		}else{
			echo $msg;
			exit;
		}
	}


	public function returnMsg($msg,$return){
		if($return){
			return $msg;
		}else{
			echo $msg;
			exit;
		}

	}

		

		public function is_connected()
		{
			$connected = @fsockopen("www.example.com", 80); 
												//website, port  (try 80 or 443)
			if ($connected){
				$is_conn = true; //action when connected
				fclose($connected);
			}else{
				$is_conn = false; //action in connection failure
			}
			return $is_conn;

		}

	
}
