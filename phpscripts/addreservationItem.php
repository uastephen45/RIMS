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

	$resID = $_GET['resID'];
        $equipmentID= $_GET['equipmentID'];
	$equipmentDurID= $_GET['equipmentDurID'];
	$Equipment_Count = $_GET['equipmentCount'];
	$Equipment_Count_Adult= $_GET['equipmentCountAdult'];
	$Equipment_Count_Child = $_GET['equipmentCountChild'];
	$itemactive = 1;
	$FormToBeSent = $_GET['formtobesent'];
	$equipmentrenttime =$_GET['rentaltime'];
                
	$sql = "INSERT INTO ReservationItems (Reservation_ID,Equipment_ID,Equipment_Duration_ID,Equipment_Count_Adult,Equipment_Count_Child,Equipment_Count,Equipment_Form_Status,Item_Active_Status,Item_Start_Time) VALUES ('$resID','$equipmentID','$equipmentDurID','$Equipment_Count_Adult','$Equipment_Count_Child','$Equipment_Count','$FormToBeSent','$itemactive','$equipmentrenttime')";

	     //todo add client calling back to get the ID of the new item created.  
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
