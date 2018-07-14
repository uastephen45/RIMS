<?php
   include('Session.php');
?>

<html ng-app="scotchApp">

	<head>
		<title>IRMS</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		  <!-- SCROLLS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" />
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-route.js"></script>
		<script src="scripts/WelcomePagescript.js"></script>
		
	</head>
	<body ng-controller="homeScreenController" class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="Welcome.php" class="logo"><strong>RIMS</strong></a>
								</header>

							<!-- Content -->
								<section>
									  <div id="main">
										<div ng-view>
											<!-- this is where content will be injected -->
										</div>
									  </div>
								</section>
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2><a href="#">NTR Canoe Livery - </a></h2>
											<h4> Hello, <?php echo  $_SESSION['login_user'] ?></h4>
									</header>
									<ul>
										<li><a href="#">Home</a></li>
										<li><a href="#customersearch">Reservations</a></li>
										<li><a href="#contact"> Contact</a></li>
										<li>
											<span class="opener">User Menu</span>
											<ul>
												<li><a href="#admin">Create User</a></li>
												<li><a href="#admin">Modify User</a></li>
												<li><a href="#admin">Delete User</a></li>
											</ul>
										</li>
									</ul>
								</nav>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Our contact info</h2>
									<ul class="contact">
										<li class="fa-envelope-o"><a href="#">NTR@bright.net</a></li>
										<li class="fa-phone">(330) 874-2002</li>
										<li class="fa-home">11358 OH-212, <br/>
										Bolivar, OH 44612</li>
									</ul>
								</section>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; The Tricaso Development Team. All rights reserved.</p>
								</footer>
						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>