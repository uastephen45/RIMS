<?php
session_start();
include('Session.php');

if($_SESSION['role_id'] >= 0){
?>
<div class="" ng-controller="reservationsearchController">
        <h1>Reservation Search Page</h1>
        <center>
	 <table>
		<tr class="unit"  ng-click='editcustomer()'>
			<td> Customer Name: {{custname}} Group Name: {{groupname}}</td> 
		</tr>
		<tr class="unit1">
			<td> Address: {{Line_1}} {{Line_2}} </td>
		</tr>

                <tr class="unit1">
                        <td> City:  {{City}} State: {{State}} Zip: {{Zip}} </td>
                </tr>
                <tr class="unit1">
                        <td> Cell Phone: {{Cell}} Home Phone: {{Home}} </td>
                </tr>
                <tr class="unit1">
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




