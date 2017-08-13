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

<?php echo $this->Html->css('jquery.dataTables.css'); ?>
<?php echo $this->Html->script('jquery.dataTables.js'); ?>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
		$('#example').DataTable();
	});
</script>

<style>
/*
	table{
		border:1px solid #ccc;
		border-collapse:inherit;
		table-layout: fixed;
		width: 95%;
	}
	th{
		text-align:center;	
		border:1px solid #ccc;
		height:50px;
	}
	tr td{
		border:1px solid #ccc;
		height:50px;
		text-align:center;
		
	}
*/	
</style>

<div style = "margin:0px 20px 100px 20px;">
	<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>Amount</th>
				<th>Order Type</th>
				<th>Currency</th>
				<th>TX ID</th>
				<th>Type</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>S.No.</th>
				<th>Amount</th>
				<th>Order Type</th>
				<th>Currency</th>
				<th>TX ID</th>
				<th>Type</th>
			</tr>
		</tfoot>
		<tbody>
		<?php
			$balance = 0;
			$i=1;
			foreach($orders as $order){
				//	var_dump($order);
				$type = ($order['order_type']==1)?'Deposit':'Withdrawal';
				$status = ($order['status']==1)?'Accepted':'Pending';
				//echo $currency;
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $order['amount']; ?></td>
				<td><?php echo $type; ?></td>
				<td> <?php echo $order['c']['name']; ?> </td>
				<td><?php echo $order['txid']; ?></td>
				<td><?php echo $status; ?> </td>
			</tr>
			<?php 
				$i++;
			}
		?>
		</tbody>
	</table>
</div>



	
