<?php
namespace App\Controller;

use App\Controller\AppController;

class DepositController extends AppController
{

	function index(){
		//print_r($this->Auth->user());
		//$user = $this->Auth->user()['username'];
		//print_r($user);
		$this->loadModel('Orders');
		$this->loadModel('accounts');
		
		$accounts = $this->accounts->find('all')
			->select(array('id','type','name','value'))
			->where(array('type' => 'INR', 'status' => '1'))
			->toArray();
		//var_dump($accounts);
		//pr($this->request);
		foreach($accounts as $account){
			$account_ids_array[] = $account['id'];
		}
		$account_ids = implode(',',$account_ids_array);
		
		$order = $this->Orders->newEntity();

		 if ($this->request->is('post')) {
			 
			$data = $this->request->data;
			 $data['account_id'] = $account_ids;
			 $data['qty'] = $data['amount'];
			 $data['username'] = $this->Auth->user()['username'];
			
			$order = $this->Orders->patchEntity($order, $data);
			//print_r($order);
			//			exit;
			if ($this->Orders->save($order)) {
				$this->Flash->success(__('The Order has been placed.'));
				return $this->redirect(['controller' => 'Orders', 'action' => 'index']);
			}else{
				 $this->Flash->error(__('Unable to place this order, please try again..'));
				 return $this->redirect(['action' => 'index']);
			}

		}

		$this->set('accounts',$accounts);
	}

	
	
}

