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
		<div class="gtco-section" id="gtco-services" data-section="change_password">
			<div class="gtco-container center">
				<div class = "register">
					 <?= $this->Form->create($user,['type'=>'POST']);?>
				<?= $this->Flash->render() ?>
					<legend>Change Password</legend>
					
					
						<?= $this->Form->inputs([						
							'password'=>['type'=>'password'],
							'confirm_password'=>['type'=>'password'],
							'CHANGE' =>  ['type'=>'submit','class' =>'btn btn-primary']
						],['legend'=>'']) ?>


					</form>
				</div>
			</div>
		</div>
		
	</div>

