<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;


class ValidatesController extends AppController
{
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['verifyMail']);
    }
	
	public function index()
    {
        $this->set('users', $this->Users->find('all'));
    }
	
	public function verifyMail()
	{
		
		if($this->request->is('get')){
			//echo "here";
			$this->loadModel('VerifiedEmails');
			$key = $this->request->query['key'];
			$data = $this->VerifiedEmails->updateAll(array("status"=>"1","updated = now(),v_key='' "),array("v_key"=>$key));
			
			if($data){
				$this->Flash->set('Email has been verified succesfully');
				$this->redirect(['controller' => 'users','action' => 'register']);
				
			}else{
				$this->Flash->set('Link has been expired or already used');
				$this->redirect(['controller' => 'users','action' => 'register']);
			}
			
			//print_r($key);
		}
		//exit;
		if($this->request->data){
			$this->autoRender = false;
			//echo "yes";
			$email=$this->request->data['email'];
			$this->VerifyEmails($email);
		}
		
	}
	
	public function calculateAmount(){
		//		https://coinmarketcap.com/api/
		if($this->request->data){
			$amount = $this->request->data['qty'];
			$from_Currency = $this->request->data['currency'];
			$type = $this->request->data['type'];
			$to_Currency = "INR";
			if($from_Currency == "BTC"){
				if($type == 3){
					$adminChargeType = "buy_btc_charge";
				}else{
					$adminChargeType = "sell_btc_charge";
				}
				
				$get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
				
				$get = explode("<span class=bld>",$get);
				$get = explode("</span>",$get[1]);  
				$converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
				
				//echo round($converted_amount,2);
			}else{
				if($type == 3){
					$adminChargeType = "buy_eth_charge";
				}else{
					$adminChargeType = "sell_eth_charge";
				}
				
				$connected = $this->is_connected();
				
				if($connected){
					$get = file_get_contents("https://api.coinmarketcap.com/v1/ticker/ethereum/?convert=$to_Currency");
					$converted_amounts = json_decode($get);
					$converted_amount = $converted_amounts[0]->price_inr;
					$converted_amount = round($converted_amount * $amount,2);
				}
				//print_r($converted_amount);
				//print_r(round($converted_amounts[0]->price_inr,2));
			}
			
			$this->loadModel('admin_variables');
			$admin_variables = $this->admin_variables->find('all',[
				'conditions' =>['name' => $adminChargeType]
				])->toArray();
			$adminCharge = round($admin_variables[0]['value']*$amount,2);
		//	echo $adminCharge."<br>";
		//	echo $type."<br>";
			if(isset($converted_amount)){
				if($type == 3 ){
					$converted_amount = $converted_amount + $adminCharge;
				}else{
					$converted_amount = $converted_amount - $adminCharge;
				}

				if(is_numeric($converted_amount)){	
					echo round($converted_amount,2);
				}
			}
			 //echo round($converted_amount[0]->price_inr);
			 
		}
		//print_r($this->request->data);
		exit;
	}
	
	

}

?>