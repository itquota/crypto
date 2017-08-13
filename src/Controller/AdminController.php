<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class AdminController extends AppController
{
	
	
	function index(){

		//print_r($this->Auth->user());
		//exit;
		$this->loadModel('Users');
		$this->loadModel('Orders');
		
		$Users = $this->Users->find('all',
								   ['group' => 'role']
								  );
		$Users = $Users->select(['count' => $Users->func()->count('*'), 'role']);
		$Users = $Users->toArray();
		//print_r($rows);
		//exit;
		
		$Orders = $this->Orders->find('all',
									  [
									'join' => [
											'table' => 'currencies',
											'alias' => 'Currency',
											'type' => 'left',
											'conditions' => ['Currency.id = Orders.currency_id'],
										],
									]
								  );
		$Orders = $Orders->select(['count' => $Orders->func()->count('*'), 'Orders.order_type','Orders.status','Orders.currency_id','Currency.name'])
			->group(['Orders.order_type','Orders.status','Orders.currency_id'])
			;
		//['group' => ['Orders.order_type','Orders.status','Orders.currency_id']]
		$Orders = $Orders->toArray();
	//	pr($Orders);
		//exit;
		$this->set(compact('Users','Orders'));
	}
	
	
	function orders(){
		//print_r($this->Auth->user());
		//exit;
		//$this->loadModel('wallet_balance');
		
		
		$connection = ConnectionManager::get('default');
		//	$connection->update('wallet_balance', ['total_deposit' => '1'], ['username' => 'virender']);
		
		
		$this->loadModel('Orders');
	//	$order = $this->Orders->find('all');
	/*	$Orders = $order->select(['sum' => $order->func()->sum('amount'),'order_type'])
			->where(['username' => 'virender', 'status' => '1'])
			->group(['Orders.order_type'])->toArray()
		*/	;
		//	pr($Orders);
	
		// exit;
		
		if($this->request->is('POST')){
			$data['status'] = $this->request->data['status'];
			$data['id'] = $this->request->data['id'];
			$user = $this->request->data['user'];
			//print_r($data);
			//exit;
			
			$SaveOrder = $this->Orders->updateAll($data,array("id"=>$data['id']));
			if($SaveOrder){
				$connection->query("update wallet_balance set total_deposit = (select round(sum(amount),2) from orders where username = '$user' and order_type = 1 and status = 1),
		total_withdrawal = (select round(sum(amount),2) from orders where username = '$user' and order_type = 2 and status = 1),
		total_buy = (select round(sum(amount),2) from orders where username = '$user' and order_type = 3 and status = 1),
		total_sell = (select round(sum(amount),2) from orders where username = '$user'  and order_type = 4 and status = 1),
		balance = (round((total_deposit + total_sell - total_withdrawal - total_buy),2))		
		where username = '$user'");
				echo "Status is changed successfully.";	
			}else{
				echo "There is some error, please try again later.";				
			}
			//echo "here";
			exit;
		}
				
		$Orders = $this->Orders->find('all',
									  [
									'join' => [
											'table' => 'currencies',
											'alias' => 'Currency',
											'type' => 'left',
											'conditions' => ['Currency.id = Orders.currency_id'],
										],
									]
								   
								  );
		$Orders = $Orders->select(['Currency.name'])
			->autofields(true);
		
		$Orders = $Orders->toArray();
		//pr($Orders);
		//exit;
		$this->set('Orders',$Orders);
	}
	
	function users(){
		//print_r($this->Auth->user());
		//exit;
		$this->loadModel('Users');

		$Users = $this->Users->find('all');
		//pr($Users);
		//exit;
	
		$this->set('Users',$Users);
		
		
	}
	
	
}

