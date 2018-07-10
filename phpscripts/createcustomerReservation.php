<?php
	$CustID = $_GET['customerid'];
	$RentDate = $_GET['rentaldate'];
	$RentStatus = $_GET['rentalstatus'];


	$MoveForward = "false";
	session_start();
	include('Session.php');
	include('AppConfig.php');
	if(strlen($_SESSION['login_user'])>0){
		$MoveForward = "True";
	}else{
 		header("HTTP/1.1 403 Forbidden");
		echo "HTTP/1.1 403 Forbidden";
 		exit;
	}

	if($MoveForward=="True"){

	      $sql = "INSERT INTO Reservations (Customer_ID, Rental_Status, Rental_Date) VALUES ('$CustID', '$RentStatus', '$RentDate')";
  	      echo $sql;      
	if(mysqli_query($appdb,$sql,MYSQLI_ASSOC)){
		header('Content-Type: application/json');
		header("HTTP/1.1 201 Succes");
		}else{
		header("HTTP/1.1 505 Failure");
		}

	     }

?>
