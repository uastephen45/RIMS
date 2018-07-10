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
<div class="jumbotron text-center" ng-controller="customersearchController">
        <h1>Customer Search Page</h1>
        <p>{{ message }}</p>



<label> Type text to filter: <input type="text" ng-model="customerdatag" ></label><br>
<center>
<button type="button" id="createNewCustomerButton" ng-click="moveToAddNewCustomer()">Create New Customer</button>
<table>
	<tr class="unit" ng-repeat="x in customerdata | filter:customerdatag" ng-click="customerClickedEvent(x.ID)">
		<td>Customer Name: </td>
		<td>{{x.Customer_Name}}</td>
		<td>Group Name: </td>
		<td>{{x.Group_Name}}</td>
	</tr>
</table>
</center>
</div>
<?php
}






?>




