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
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
		
	</head>
	<body>
	<div class="gtco-loader"></div>
	<div id = "pop" >
		<div id = "inner-pop">
			<div id = "pop-header">
			<div id = "pop-title"></div>	
			<div id = "close" onclick = "closePop()">X</div>
			</div>
			<div id = "pop-content"></div>
		</div>	
	</div>
	<div id="page">
	<nav class="gtco-nav" role="navigation">
		<div class="gtco-container">
			<div class="row">
				<div class="col-sm-2 col-xs-12">
					<div id="gtco-logo"><a href="index.html">Asymmetry <em>.</em></a></div>
				</div>

				<div class="col-xs-10 text-right menu-1 main-nav">
					<ul>
						<li class="active"><a href="<?php  echo ROOTPATH; ?>" data-nav-section="home"  class="external">Home</a></li>
						<li><a href="services" data-nav-section="services"  class="external">Services</a></li>
						<li><a href="portfolio" data-nav-section="portfolio"  class="external">Portfolio</a></li>
						<li><a href="blog" data-nav-section="blog"  class="external">Blog</a></li>
						<li><a href="contact" data-nav-section="contact"  class="external">Contact</a></li>
						<?php
							//	print_r($authUser);
							if($authUser){
								echo '<li><a href="logout" data-nav-section="logout"  class="external">Sign Out</a></li>';
							}else{
						?>
							<li><a href="login" data-nav-section="login"  class="external">Sign in</a></li>
						<?php } ?>
						
					</ul>
				</div>
			</div>
		</div>
	</nav>
    <?= $this->fetch('content') ?>
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
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

