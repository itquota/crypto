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
?>

				
	<div class="gtco-section-overflow">

		
		<div class="gtco-section" id="gtco-portfolio" data-section="portfolio">
			<div class="gtco-container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center gtco-heading">
						<h2>Portfolio</h2>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<a href="images/img_2.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_2.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>
					<div class="col-md-4">
						<a href="images/img_1.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_1.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>
					<div class="col-md-4">
						<a href="images/img_3.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_3.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>

					<div class="col-md-4">
						<a href="images/img_4.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_4.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>
					<div class="col-md-4">
						<a href="images/img_5.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_5.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>
					<div class="col-md-4">
						<a href="images/img_6.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_6.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>

					<div class="col-md-4">
						<a href="images/img_2.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_2.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>
					<div class="col-md-4">
						<a href="images/img_1.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_1.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>
					<div class="col-md-4">
						<a href="images/img_3.jpg" class="gtco-card-item image-popup" title="Project name here.">
							<figure>
								<div class="overlay"><i class="ti-plus"></i></div>
								<img src="images/img_3.jpg" alt="Image" class="img-responsive">
							</figure>
						</a>
					</div>

				</div>
			</div>
		</div>
	</div>
	