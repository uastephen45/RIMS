<!DOCTYPE HTML>
<!--
	Editorial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Login Page</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="Login.php" class="logo"><strong>RIMS</strong></a>
								</header>

							<!-- Content -->
								<section>
									<header class="main">
										<h1>RIMS</h1>
									</header>

									<span class="image main"></span>

									   <body>
	
										  <div>
											 <div>
												<div><b>Login</b></div>
													
												<div>
												   
												   <form action = "" method = "post">
													  <label>Username: </label><input type = "text" name = "username" class = "box"/><br /><br />
													  <label>Password: </label><input type = "password" name = "password" class = "box" /><br/><br />
													  <input type = "submit" value = " Submit "/><br />
												   </form>
												   
												   <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
												</div>
											 </div>
										  </div>
								</section>
						</div>
					</div>
			</div>
		<!-- Footer -->
			<footer id="footer">
				<p class="copyright">&copy; The Tricaso Development Team. All rights reserved.</p>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>