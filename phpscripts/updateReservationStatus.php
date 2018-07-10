<?php
//TODO fix this so it's secure
        session_start();
        include('Session.php');
        include('AppConfig.php');



	$resID = $_GET['resID'];
        $newStatusID= $_GET['newStatusID'];

                
	$sql = "update Reservations set Rental_Status = '$newStatusID' where ID = '$resID'";
	      
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
