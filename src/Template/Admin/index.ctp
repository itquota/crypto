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

$this->layout = "admindashboard";

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
		table-layout: fixed;
		width: 100%;
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
	
	.pannel{
		height:100%;
		text-align:center;
		margin-bottom:20px;
		box-shadow: 0 0 5px #ccc;
		padding: 20px;
	}
</style>

<div class = "pannel">
	<h2>Users</h2>
<table>
	<tr>
		<th>Registered Users</th>
		<th>Type</th>
	</tr>
	<?php
	foreach($Users as $User){
		$count = $User['count'];
		$type = $User['role'];
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $type; ?></td>
	</tr>
	<?php } ?>
	
</table>


</div>


	
<div class = "pannel">
	<h2>Orders</h2>
<table>
	<tr>
		<th>Orders</th>
		<th>Type</th>
		<th>Status</th>
		<th>Currency</th>
	</tr>
	<?php
	$order_types = array(
		'1' => 'Deposit',
		'2' => 'Withdrawal',
		'3' => 'Buy',
		'4' => 'Sell');
	//pr($order_types);
	foreach($Orders as $Order){
		$OrderCount = $Order['count'];
		$OrderType = $Order['order_type'];
		if($Order['status'] == 1){
			$OrderStatus = "Accepted";
		}else if ($Order['status'] == 2){
			$OrderStatus = "Rejected";
		}else{
			$OrderStatus = "Pending";
		}
		$OrderCurrency = $Order['Currency']['name'];
	?>
	<tr>
		<td><?php echo $OrderCount; ?></td>
		<td><?php echo $order_types[$OrderType]; ?></td>
		<td><?php echo $OrderStatus; ?></td>
		<td><?php echo $OrderCurrency; ?></td>
	</tr>
	<?php } ?>
	
</table>


</div>


