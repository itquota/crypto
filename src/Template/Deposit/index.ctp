<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = "dashboard";

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
$this->Form->templates([
    'inputContainer' => '<div class="div_row">{{content}}</div>'
]);

?>

<style>
		.deposit{
			text-align:center;
			padding:10px;
			margin:20px;
		}
		.div_row{
			padding:10px;
		}
		input{
			width:220px;	
		}
		label{
			display:inline-block;
			text-align:left !important;
			width:200px;
		}
		#form{
			display:none;	
		}
		#address{
			text-align:center;	
		}
		pre{
			text-align:left;	
			width:95%;
		}
		.btns{
			width:150px;
			height:40px;
			cursor:pointer;
		}
	span{
		display:inline-block;
		cursor:pointer;
		padding:5px;
	}
	
	</style>

<div class="gtco-section-overflow">

		
			<div class="gtco-container">
				
				<div id =  "address">
					Please deposit to this account and click on NEXT:
					
					<?php
						foreach($accounts as $account){
							if($account['name'] == "holder_name"){
								//echo "Receiver: ".$account['value']."<br>";
								$receiver = $account['value'];
							}
							if($account['name'] == "account_number"){
								//echo "A/C: ".$account['value']."<br>";
								$account_number = $account['value'];
							}
							if($account['name'] == "bank_name"){
								//echo "Bank Name: ".$account['value']."<br>";
								$bank_name = $account['value'];
							}
							if($account['name'] == "ifsc"){
								//echo "IFSC Code: ".$account['value']."<br>";
								$ifsc = $account['value'];
							}
						}
					?>
					
					<pre>
						Receiver： <?php echo $receiver."<br>"; ?>
						A/C： <?php echo $account_number."<br>"; ?>
						BANK NAME：<?php echo $bank_name."<br>"; ?>
						IFSC Code: <?php echo $ifsc."<br>"; ?>
					</pre>
					<span class = "btn-primary btns" style = "" onclick = "$('#form').show();$('#address').hide();">NEXT</span>
				</div>
			
				
				<div class="deposit" id = "form" >
					
					 <?= $this->Form->create('Order',['type'=>'POST']);?>
				<?= $this->Form->inputs([						
							'full_name' => ['type' => 'text'],
							'amount'=>['type'=>'text'],
							'comment'=>['type'=>'text'],
							'payment_reference'=>['type'=>'text'],
							'order_type'=>['type'=>'hidden', 'value' => '1'],
							'SUBMIT' =>  ['type'=>'submit','class' =>'btn btn-primary']
						],['legend'=>'Deposit INR']) ?>	
				</div>
			</div>
		

	</div>



	
