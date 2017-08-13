<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bitcoin Ether Coin Exchange</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  	

	<!-- <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet"> -->
	<?php  
		
		echo $this->Html->css(['animate.css', 'icomoon.css', 'themify-icons.css', 'bootstrap.css', 'magnific-popup.css', 'owl.carousel.min.css',
							   'owl.theme.default.min.css','flexslider.css','style.css','animate.css' ]);
		//echo $this->Html->css('icomoon.css');
		//echo $this->Html->css('themify-icons.css');
		//echo $this->Html->css('bootstrap.css');
		?>

	<!-- Modernizr JS -->
		<?php echo $this->Html->script(array( 'jquery.min.js','jquery.easing.1.3.js','bootstrap.min.js','jquery.waypoints.min.js','owl.carousel.min.js',
								'jquery.countTo.js','jquery.flexslider-min.js','jquery.magnific-popup.min.js','magnific-popup-options.js','main.js')); ?>
		<?php echo $this->Html->script('modernizr-2.6.2.min.js'); ?>
		
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
		
		
		<style>
		#menu{
			width:300px;
			position: absolute;
			height:100%;
			padding-top: 70px;
			float:left;
		}
		#menu li{
			padding: 10px;
			border-bottom-color: #ccc;
			border-bottom-style: double;
			display:block;
		}
		#menu ul{
			list-style-type:none;
			width:300px;
			padding-left: 0px;
		}
			
		#content{
			float:left;
			margin-left:300px;
			padding-top:90px;
			border-left-color: #ccc;
			border-left-style: solid;
			min-height:550px;
			padding-left:10px;
			width:76%;
		}
		
		footer{
			background-color:#ccc;
			padding:3em !important;
		}
			
		</style>

	</head>
	<body>
	<div class="gtco-loader"></div>
	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-sm-2 col-xs-12">
					<div id="gtco-logo"><a href="index.html">Asymmetry <em>.</em></a></div>
				</div>
				<div class="col-xs-10 text-right menu-1 main-nav">
					<ul>
						<li><a href="<?php  echo ROOTPATH; ?>" data-nav-section="home"  class="external">Home</a></li>
						<li><a href="services" data-nav-section="services"  class="external">Services</a></li>
						<li><a href="portfolio" data-nav-section="portfolio"  class="external">Portfolio</a></li>
						<li><a href="blog" data-nav-section="blog"  class="external">Blog</a></li>
						<li><a href="contact" data-nav-section="contact"  class="external">Contact</a></li>
						<li><a href="<?php echo ROOTPATH; ?>/logout" data-nav-section="logout"  class="external">Sign Out</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
	
	<div id = "page-wrapper">		
		<nav class="gtco-nav" role=" navigation" style = "position: relative; z-index: 0;">	
			<div id = "menu" class="main-nav">
				<ul>
					<li class = "active"><a href="<?php  echo ROOTPATH; ?>/admindashboard" data-nav-section="dashboard"  class="external">Admin Dashboard</a></li>
				<!--	<li><a href="admin/trade" data-nav-section="trade" class="external">Trade</a></li>  -->
					<li><a href="<?php  echo ROOTPATH; ?>/admin/users" data-nav-section="deposit" class="external">Users</a></li>
					<li><a href="<?php  echo ROOTPATH; ?>/admin/orders" data-nav-section="orders"  class="external">Orders</a></li>
				</ul>
			</div>
		</nav>


		<div id = "content">
		<?= $this->fetch('content') ?>
		</div>
	</div>
	<footer id="gtco-footer" role="contentinfo">
		<div class="gtco-container">
			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://gettemplates.co/" target="_blank">GetTemplates.co</a> Demo Images: <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p class="pull-right">
						<ul class="gtco-social-icons pull-right">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>


	</body>
</html>

