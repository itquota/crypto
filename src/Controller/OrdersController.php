<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
//use Cake\Datasource\ConnectionManager;
class OrdersController extends AppController
{
	function index(){
		//print_r($this->Auth->user());
		//$this->loadModel('Currencies');

		//	$conn = ConnectionManager::get('default');
		//	$stmt = $conn->execute('select * from orders left join currencies on currencies.id = orders.currency_id');
		//	$results = $stmt ->fetchAll('assoc');

		$orders = TableRegistry::get('Orders');
		$orders = $orders->find()
			->select(['Orders.amount','Orders.order_type','Orders.status','Orders.txid','c.name'])
			->hydrate(false)
			->autoFields(false)
			->join([
				'table' => 'currencies',
				'alias' => 'c',
				'type' => 'LEFT',
				'conditions' => 'c.id = Orders.currency_id',
			])
			->order('Orders.created')->toArray();

		//debug($orders);
		//exit;
		$this->set('orders',$orders);
	}
}

