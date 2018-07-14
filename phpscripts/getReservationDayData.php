<?php
	$MoveForward = "false";
	session_start();
	include('Session.php');
	include('AppConfig.php');
	$lookupDate = $_GET['lookupDate'];
	$lookendDate = date_add($lookupDate,date_interval_create_from_date_string("1 days"));
	echo ($lookendDate)
	$queryType = $_GET['type'];
	
	#if(strlen($_SESSION['login_user'])>0){
	#	$MoveForward = "True";
	#}else{
 	#	header("HTTP/1.1 403 Forbidden");
	#	echo "HTTP/1.1 403 Forbidden";
 	#	exit;
	#}

	#if($MoveForward=="True"){

	$sql = "select hour(Item_Start_Time)as starttime,EquipmentType,Duration_Option ,Sum(Equipment_Count) as Equipment_Count from ReservationItems RI
	join ValidEquipmentTypes VET on RI.Equipment_ID = VET.ID
	join ValidEquipmentDurations VED on RI.Equipment_Duration_ID = VED.ID
		where Item_Start_Time > '$lookupDate' and Item_Start_Time < $lookendDate and  VET.Inventory_check_required = '$queryType' 
	group by Item_Start_Time,EquipmentType,Duration_Option 
	";
  	      $result = mysqli_query($appdb,$sql,MYSQLI_ASSOC);

	      $rows = array();
	      while($r = mysqli_fetch_assoc($result)) {
   	      	$rows[] = $r;
	      }
	      header('Content-Type: application/json');
	      echo json_encode($rows);
	
#}

?>
