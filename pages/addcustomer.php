
<?php
   include('Session.php');
?>

<div class="jumbotron text-center ng-scope" ng-controller="addcustomerController">
        <h1>New Customer</h1>
        <p class="ng-binding">Add Customer Screen</p>

    <label>Custmer Name</label>
    <input type="text" name="inputcustomerName">
<br>
    <label>Group Name</label>
    <input type="text" name="inputgroupName">
<br>
    <label> Address Line 1</label>
    <input type="text" name="inputaddressline1">
<br>
    <label> Address Line 2</label>
    <input type="text" name="inputaddressline2">
<br>
    <label> City</label>
    <input type="text" name="inputcity">
<br>
//constraint only does 2 chars
    <label> State Code</label>
    <input type="text" name="inputstatecode">
<br>
    <label> Cell Phone</label>
    <input type="text" name="inputcellphone">
<br>
    <label> Home Phome</label>
    <input type="text" name="inputhomephone">
<br>
    <label> Email Address </label>
    <input type="text" name="inputemail">
<br>
    <label> Zip Code</label>
    <input type="text" name="inputzipcode">
<br>





<button type="button" name="buttonclicker" ng-click="handleCustomerCreationRequest()">Submit Reqeust</button>
<p>{{ message }}</p>

</div>
