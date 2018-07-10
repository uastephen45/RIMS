<?php
session_start();
include('Session.php');
if($_SESSION['role_id'] == 0){
echo "You don't have access";
}

if($_SESSION['role_id'] == 1){
?>
<div class="jumbotron text-center">
        <h1>Admin Page</h1>
        <p>{{ message }}</p>


<select name="adminActionList" onchange="location = this.value;" value="">
	<option selected="Selected"></option>
	<option value="Welcome.php#/admin/adduser">Add New User</option>
	<option value="Welcome.php#/admin/selectuser">Modify Users</option>
</select>
</div>



<?php
}






?>
