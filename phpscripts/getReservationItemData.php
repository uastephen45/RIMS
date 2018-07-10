<?php
	$MoveForward = "false";
	session_start();
	include('Session.php');
	include('AppConfig.php');
	$resID = $_GET['ReservationID'];
	if(strlen($_SESSION['login_user'])>0){
		$MoveForward = "True";
	}else{
 		header("HTTP/1.1 403 Forbidden");
		echo "HTTP/1.1 403 Forbidden";
 		exit;
	}

	if($MoveForward=="True"){

	$sql = "select RI.ID,Equipment_Count_Adult,Equipment_Count_Child,Equipment_Count,Equipment_Form_Status,Item_Start_Time,VED.Duration_Cost_Adult,VED.Duration_Cost_Child,EquipmentType,Duration_Option from  ReservationItems RI JOIN ValidEquipmentTypes VET on RI.Equipment_ID = VET.ID Join ValidEquipmentDurations VED on RI.Equipment_Duration_ID = VED.ID where RI.Reservation_ID = '$resID'";
  	      $result = mysqli_query($appdb,$sql,MYSQLI_ASSOC);

	      $rows = array();
	      while($r = mysqli_fetch_assoc($result)) {
   	      	$rows[] = $r;
	      }
	      header('Content-Type: application/json');
	      echo json_encode($rows);
	
}

?>
