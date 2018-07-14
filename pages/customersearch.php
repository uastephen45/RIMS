
<?php
session_start();
include('Session.php');

if($_SESSION['role_id'] >= 0){
?>
<div class="" ng-controller="customersearchController">
        <h1>Customer Search Page</h1>
        <p>{{ message }}</p>
<label> Type text to filter: <input type="text" ng-model="customerdatag" ></label><br>

<button type="button" id="createNewCustomerButton" ng-click="moveToAddNewCustomer()">Create New Customer</button>
<center>
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




