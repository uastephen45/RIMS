<?php
   include('Config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select User_Name , User_Role_ID from Users where User_Name = '$user_check'");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['User_Name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:Login.php");
   }
?>
