
<?php
   include('Session.php');
?>

<div class="jumbotron text-center" ng-controller="createnewreservationController">
        <h1>New Reservation</h1>
        <p>{{ message }}</p>

    <label>Rental Start Date</label>
    <input type="Date" name="inputRentalDate"/>
    <label>Rental End Date</label>
    <input type="Date" name="inputRentalDateEnd"/>

<button type="button" name="buttonclicker" ng-click="handleUserCreationRequest()">Submit Reqeust</button>
<button type="button" name="buttongoback" ng-click="goback()">Cancel Request</button>
<p>{{ message }}</p>

</div>
