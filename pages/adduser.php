
<?php
   include('Session.php');
?>

<div class="jumbotron text-center">
        <h1>Admin Page</h1>
        <p>{{ message }}</p>

<select name="adminActionList" onchange="location = this.value;" value="">

 <option value="Welcome.php#/admin/adduser">Add New User</option>
 <option value="Welcome.php#/admin/selectuser">Modify Users</option>
</select>



<div>
    <label>Users Name</label>
    <input type="text" name="inputUserName" />
</div>
<div>
    <label>Users Role ID</label>
    <input type="text" name="inputUserRole" />
</div>
<button type="button" name="buttonclicker" ng-click="handleUserCreationRequest()">Submit Reqeust</button>
<p>{{ message }}</p>

</div>
