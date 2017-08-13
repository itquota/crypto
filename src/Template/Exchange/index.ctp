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
	.form-control{
		background:#FF5126;
		margin:2px;
		color:#fff;
	}
	
	.form-control::placeholder{
		color:#fff;
	}
	
	.form-control[type="radio"]{
		display:none;
	}
	
	input[type="radio"]:checked+label {
		background-color: #fff;
		border: 1px solid #FF5126;
		color:#FF5126;
	}
	.error{
		color:red;	
	}
	
	.btn1{
		width: 60%;
		color: #FF5126;
		background: #fff;	
	}
</style>

<div class="gtco-section-overflow">

		<div class="gtco-section" id="gtco-services" data-section="trade" style = "padding-top:10px;">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-6">
						<div class="gtco-heading">
							<h2 class="gtco-left">Currency Exchange</h2>
							<p>You can buy or sell any digital currency with your wallet balance.</p>
							<div>Wallet Balance: <span id = "wallet_bal"><?php echo number_format($balance->balance,'2','.',''); ?></span> in INR</div>
						</div>
					</div>
				</div>
				<form method = "POST">
				<div class="row">
					<div class="col-md-12 form-inline" style = "text-align:center;">
						<div id = "currency_div" >
							<select class = "form-control" id = "currency" name = "currency" >
								<option value = "">Select</option>
								<?php
									foreach($currencies as $Currency){
										$currency = $Currency['name'];
										echo "<option value = '$currency'>$currency</option>";
									}
								?>
							</select>
							<div id = 'currency_error' class = 'error'></div>
						</div>
						<div id = "qty_div" >
							<input type = "text" id = "qty" name = "qty" class = "form-control" placeholder= "Enter quantity" />
							<div id = 'qty_error' class = 'error'></div>
						</div>
						<div id = "types">
							<input type = "radio" id = "buy" name = "type" class = "form-control" value = "3" onclick = "changeStatus('3')"/>
							<label for = "buy" class = "form-control" style = "margin:0;cursor:pointer;">BUY</label>
							<input type = "hidden" id = "amount" name = "amount" class = "form-control" placeholder= "Amount" />
							<label id = "amount_label" class = "form-control"  style = "width:200px;margin:2px;">Amount</label>
							
							<input type = "radio" id ="sell" name = "type" value = "4" class = "form-control" onclick = "changeStatus('4')"/>
							<label for = "sell" class = "form-control"  style = "margin:0;cursor:pointer;">SELL</label>
						</div>
						<div id = 'amount_error' class = 'error'></div>
						<div id = "wallet_div" style = "display:none;">
							
						</div>
						<div id="gtco-subscribe" style ="padding:10px;">
							<input type = "submit" class = "btn1" value = "SUBMIT" />	
						</div>
					</div>	
				</div>
				</form>		
			</div>
		</div>

	</div>
<script>
function changeStatus(type){
	var currency = $("#currency").val();
	var wallet_bal = <?php echo round($balance->balance,2) ?>;
	var qty = $("#qty").val();
//	alert(wallet_bal);
	if(!currency){
		$("#currency_error").text("Please select currency");
	}else{
		$("#currency_error").text("");
	}
	if(!qty){
		$("#qty_error").text("Please enter quantity");
	}else{
		$("#qty_error").text("");
	}
	
	
	//return false;
	//alert("here");
	if((currency) && (qty)){
		var flag = true;
		if($("#loader").length <= 0){
			if(flag){
				if(type == 3){
					$("#types").prepend("<span id = 'loader' style ='width:20px;height:20px;'><img src = 'images/loader.gif' width = '30px'></span>");
				}else{
					$("#types").append("<span id = 'loader' style ='width:20px;height:20px;'><img src = 'images/loader.gif' width = '30px'></span>");
				}
			}
			$.ajax({
				'type':'POST',
				'url':'v/calculateAmount',
				'data':{'currency':currency,'qty':qty,'type':type},
				'success':function(data){
					

					if(data > wallet_bal){
					//	alert(data+" > "+wallet_bal);
						$("#amount").val("");
						$("#amount_label").text("Amount");
						alert("Not enough balance in your wallet");
						flag = false;
					}else{
						$("#wallet_div").show();
						if(type == 3){
							flag = false;
							$("#wallet_div").html('<input type = "text" id = "wallet_addr" name = "wallet_addr" class = "form-control" style = "width:500px;" placeholder= "Enter wallet address" /><div id = "wallet_error" class = "error"></div>');
						}else{
							$.ajax({
								'type':'POST',
								'url':'qrcode.php',
								'data':{'currency':currency,'qty':qty,'type':type},
								'success':function(result){
									$("#wallet_div").html(result);
									flag = false;
									if(flag == false){
										$("#loader").remove();
									}
								}
							});
							
						}
						
						$("#amount").val(data);
						$("#amount_label").text(data);
					}
					if(flag == false){
						$("#loader").remove();
					}
				}
			});
		}
	}
}
	
$('form').submit(function () {
	var currency = $("#currency").val();
	var wallet_bal = <?php echo round($balance->balance,2) ?>;
	var qty = $("#qty").val();
	var amount = $("#amount").val();
	var wallet_addr = $("#wallet_addr").val();
	//	alert(wallet_bal);
	var error_flag = false;
	if(!currency){
		error_flag = true;
		$("#currency_error").text("Please select currency");
	}else{
		$("#currency_error").text("");
	}
	if(!qty){
		error_flag = true;
		$("#qty_error").text("Please enter quantity");
	}else{
		$("#qty_error").text("");
	}
	if(!amount){
		error_flag = true;
		$("#amount_error").text("Please enter amount");
	}else{
		$("#amount_error").text("");
		if(amount > wallet_bal){
			error_flag = true;
			alert("Not enough balance in your wallet");
		}
	}
	
	if(!amount){
		error_flag = true;
		$("#wallet_addr").text("Please enter amount");
	}else{
		$("#wallet_addr").text("");
		if(amount > wallet_bal){
			error_flag = true;
			alert("Not enough balance in your wallet");
		}
	}
	
	if(error_flag){
		return false;	
	}
});
</script>
			