<?php
	namespace App\Controller;
	use App\Controller\AppController;
	use Cake\Datasource\ConnectionManager;

	class ExchangeController extends AppController{
		function index(){
			$connection = ConnectionManager::get('default');
			$user = $this->Auth->user()['username'];
			$this->loadModel('wallet_balance');
			$this->loadModel('currencies');
			$Order = $this->loadModel('Orders');
			$balance = $this->wallet_balance->findByUsername($user)->first();;

			$currencies = $this->currencies->find('all',[
				'conditions' =>["name !='INR'"],
				'fields' => ['name']
			]);
			
			$order = $this->Orders->newEntity();
			 if ($this->request->is('post')) {
				$data = $this->request->data;
				$data['currency_id'] = $this->request->data['currency'];
				$data['order_type'] = $this->request->data['type'];
				$data['status'] = 1;
				$data['username'] = $this->Auth->user()['username'];
				
				if(empty($data['currency']) || empty($data['qty']) || empty($data['amount'])){
					$this->Flash->error(__('All fields are required.'));
					return $this->redirect(['action' => 'index']);
				}else if($data['amount'] > $balance){
					$this->Flash->error(__('Not enough balance in your wallet.'));
					return $this->redirect(['action' => 'index']);
				}
				 
				$order = $this->Orders->patchEntity($order, $data);
				$connection->begin();
				if ($this->Orders->save($order)) {
					$update = $connection->query("update wallet_balance set balance = (round((balance - '".$data['amount']."'),2))		
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
			
			$this->set(compact('balance','currencies'));
		}
	}
?>
