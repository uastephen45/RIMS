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

       $inputcustomerName = $_GET['inputcustomerName'];
       $inputgroupName= $_GET['inputgroupName'];
       $inputaddressline1= $_GET['inputaddressline1'];
       $inputaddressline2= $_GET['inputaddressline2'];
       $inputcity= $_GET['inputcity'];
       $inputstatecode= $_GET['inputstatecode'];
       $inputcellphone= $_GET['inputcellphone'];
       $inputhomephone= $_GET['inputhomephone'];
       $inputemail = $_GET['inputemail'];   
       $inputzipcode= $_GET['inputzipcode'];


        $sql = "INSERT INTO Customers (Customer_Name, Group_Name,Address_Line_1, Address_Line_2, City, State, Cell_Phone_Number, Home_Phone_Number, Email_Address, Zip_Code) VALUES ('$inputcustomerName','$inputgroupName', '$inputaddressline1', '$inputaddressline2', '$inputcity', '$inputstatecode', '$inputcellphone', '$inputhomephone', '$inputemail', '$inputzipcode')";
	      
	$value1 =  mysqli_query($appdb,$sql,MYSQLI_ASSOC);
	
	if($value1){
	$sql = "SELECT LAST_INSERT_ID() as NewID";
	$result2 = mysqli_query($appdb,$sql,MYSQLI_ASSOC);
	$rows = 0;
	while($r =  mysqli_fetch_assoc($result2)){
	$rows = $r['NewID'];
	}
	echo json_encode(intval($rows));
}
?>
