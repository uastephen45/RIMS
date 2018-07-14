<html>
<body>





<?php
session_start();
include('Session.php');

if($_SESSION['role_id'] >= 0){
?>



<div class="" ng-controller="mainreservationController">
        <h1>Reservation Items Page</h1>
       
	<center>
	<table>
		<tr class="unit1">
		        <td> Customer Name: {{custname}} Group Name: {{groupname}}</td>
		</tr>
		<tr class="unit1">
			<td> Address: {{Line_1}} Line 2(optional): {{Line_2}} </td>
                <tr class="unit1">
                        <td> Email Address: {{Email}} </td>
                </tr>
		<tr class="unit1">
			<td> Reservation ID: {{reservationID}} Rental Dates: {{rentstartdate}} - {{rentenddate}}
		</tr>

	</table>
	</center>
<!--
<label> Type text to filter: <input type="text" ng-model="customerdatag" ></label><br>
-->
<center>



<button type="button" id="createNewReservationItemButton" ng-click="moveToAddNewReservationItem()">Add New Item</button>
<button type="button" id="gobackbutton" ng-click="goback()">Back To Reservations</button>
<br>
<button type="button" id="MoveReservationForward" ng-click="MoveReservationForward()">Complete Reservation</button>
<button type="button" id="MoveReservationForward" ng-click="checktodelete()">Remove Reservation</button>
<table>
	<tr class="1">
		<td>Rental Cost: </td>
		<td>{{TotalPrice}}</td>			
	</tr class="1">
	<tr>
		<td>Tax Amount: </td>
		<td>{{TotalPrice * TaxRate}}</td>			
	</tr>
	<tr class="1">
		<td>Total Price:</td>
		<td>{{(TotalPrice * TaxRate)+TotalPrice}}</td>			
	</tr>
</table>





<br>
<div class="ex1">
<div ng-repeat="x in reservationdata" ng-click="checktodeleteitem(x)">
<table class="unit">
	Item:{{$index + 1}}
	<tr class="bord">
		<td style="font-weight:bold">Equipment Type: </td>
		<td style="font-weight:bold">{{x.EquipmentType}}</td>			
	</tr>
	<tr class="bord">	
		<td style="font-weight:bold" >Equipment Count:  </td>
		<td style="font-weight:bold">{{x.Equipment_Count}}</td>
	</tr>
	<tr class="bord">	
		<td>Leave Time:  </td>
		<td>{{x.Item_Start_Time}}</td>
	</tr>
	<tr class="bord">	
		<td>Adult Quantity:  </td>
		<td>{{x.Equipment_Count_Adult}} Cost @ ${{x.Duration_Cost_Adult}}</td>
	</tr>
	
	<tr class="bord">    
    		<td>Child Quantity:  </td>
    		<td>{{x.Equipment_Count_Child}} Cost @ ${{x.Duration_Cost_Child}}</td>
	</tr>


	<tr class="bord">
		<td>Sending Emails: </td>
		<td> {{x.Equipment_Form_Status}}</td>
	</tr>
	<tr  class="bord">
		<td> Total Cost For Item: </td>
		<td> ${{(x.Equipment_Count_Adult * x.Duration_Cost_Adult)+(x.Equipment_Count_Child * x.Duration_Cost_Child)}}
	</tr>
</table>
</div >
</div>


</center>
</div>


</body>
</html>
<?php
}






?>




