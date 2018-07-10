<?php
//TODO fix this so it's secure
        session_start();
        include('Session.php');
        include('Config.php');


       if(strlen($_SESSION['login_user'])>0){
         $MoveForward = "True";
        }else{
        header("HTTP/1.1 403 Forbidden");
        echo "HTTP/1.1 403 Forbidden"; 
        exit;
        }

        $NewUserName = $_GET["newname"];
	$NewUserRole = $_GET["newrole"];


        $sql = "insert into Users (User_Name,User_Password,User_Role_ID,User_Active) Values ('$NewUserName','temp','$NewUserRole','1')";
        if( mysqli_query($db,$sql,MYSQLI_ASSOC)){
        header('Content-Type: application/json');
        header("HTTP/1.1 201 Success");
        }else{
        header("HTTP/1.1 505 Failure");
        }


?>
