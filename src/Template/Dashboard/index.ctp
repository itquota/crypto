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
	table{
		border:1px solid #ccc;
		border-collapse:inherit;
		table-layout: fixed;
		width: 98%;
	}
	th{
		text-align:center;	
		border:1px solid #ccc;
		height:50px;
	}
	tr td{
		 border:1px solid #ccc;
		height:50px;
		
	}
</style>

<div style = "height:100%;text-align:center;">
<table>
	<tr>
		<th>Currency</th>
		<th>Balance</th>
		<th>Total Deposit</th>
		<th>Total Withdrawal</th>
		<th>Type</th>
		
	</tr>
	<?php
	//print_r($orders);
	$balance = 0;
	//$data = array_search('order_type',array_keys($orders));
//	print_r($orders[$data]);
	foreach($currencies as $currency){
		$name = $currency['name'];
		$type = $currency['type'];
		$deposit = 0;
		$withdrawal = 0;
		//echo $currency;
	
	?>
	<tr>
		<td><?php echo $name; ?></td>
		<td><?php echo $balance; ?></td>
		<td><?php echo $deposit; ?> </td>
		<td> <?php echo $withdrawal; ?> </td>
		<td><?php echo $type; ?></td>
		
	</tr>
	<?php } ?>
	
</table>


</div>


	
