
<?php
   include('Session.php');
?>

<div ng-controller="addcustomerController">
        <h1>New Customer</h1>
        <p class="ng-binding">Add Customer Screen</p>

    <input type="text" placeholder="Customer Name" name="inputcustomerName">
<br>
    <input type="text" placeholder="Group Name" name="inputgroupName">
<br>
    <input type="text" placeholder="Address Line 1" name="inputaddressline1">
<br>
    <input type="text" placeholder="Address Line 2" name="inputaddressline2">
<br>
    <input type="text" placeholder="City name="inputcity">
<br>
    <input type="text" placeholder="State Code" name="inputstatecode">
<br>
    <input type="text" placeholder="Cell Phone" name="inputcellphone">
<br>
    <input type="text" placeholder="Home Phone" name="inputhomephone">
<br>
    <input type="text" placeholder="Email Address" name="inputemail">
<br>
    <input type="text" placeholder="Zip Code" name="inputzipcode">
<br>





<button type="button" name="buttonclicker" ng-click="handleCustomerCreationRequest()">Submit Request</button>
<button type="button" name="backclicker" ng-click="goback()">Go Back</button>
<p>{{ message }}</p>

</div>
