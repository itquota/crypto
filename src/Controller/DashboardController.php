<?php
namespace App\Controller;
use App\Controller\AppController;

class DashboardController extends AppController
{
	function index(){
		//print_r($this->Auth->user());
		//exit;
		$user = $this->Auth->user();
		$username = $user['username'];
		$this->loadModel('Currencies');
		$this->loadModel('Orders');
		$currencies = $this->Currencies->find('all');
		$orders = $this->Orders->find('all',[
			'conditions' =>  ['username' => $username,  'status' => '1']
		])->toArray();
		//print_r($orders);
		//exit;
		$this->set(compact('currencies','orders'));
		
		
	}
}

