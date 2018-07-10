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
<div class="jumbotron text-center" ng-controller="homeScreenController">
        <h1>Home Page</h1>



<label> Date To Review: <input type="date" ng-model="customerdatag" ></label><br>
<center>
<button type="button" id="createNewCustomerButton" ng-click="moveToAddNewCustomer()">Create New Customer</button>
<table class="unit" ng-repeat="hdata in hourlydata | filter:$parent.$index">
	<tr class="bord">
		<td>Equipment Rental Time: </td>
		<td style="font-weight:bold">{{hdata.starttime}}</td>
		<td>Equipment Type:</td>
		<td style="font-weight:bold">{{hdata.EquipmentType}}</td>
		<td>Duration Type: </td>
		<td style="font-weight:bold">{{hdata.Duration_Option}}</td>	
		<td>Equipment Count: </td>
		<td style="font-weight:bold">{{hdata.Equipment_Count}}</td>





		
	</tr>
	
</table>

</center>
</div>
<?php
}






?>




