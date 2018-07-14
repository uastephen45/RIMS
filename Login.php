<?php
   include("Config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = $_POST['username'];
      $mypassword = $_POST['password']; 
      $sql = "SELECT User_ID FROM Users WHERE User_Name = '$myusername' and User_Password = '$mypassword' and User_Active = 1";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        
      $sql = "SELECT User_Role_ID FROM Users WHERE User_Name = '$myusername' and User_Password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $_SESSION['role_id'] = $row['User_Role_ID'];

         $_SESSION['login_user'] = $myusername;
        //session_register("myusername");
	  
         header("location: Welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>


<!DOCTYPE HTML>
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