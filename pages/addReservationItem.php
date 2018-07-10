
<?php
   include('Session.php');
?>

<div class="jumbotron text-center" ng-controller="addReservationItemController">
        <h1>Add Item</h1>
	

	<p3> Pick a rental date </p3>
	<input type="date" name="rentItemDate" ng-model="DateSelected">
	<br>
	<p3> Pick a rental type</p3>
	<select name="EquipmentTypeSelect" ng-model="Types" ng-options="x.EquipmentType for x in EquipmentTypes">
	</select>
	<br>
	<p3> Pick a duration</p3>
	
	<select ng-change=durationBoxChange('asdf') ng-model="Duration" ID="eds" name="EquipmentDurationSelect" ng-options=" y.Duration_Option for y in EquipmentDurations | filter:{Equipment_ID:Types.ID}:true ">
	</select>
	
	<div ng-if="Types.Inventory_check_required > 0 && showEquipmentAv">
		Start Time		
		<select ng-change="checkOnRentalAvailability()" ng-model="$parent.timeToGo" ng-options= "i for i in ['10','11','12','13','14','15','16','17']"> </select>
		<br>		
		Available Equipment Count: {{$parent.rentalCount}}
		<br>
		Total Equipment Being Rented 
			<select ng-model="$parent.selectedNumberTotalCount" ng-options="x for x in arrayOfNumbers">
			</select>	
	</div>
<br>
		Adult Count
		<select ng-model="selectedNumber" ng-options="x for x in arrayOfNumbers">
			</select>
	${{Duration.Duration_Cost_Adult}} Per Person
	<div ng-if="Duration.Duration_Cost_Child > 0">
		Child Count
			<select ng-model="$parent.selectedNumberChild" ng-options="x for x in arrayOfNumbers">
			</select>
	${{Duration.Duration_Cost_Child}} Per Child
	</div>
	
		  	
	<center>
		Eligible Forms:
		<table>
		  <tr  ng-repeat="a in Validforms | filter:{Equipment_ID:Types.ID}:true" ng-click="addFormToSendArray(a)">
		    <td>Form Name:  </td>
		    <td>{{a.Form_Name}}</td>   
		 </tr>
		</table>
		Forms Being Sent:
		<table>
		  <tr  ng-repeat="b in Clickedforms" ng-click="removeFormInSendArray(b)">
		    <td>Form Name:  </td>
		    <td>{{b.Form_Name}}</td>   
		 </tr>
		</table>

	</center>
	
	


<div>
<button type="button" name="buttonclicker" ng-click="createnewItem()">Submit</button>
<button type="button" name="gobackbutton" ng-click="goback()">Go Back</options>
</div>
</div>
