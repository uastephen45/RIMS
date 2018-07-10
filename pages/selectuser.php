<html>
<head>

<style>
li {
  list-style:none;
}

.inputAdmin {
	width:;
	height:50px;
	
	font-size:12px;
}

tr{
border:black solid 1px;
}
.unit {
  text-decoration:none;
  color:black;
}
table{
  margin:10px;
}


.unit:hover {
  color:silver;
}

</style>

</head>
<body>
<?php include('Session.php');?>

<div class="content">

  <div class="jumbotron text-center" ng-controller="selectuserController">

    <h2>Admin Page</h2>
    <p>{{ message }}</p>

    <select name="adminActionList" onchange="location = this.value;">
      <option value="Welcome.php#/admin/adduser">Add New User</option>
      <option value="Welcome.php#/admin/selectuser"selected="selected">Modify Users</option>
   </select>
<center>
<div class="inputAdmin">
<label> Filter By Name: <input type="text" ng-model="userdataset.User_Name"></label><br>
</div>
<table>
  <tr cellpadding = "500px" class="unit" ng-repeat="x in userdata | filter:userdataset" ng-click="actionToTake(x.User_ID)">
    <td>UserName:  </td>
    <td>{{x.User_Name}}</td>
    <td>Role:  </td>
    <td>{{x.User_Role_ID}}</td>
  </tr>
</table>
</center>
</div>
</div>
</body>
</html>


