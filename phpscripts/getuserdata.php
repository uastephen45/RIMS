<?php
	$MoveForward = "false";
	session_start();
	include('Session.php');
	include('Config.php');
	if(strlen($_SESSION['login_user'])>0){
		$MoveForward = "True";
	}else{
 		header("HTTP/1.1 403 Forbidden");
		echo "HTTP/1.1 403 Forbidden";
 		exit;
	}

	if($MoveForward=="True"){
	      $userID = $_GET['userid'];
	      $sql = "SELECT * FROM Users where User_ID = '$userID'";
  	      $result = mysqli_query($db,$sql,MYSQLI_ASSOC);

	      $rows = array();
	      while($r = mysqli_fetch_assoc($result)) {
   	      	$rows[] = $r;
		
	      }
	      header('Content-Type: application/json');
	      echo json_encode($rows);
	
}

?>
