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
	}
	tr td{
		 border:1px solid #ccc;
		height:50px;
	}
	*/
	
	.main{
		height:100%;
		text-align:center;
		margin:0px 20px 100px 20px;
	}
	
	body{
		counter-reset: Serial;           /* Set the Serial counter to 0 */
	}
	
	tr td:first-child:before{
		counter-increment: Serial;      /* Increment the Serial counter */
		content: counter(Serial); /* Display the counter */
	}
	
	.btn-secondary{
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
	<h2>Users</h2>
	<table id="example" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>S.No.</th>
				<th>Username</th>
				<th>Email</th>
				<th>Type</th>
				<th>Status</th>
				<th>Created</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>S.No.</th>
				<th>Username</th>
				<th>Email</th>
				<th>Type</th>
				<th>Status</th>
				<th>Created</th>
			</tr>
		</tfoot>
		<?php
		//pr($Users);
		foreach($Users as $User){
			$count = $User['count'];
			$type = $User['role'];
			$status = $User['status'] == 1 ?'Active':'Inactive';
		?>
		<tr>
			<td></td>
			<td><?php echo $User['username']; ?></td>
			<td><?php echo $User['email']; ?></td>
			<td><?php echo $type; ?></td>
			<td><?php echo $status; ?></td>
			<td><?php echo $User['created']; ?></td>
		</tr>
		<?php } ?>
	</table>
</div>

