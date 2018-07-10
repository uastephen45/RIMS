<?php
//http://192.168.2.5/phpscripts/getEquipmentAvailablity.php?EquipID=1&EquipDate=2018-06-27%2012:00:00
try {
	$MoveForward = "false";
	session_start();
	include('Session.php');
	include('AppConfig.php');
	$EquipID = $_GET['EquipID'];
	$EquipDate = $_GET['EquipDate'];
	$EquipRequestTimeOut = $_GET['EquipTimeOut'];

	/*if(strlen($_SESSION['login_user'])>0){
		$MoveForward = "True";
	}else{
 		header("HTTP/1.1 403 Forbidden");
		echo "HTTP/1.1 403 Forbidden";
 		exit;
	}*/
	$MoveForward = "True";	
	if($MoveForward=="True"){

	      $sql = "select count(*) as totalCount from ValidEquipmentInventory where EquipmentType ='$EquipID'" ;
  	      $result = mysqli_query($appdb,$sql,MYSQLI_ASSOC);

	      $rows = array();
	      $countOfEquipment = 0;
	      while($r = mysqli_fetch_assoc($result)) {
   	      	$countOfEquipment = $r;
	      }
		
	      $sql = "select sum(Equipment_Count) as Total_Past_In_Use from ReservationItems RI
	join ValidEquipmentDurations VED on RI.Equipment_Duration_ID = VED.ID 
	where DATE_ADD(Item_Start_Time, INTERVAL VED.Out_Time HOUR) > '$EquipDate'
	and DATE_ADD('$EquipDate', INTERVAL '$EquipRequestTimeOut' HOUR) > Item_Start_Time and RI.Equipment_ID ='$EquipID'";
	      $result = mysqli_query($appdb,$sql,MYSQLI_ASSOC);

	      $rows = array();
	      $countOfEquipmentinuse = 0;
	      while($r = mysqli_fetch_assoc($result)) {
   	      	$countOfEquipment['Total_Past_In_Use'] = $r['Total_Past_In_Use'];
	      }
		if($countOfEquipment['Total_Past_In_Use'] == ""){
			$countOfEquipment['Total_Past_In_Use'] = 0;			
		}

	      header('Content-Type: application/json');
	      echo json_encode($countOfEquipment);
	}
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


?>
