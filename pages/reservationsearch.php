<html>
<head>

<style>
li {
  list-style:none;
}

.inputAdmin {
	width:;
	height:50px;
	
	font-size:12px;
}

tr{
border:black solid 1px;
}
.unit {
  text-decoration:none;
  color:black;
}
.unit1 {
  text-decoration:none;
  color:black;
}

table{
  margin:10px;
}

.unit:hover {
  color:silver;
}

</style>

</head>
<body>





<?php
session_start();
include('Session.php');

if($_SESSION['role_id'] >= 0){
?>
<div class="jumbotron text-center" ng-controller="reservationsearchController">
        <h1>Reservation Search Page</h1>
        <center>
	 <table>
		<tr class="unit">
			<td> Customer Name: {{custname}} Group Name: {{groupname}}</td>
		</tr>
		<tr class="unit">
			<td> Address: {{Line_1}} {{Line_2}} </td>
		</tr>

                <tr class="unit">
                        <td> City:  {{City}} State: {{State}} Zip: {{Zip}} </td>
                </tr>
                <tr class="unit">
                        <td> Cell Phone: {{Cell}} Home Phone: {{Home}} </td>
                </tr>
                <tr class="unit">
                        <td> Email Address: {{Email}} </td>
                </tr>
	</table>
	</center>
<label> Type text to filter: <input type="text" ng-model="customerdatag" ></label><br>
<center>
<button type="button" id="createNewReservationButton" ng-click="moveToAddNewReservation()">Create New Reservation</button>
<button type="button" id="gobackbutton" ng-click="goback()"> Go Back</button>
<table>
	<tr class="unit" ng-repeat="x in reservationdata | filter:customerdatag" ng-click="moveToMainReservation(x.ID,x.Rental_Date,x.Rental_End_Date)">
		<td>Rental Date: </td>
		<td>({{x.Rental_Date}}) Through ({{x.Rental_End_Date}}) </td>
		<td>Rental Status: </td>
		<td>{{x.Status_Reason}}</td>
	</tr>
</table>
</center>
</div>
<?php
}






?>




