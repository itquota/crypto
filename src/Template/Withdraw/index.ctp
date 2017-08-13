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
	.withdraw{
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
		<div class="withdraw" id = "form" >
			<?= $this->Form->create('Order',['type'=>'POST']);?>
			<?= $this->Form->inputs([						
					'full_name' => ['type' => 'text'],
					'amount'=>['type'=>'text'],
					'bank_name'=>['type'=>'text'],
					'bank_address'=>['type'=>'text'],
					'bank_account'=>['type'=>'text'],
					'comment'=>['type'=>'text'],
					'order_type'=>['type'=>'hidden', 'value' => '2'],
					'SUBMIT' =>  ['type'=>'submit','class' =>'btn btn-primary']
				],['legend'=>'Withdraw INR']) ?>	
		</div>
	</div>
</div>


	
