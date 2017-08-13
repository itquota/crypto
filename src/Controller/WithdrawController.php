<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class WithdrawController extends AppController
{
	function index(){
		//print_r($this->Auth->user());
		$connection = ConnectionManager::get('default');
		$Order = $this->loadModel('Orders');
			$order = $this->Orders->newEntity();
			
			 if ($this->request->is('post')) {

				$data = $this->request->data;
				$data['withdrawee_bank_name'] = $this->request->data['bank_name'];
				$data['withdrawee_bank_address'] = $this->request->data['bank_address'];
				$data['withdrawee_bank_account'] = $this->request->data['bank_account'];
				$data['qty'] = $this->request->data['amount'];
				$data['status'] = 1;
				$data['username'] = $this->Auth->user()['username'];

				$order = $this->Orders->patchEntity($order, $data);
				//print_r($order);
				//			exit;
				 
				 $connection->begin();
				if ($this->Orders->save($order)) {
					$update = $connection->query("update wallet_balance set 
					balance = (round((balance - '".$data['amount']."'),2))		
		where username = '".$data['username']."'");
					if($update){
						$connection->commit();
					}else{
						$connection->rollback();
					}
					
					$this->Flash->success(__('The Order has been placed.'));
					return $this->redirect(['controller' => 'Orders', 'action' => 'index']);
				}else{
					 $this->Flash->error(__('Unable to place this order, please try again..'));
					 return $this->redirect(['action' => 'index']);
				}

			}

		//	$this->set('accounts',$accounts);
	}
}
