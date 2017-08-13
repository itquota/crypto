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
	
<?php echo $this->Html->css('jquery.dataTables.css'); ?>
<?php echo $this->Html->script('jquery.dataTables.js'); ?>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		$('#example').DataTable();
	});
</script>

<style>
	.main{
		height:100%;
		text-align:center;
		margin:0px 20px 100px 20px;
	}
	/*
	table{
		border:1px solid #ccc;
		table-layout: fixed;
		width: 100%;
		border-collapse: inherit;
	}
	th{
		text-align:center;	
		border:1px solid #ccc;
		height:50px;
		padding:5px;
	}
	tr td{
		 border:1px solid #ccc;
		height:50px;
		padding:5px;
	}
	
	*/
	
	body{
		counter-reset: Serial;           /* Set the Serial counter to 0 */
	}
	
	tr td:first-child:before{
		counter-increment: Serial;      /* Increment the Serial counter */
		content: counter(Serial); /* Display the counter */
	}
	
	.btn-secondary{
		display:inline-block;
		background: #FF5126;
		color: #fff;
		border: 2px solid #FF5126 !important;
		padding:2px;
		cursor:pointer;
		text-transform: uppercase;
		margin:2px;
	}
	
	
</style>


	
<div class = "main">
	<h2>Orders</h2>
	<span id = "response"> </span>
	<table id="example" class="display" cellspacing="0" width="100%">
		<thead><tr>
			<th>S.No.</th>
			<th>Username</th>
			<th>Amount</th>
			<th>Type</th>
			<th>Status</th>
			<th>Currency</th>
			<th></th>
			</tr></thead>
		<tfoot><tr>
			<th>S.No.</th>
			<th>Username</th>
			<th>Amount</th>
			<th>Type</th>
			<th>Status</th>
			<th>Currency</th>
			<th></th>
			</tr></tfoot>
		<tbody>
		<?php
		$order_types = array(
			'1' => 'Deposit',
			'2' => 'Withdrawal',
			'3' => 'Buy',
			'4' => 'Sell');
		//pr($order_types);
		foreach($Orders as $Order){
			//$OrderCount = $Order['count'];
			$id = $Order['id'];
			$user = $Order['username'];
			$OrderType = $Order['order_type'];
			if($Order['status'] == 1){
				$OrderStatus = "Accepted";
			}else if ($Order['status'] == 2){
				$OrderStatus = "Rejected";
			}else{
				$OrderStatus = "Pending";
			}
			//$OrderCurrency = $Order['Currency']['name'];
		?>
			<tr>
				<td></td>
				<td><?php echo $user; ?></td>
				<td><?php echo $Order['amount']; ?></td>
				<td><?php echo $order_types[$OrderType]; ?></td>
				<td><?php echo $OrderStatus; ?></td>
				<td><?php echo $Order['Currency']['name']; ?></td>
				<td>
					<span class = "btn-secondary" onclick = "changeStatus('1','<?php echo $id ?>','<?php echo $user ?>')">ACCEPT</span>
					<span class = "btn-secondary" onclick = "changeStatus('2','<?php echo $id ?>','<?php echo $user ?>')">Reject</span>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>


<script>
function changeStatus(status,id,user){
	//alert(id+" "+status);
	$.ajax({
		'type':'POST',
		'url':'',
		'data':{'id':id,'status':status,'user':user},
		'success':function(data){
			//alert(data);	
			$("#response").html(data);
		}
	});
	
}
	
</script>

