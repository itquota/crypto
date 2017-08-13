
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

$this->layout = "home";

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace src/Template/Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
$this->Form->templates([
    'inputContainer' => '<div class="div_row">{{content}}</div>'
]);

?>

<style>
		.login{
			text-align:center;
			border: 1px solid #CCC;
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
	}
	
	</style>


<!-- File: src/Template/Users/login.ctp -->

	<div class="gtco-section-overflow">
		<div class="gtco-section" id="gtco-services" data-section="services">
			<div class="gtco-container center">
				<div class="users form login">
				<?php 
					
					//echo $this->Flash->render('auth'); 
					
						echo $this->Flash->render();
					
					?>
					
				<?= $this->Form->create() ?>
					<fieldset>
						<legend><?= __('LOG IN') ?></legend>
						
						<?= $this->Form->input('username') ?>
						<?= $this->Form->input('password') ?>
					</fieldset>
				<?= $this->Form->button(__('Login'),["class" => "btn-primary","style" => "margin:0px 0px 20px 40px;"]); ?>
				<?= $this->Form->end() ?>
					<a href = "javascript:reset();" class = "btn-primary" style = "margin-left:5px;cursor:pointer;display:inline;padding:5px;" >Reset Password</a>
					<a href = "register" class = "btn-primary" style = "margin-left:5px;cursor:pointer;display:inline;padding:5px;" >Sign Up</a>
				</div>
			</div>
		</div>
	</div>				
				
				
				
<script>
	function reset(){
		$("#pop").show();
		$("#pop-title").html("RESET PASSWORD");
		$("#pop-content").html('<label id = "reset_msg" style ="display:block;color:red;width:400px !important;"></label><input type = "text" name = "reset_username" id="reset_user"> <a href = "#" class = "btn-primary" style = "margin-left:5px;cursor:pointer;display:inline;padding:5px;" onclick = "reset_password()">Send Password</a>');
		
	}
	function closePop(){
		$("#pop").hide();
	}
	function reset_password(){
		if($("#reset_user").val()){
			var user = $("#reset_user").val();
		}else{
			$("#reset_msg").prepend('Please enter username to reset your password');
			var user = "";
		}
		//alert(user);
		if(user){
			$("#pop-content").append('<label id = "loader" style = "display:inline;"><?= $this->Html->image('loader.gif',['style'=>'width:20px;']) ?></label>');
			
			  $.ajax({
				url:"reset",
				type: "POST",
				data: {"user":user},
			    success: function(response)
				{
					$("#loader").remove();
					//alert(response);
					if(response == "success"){
						$("#reset_msg").html('Password has been reset. Please check your email to login.');
			
					}

				}
			});
		}
	}
	
</script>				
				
				
				
				
				