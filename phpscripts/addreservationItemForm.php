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
        $custID= $_GET['custID'];
	$resItemID= $_GET['resItemID'];
	$formid= $_GET['formid'];
	$sentstatus = $_GET['sentstatus'];
	
                
	$sql = "INSERT INTO ReservationItemsForms (Reservation_ID,Customer_ID,Reservation_Item_ID,Form_ID,Sent_Status) VALUES ('$resID','$custID','$resItemID','$formid','$sentstatus')";
	echo ($SQL);
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
