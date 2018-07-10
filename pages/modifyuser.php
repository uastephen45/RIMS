
<?php
   include('Session.php');
?>

<div class="jumbotron text-center">
        <h1>Admin Page</h1>
        <p>{{ message }}</p>

<select name="adminActionList" onchange="location = this.value;" value="">

 <option value="Welcome.php#/admin/adduser">Add User</option>
 <option value="Welcome.php#/admin/selectuser" selected="selected">Modify Users</option>
</select>

<div>
<label>User ID: {{UserID}}</label>
<label>Username: </label>
<input type="Text" ID="usernametextbox" ng-model="Username"  ng-change="usernameChangedEvent(Username)" value="{{Username}}"> </input>

<label>Userpassword: </label>    
<input type="Text" ID="userpasswordtextbox" ng-model="Userpassword" ng-change="passwordChangedEvent(Userpassword)" value="{{Userpassword}}"> </input> 

<label>Admin: </label>    
<input type="checkbox" id="admincheckbox"> </input> 

<label>User Active:  </label>    
<input type="checkbox" id="activecheckbox" "{{activestatus}}"> </input>  

</div>



<p>{{ message }}</p>

</div>
