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
		.register{
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
<!-- src/Template/Users/add.ctp -->

	<div class="gtco-section-overflow">
		<div class="gtco-section" id="gtco-services" data-section="services">
			<div class="gtco-container center">
				<div class = "register">
					 <?= $this->Form->create($user,['type'=>'POST']);?>
				<?= $this->Flash->render() ?>
					<legend>Register User</legend>
					<?= $this->Form->input('email',['templates' => [
        'inputContainer' => '<div class="div_row" style = "display:inline-block;">{{content}}<div id = "verify_email" style ="display:inline;padding:10px;margin: 0 28px 0 10px;font-size:10px;position:absolute;"><label class = "btn-primary" style = "display:inline;margin-left:5px;cursor:pointer;padding:5px;" onclick = "verify_email();">VERIFY</label></div>
					</div>'
    ],
										 ] ); ?>
					
					
						<?= $this->Form->inputs([						
							'username' => ['type' => 'text'],
							'password'=>['type'=>'password'],
							'confirm_password'=>['type'=>'password'],
							'NEXT' =>  ['type'=>'submit','class' =>'btn btn-primary']
						],['legend'=>'']) ?>


					</form>
				</div>
			</div>
		</div>
		
	</div>

<script>
	function send_email(){
		var email = $("#email").val();
		$("#verify_email").append('<label id = "loader"><?= $this->Html->image('loader.gif',['style'=>'width:20px;']) ?></label>');
		$.ajax({
			'type':'POST',
			'url':'sendMail',
			'data':{'email':email},
			'success':function(data){
				//alert("here");
				$("#loader").remove();
				if(data == "fail"){
					$("#verify_email").html('Please input correct email and click on RESEND button <label class = "btn-primary" style = "margin-left:5px;cursor:pointer;display:inline;padding:5px;" onclick = "send_email();">RESEND</label>');
				}else{
					$("#verify_email").html('Email sent successfully, if not received click on RESEND button <label class = "btn-primary" style = "margin-left:5px;cursor:pointer;display:inline;padding:5px;" onclick = "send_email();">SEND</label>');
				}
			}
		
		});	
	}
	
	function verify_email(){
		var email = $("#email").val();
		$.ajax({
			'type':'POST',
			'url':'v/verifyMail',
			'data':{'email':email},
			'success':function(data){
				//alert("data");
				if(data == "fail"){
					$("#verify_email").html('<?= $this->Html->image('fail.gif',['style'=>'width:20px;']) ?><span>Unverified</span><span>click on SEND button to get verification link on email</span><label class = "btn-primary" style = "margin-left:5px;cursor:pointer;display:inline;padding:5px;" onclick = "send_email();">SEND</label>');
				}else{
					$("#verify_email").html('<?= $this->Html->image('pass.png',['style'=>'width:20px;']) ?><label>Verified</label>');
				}
			}
		
		});	
	}
</script>