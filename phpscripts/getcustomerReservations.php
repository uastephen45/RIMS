<?php
	$MoveForward = "false";
	session_start();
	include('Session.php');
	include('AppConfig.php');
	$CustID = $_GET['CustID'];
	if(strlen($_SESSION['login_user'])>0){
		$MoveForward = "True";
	}else{
 		header("HTTP/1.1 403 Forbidden");
		echo "HTTP/1.1 403 Forbidden";
 		exit;
	}

	if($MoveForward=="True"){

$sql = "select R.ID,R.Customer_ID,R.Rental_Status,R.Rental_End_Date,R.Rental_Date,VERS.Status_Reason from Reservations R join ValidEquipmentRentalStatus VERS on R.Rental_Status = VERS.ID where R.Customer_ID = '$CustID' ";
  	      $result = mysqli_query($appdb,$sql,MYSQLI_ASSOC);

	      $rows = array();
	      while($r = mysqli_fetch_assoc($result)) {
   	      	$rows[] = $r;
	      }
	      header('Content-Type: application/json');
	      echo json_encode($rows);
	
}

?>
