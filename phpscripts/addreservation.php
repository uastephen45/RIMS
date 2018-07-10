<?php
//TODO fix this so it's secure
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
	$CustomerID = $_GET['CustomerID'];
        $RentalDate= $_GET['RentalDate'];
	$RentalDate_End = $_GET['RentalDateEnd'];
                
	$sql = "INSERT INTO Reservations (Customer_ID,Rental_Status,Rental_Date,Rental_End_Date) VALUES ('$CustomerID','1','$RentalDate','$RentalDate_End')";
	      
	$value1 =  mysqli_query($appdb,$sql,MYSQLI_ASSOC);
	
	if($value1){
	$sql = "SELECT LAST_INSERT_ID() as NewID";
	$result2 = mysqli_query($appdb,$sql,MYSQLI_ASSOC);
	$rows = array();
	while($r =  mysqli_fetch_assoc($result2)){
	$rows[] = $r;
	}
	echo json_encode($rows);



        header('Content-Type: application/json');
        header("HTTP/1.1 201 Success");
        }else{
	header("HTTP/1.1 505 Failure");
        }


?>
