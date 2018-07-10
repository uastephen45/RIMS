<?php
   include('Session.php');
?>


<html ng-app="scotchApp">

<head>
  <!-- SCROLLS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" />
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular-route.js"></script>
  <script src="scripts/WelcomePagescript.js"></script>
</head>

<!-- define angular controller -->
<body ng-controller="homeScreenController">

  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">NTR CANOE LIVERY- <?php echo  $_SESSION['login_user'], ' ', $_SESSION['role_id'] ?></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#customersearch"><i class="fa fa-shield"></i>Reservations</a></li>
        <li><a href="#contact"><i class="fa fa-comment"></i> Contact</a></li>
	<li><a href="#admin"><i class="fa fa-suitcase"></i> Admin Console</a></li>
      </ul>
    </div>
  </nav>

  <div id="main">
  
    <!-- angular templating -->
		<!-- this is where content will be injected -->
    <div ng-view></div>
    
  </div>
  
  <footer class="text-center">
    <p>IRMS Version 0.1.1 </p>  
    <p>Brought to you buy the Tricaso development team</p>
  </footer>
  
</body>

</html>

