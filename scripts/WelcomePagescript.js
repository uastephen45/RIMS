// create the module and name it scotchApp
var scotchApp = angular.module('scotchApp', ['ngRoute']);

// configure our routes
scotchApp.config(function ($routeProvider) {
    $routeProvider

        // route for the home page
    .when('/', {
            templateUrl: 'pages/home.php',
            controller: 'homeScreenController'
    })
	.when('/mainreservations/newitem',{
	    templateUrl :'pages/addReservationItem.php',
	    controller:  'addReservationItemController'
	})
	.when('/mainreservations',{
	    templateUrl: 'pages/mainreservation.php',
	    controller:  'mainreservationController'
	})
	.when('/newreservation', {
	    templateUrl: 'pages/addreservation.php',
	    controller : 'createnewreservationController'
	})
        // route for the about page
    .when('/customersearch', {
            templateUrl: 'pages/customersearch.php',
            controller: 'customersearchController'
    })
	.when('/customersearch/reservations',{
	    templateUrl: 'pages/reservationsearch.php', 
	    controller : 'reservationsearchController'
	})
        // route for the contact page
    .when('/contact', {
            templateUrl: 'pages/contact.html',
            controller: 'contactController'
        })
    .when('/admin', {
            templateUrl: 'pages/admin.php',
            controller: 'adminController'
        })
    .when('/admin/selectuser', {
            templateUrl: 'pages/selectuser.php',
            controller: 'selectuserController'
        })
    .when('/admin/adduser', {
            templateUrl: 'pages/adduser.php',
            controller: 'adduserController'
        })
	.when('/newcustomer/',{
	    templateUrl: 'pages/addcustomer.php',
	    controller: 'addcustomerController'
	})
    .when('/admin/modifyuser', {
            templateUrl: 'pages/modifyuser.php',
            controller: 'modifyuserController'
        });
});
 



scotchApp.service('dataFactory', function () {
    var modifyuserid = 0;

    this.setval = function (value) {
        this.modifyuserid = value;
    }

    this.getval = function () {
        return this.modifyuserid;
    }
    
    var currentCustomerObject = 0;

    this.setcust = function (value) {
        this.currentCustomerObject = value;
    }

    this.getcust = function () {
        return this.currentCustomerObject ;
    }
});
scotchApp.service('DateConverter', function () {

    this.getval = function (date) {
	var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + (d.getDate() + 1),
        year = d.getFullYear();

	if (month.length < 2) month = '0' + month;
	if (day.length < 2) day = '0' + day;

	CurrentDate = [year, month, day].join('-');
	CurrentDate = CurrentDate + ' ' + d.getHours() +':00:00';

	return CurrentDate;
    }


});



scotchApp.controller('addReservationItemController', function ($scope,$http,dataFactory,DateConverter) {
    $scope.customerObj = dataFactory.getcust();  
    $scope.reservationID = $scope.customerObj.reservation_ID;
    $scope.Clickedforms = [];
    $scope.arrayOfNumbers =  [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20];
    $scope.boolSendForms = 0;
    $scope.goback = (function(){document.location="http://99.37.7.138:25565/Welcome.php#/mainreservations";});
	$scope.addFormToSendArray = (function(objectToAdd){
		if($scope.Clickedforms.indexOf(objectToAdd)){
			$scope.Clickedforms.push(objectToAdd);
		}else{
			alert('already added')
		}
	});

    $scope.createnewItem = (function(){
	$scope.RentalDateTime = new Date($scope.DateSelected);
	$scope.RentalDateTime.setHours($scope.timeToGo);
	$scope.RentalDateTime= DateConverter.getval($scope.RentalDateTime);
        $scope.boolSendForms = 0;	
	$scope.Clickedforms.forEach(function(item){
	    $scope.boolSendForms = 1;
	});
	$scope.childCount = 0;
	    
	if($scope.selectedNumberChild > 0){
	    $scope.childCount = $scope.selectedNumberChild;
	}else{
	    $scope.childCount = 0;
	}
	$scope.ItemID = 0;
	if($scope.Types.Inventory_check_required == 0){
	$scope.selectedNumberTotalCount	= 0;
	}
	$http.get('http://99.37.7.138:25565/phpscripts/addreservationItem.php?resID='+$scope.reservationID+'&rentaltime='+$scope.RentalDateTime+'&equipmentID='+$scope.Types.ID+'&equipmentCount='+ $scope.selectedNumberTotalCount+'&equipmentDurID='+$scope.Duration.ID+'&equipmentCountAdult='+$scope.selectedNumber+'&equipmentCountChild='+$scope.childCount+'&formtobesent='+$scope.boolSendForms).
	success(function (responseText) {
		console.log(responseText);
		$scope.ItemID = responseText[0].NewID;
		$scope.custid = dataFactory.getval();
		$scope.Clickedforms.forEach(function(item){
			$http.get('http://99.37.7.138:25565/phpscripts/addreservationItemForm.php?resID='+$scope.reservationID+'&custID='+ $scope.custid +'&resItemID='+$scope.ItemID+'&formid='+ item.ID+'&sentstatus=holding').
	     		then(function (responseText) {
			console.log(responseText);
	       		});		
		});	    
    	});
    });
    $scope.showEquipmentAv = false;
    $scope.checkOnRentalAvailability = (function()
    {
	
	$scope.RentalDateTime = new Date($scope.DateSelected);
	$scope.RentalDateTime.setHours($scope.timeToGo);
	$scope.RentalDateTime= DateConverter.getval($scope.RentalDateTime);
	$http.get('http://99.37.7.138:25565/phpscripts/getEquipmentAvailablity.php?EquipID='+$scope.Types.ID+'&EquipDate= '+$scope.RentalDateTime+'&EquipTimeOut='+$scope.Duration.Out_Time).
        	then(function (responseText) {
		console.log(responseText);
		$scope.rentalCount = responseText.data.totalCount - responseText.data.Total_Past_In_Use
	});




	
	$scope.rentalCount = 3;
    });
    $scope.durationboxStart= (function(){showEquipmentAv = false;});
    $scope.durationBoxChange = (function()
	{	
		$scope.showEquipmentAv	= true;
    });
	
	$scope.removeFormInSendArray = (function(objectToRemove){
		$scope.Clickedforms.splice(objectToRemove,1);
	});
	$http.get('http://99.37.7.138:25565/phpscripts/getValidEquipment.php').
        	then(function (responseText) {
		console.log(responseText);
		$scope.EquipmentTypes = responseText.data;
	});
	$http.get('http://99.37.7.138:25565/phpscripts/getValidDurations.php').
        	then(function (responseText) {
		console.log(responseText);
		$scope.EquipmentDurations = responseText.data;
	});
	$http.get('http://99.37.7.138:25565/phpscripts/getValidForms.php').
        	then(function (responseText) {
		console.log(responseText);
		$scope.Validforms = responseText.data;
	});




});
scotchApp.controller('createnewreservationController', function ($scope,$http,dataFactory) {

 	$scope.customerid = dataFactory.getval();
	$scope.goback = (function(){document.location="http://99.37.7.138:25565/Welcome.php#/customersearch/reservations"});
	$scope.handleUserCreationRequest = (function(){
		$scope.RentalDate = document.getElementsByName("inputRentalDate")[0].value;
		$scope.RentalDateEnd = document.getElementsByName("inputRentalDateEnd")[0].value;
		$http.get('http://99.37.7.138:25565/phpscripts/addreservation.php?CustomerID='+$scope.customerid+'&RentalDate='+$scope.RentalDate+'&RentalDateEnd='+$scope.RentalDateEnd).
        		then(function (responseText) {
			console.log(responseText);
			$scope.customerObj = dataFactory.getcust();
			$scope.customerObj.reservation_ID = responseText.data[0].NewID;
			$scope.customerObj.RentalDate = $scope.RentalDate;
			$scope.customerObj.RentalDateEnd = $scope.RentalDateEnd;
			dataFactory.setcust($scope.customerObj);
			document.location = "http://99.37.7.138:25565/Welcome.php#/mainreservations";

	});
    });
});
scotchApp.controller('mainreservationController', function ($scope,$http,dataFactory){

	$scope.Math = window.Math;	
	$scope.customerid = dataFactory.getval();
	$scope.customerObj = dataFactory.getcust();
	$scope.custname =  $scope.customerObj.Customer_Name;
	$scope.groupname = $scope.customerObj.Group_Name;
    	$scope.Line_1 = $scope.customerObj.Address_Line_1;
	$scope.Line_2 = $scope.customerObj.Address_Line_2;
	$scope.City = $scope.customerObj.City;
	$scope.State = $scope.customerObj.State;
	$scope.Zip = $scope.customerObj.Zip_Code;
	$scope.Cell =  $scope.customerObj.Cell_Phone_Number;
	$scope.Home = $scope.customerObj.Home_Phone_Number;
	$scope.Email = $scope.customerObj.Email_Address;
	$scope.reservationID = $scope.customerObj.reservation_ID;
	$scope.rentstartdate = $scope.customerObj.RentalDate;
	$scope.rentenddate = $scope.customerObj.RentalDateEnd;
	$scope.goback =(function() {document.location = "http://99.37.7.138:25565/Welcome.php#/customersearch/reservations"});
	$scope.MoveReservationForward = (function() {
        	$http.get('http://99.37.7.138:25565/phpscripts/updateReservationStatus.php/?resID='+$scope.reservationID+'&newStatusID=2').
        	then(function (responseText) {
            		console.log(responseText.data);
			alert("Moved Reservation To Email Ready Status")
        	});
	});
	$http.get('http://99.37.7.138:25565/phpscripts/getReservationItemData.php?ReservationID=' + $scope.reservationID).
        	then(function (responseText) {
		console.log(responseText);
		$scope.dataforres=[];
		$scope.TotalPrice = 0.00;
		$scope.TaxRate = 0.065;
		responseText.data.forEach(function(item,index,arrayi)
		{
			
			 $scope.TotalPrice = $scope.TotalPrice + (item.Equipment_Count_Child * item.Duration_Cost_Child);
			 $scope.TotalPrice = $scope.TotalPrice + (item.Equipment_Count_Adult * item.Duration_Cost_Adult);

			if(arrayi[index].Equipment_Form_Status == 1)
			{
				arrayi[index].Equipment_Form_Status = "Yes";
			}else{
				arrayi[index].Equipment_Form_Status = "No";
			}
			$scope.dataforres.push(arrayi[index]);
		});
		$scope.reservationdata = $scope.dataforres;
	});

	$scope.moveToAddNewReservationItem = (function(){
	document.location = "http://99.37.7.138:25565/Welcome.php#/mainreservations/newitem";
	});
});
scotchApp.controller('reservationsearchController', function ($scope,$http,dataFactory) {
	$scope.customerid = dataFactory.getval();
	$scope.customerObj = dataFactory.getcust();
	$scope.custname =  $scope.customerObj.Customer_Name;
	$scope.groupname = $scope.customerObj.Group_Name;
    	$scope.Line_1 = $scope.customerObj.Address_Line_1;
	$scope.Line_2 = $scope.customerObj.Address_Line_2;
	$scope.City = $scope.customerObj.City;
	$scope.State = $scope.customerObj.State;
	$scope.Zip = $scope.customerObj.Zip_Code;
	$scope.Cell =  $scope.customerObj.Cell_Phone_Number;
	$scope.Home = $scope.customerObj.Home_Phone_Number;
	$scope.Email = $scope.customerObj.Email_Address;

	$scope.goback = (function(){
		document.location = "http://99.37.7.138:25565/Welcome.php#/customersearch";
	});
	
	$http.get('http://99.37.7.138:25565/phpscripts/getcustomerReservations.php?CustID=' + $scope.customerid).
        	then(function (responseText) {
		console.log(responseText);
		$scope.reservationdata = responseText.data;
	});

	$scope.moveToAddNewReservation = (function(customerID){		
		document.location = "http://99.37.7.138:25565/Welcome.php#/newreservation/";
	});	


	$scope.moveToMainReservation = (function(resID,startdate,enddate){
		$scope.customerObj.RentalDate = startdate;
		$scope.customerObj.RentalDateEnd = enddate;
		$scope.customerObj.reservation_ID = resID;
		dataFactory.setcust($scope.customerObj);
		document.location = "http://99.37.7.138:25565/Welcome.php#/mainreservations";
	});
});
scotchApp.controller('homeScreenController', function ($scope,$http) {
    // create a message to display in our view
	$scope.arrayofNumbers = [10,11,12,13,14,15,16,17];
    $scope.Mytruedata = [];	
    $http.get('http://99.37.7.138:25565/phpscripts/getReservationDayData.php?type=1&lookupDate=2018-07-02').
        then(function (responseText) {
            console.log(responseText.data);
		$scope.hourlydata = responseText.data;
          
    });
});
scotchApp.controller('addcustomerController', function ($scope,$http,dataFactory) {
	$scope.message = 'Add Customer Screen';
	$scope.handleCustomerCreationRequest = (function(){
	//TODO Add Validation
	//do the mapping 
	$scope.inputcustomerName=document.getElementsByName("inputcustomerName")[0].value;
	$scope.inputgroupName=document.getElementsByName("inputgroupName")[0].value;
	$scope.inputaddressline1=document.getElementsByName("inputaddressline1")[0].value;
	$scope.inputaddressline2=document.getElementsByName("inputaddressline2")[0].value;
	$scope.inputcity=document.getElementsByName("inputcity")[0].value;
	$scope.inputstatecode=document.getElementsByName("inputstatecode")[0].value;
	$scope.inputcellphone=document.getElementsByName("inputcellphone")[0].value;
	$scope.inputhomephone=document.getElementsByName("inputhomephone")[0].value;
	$scope.inputemail=document.getElementsByName("inputemail")[0].value;
	$scope.inputzipcode=document.getElementsByName("inputzipcode")[0].value;
	$scope.customerObj = [];
	$http.get('http://99.37.7.138:25565/phpscripts/addcustomer.php?inputcustomerName='+$scope.inputcustomerName+'&inputgroupName='+$scope.inputgroupName+'&inputaddressline1='+$scope.inputaddressline1+'&inputaddressline2='+$scope.inputaddressline2+'&inputcity='+$scope.inputcity+'&inputstatecode='+$scope.inputstatecode+'&inputcellphone='+$scope.inputcellphone+'&inputhomephone='+$scope.inputhomephone+'&inputemail='+$scope.inputemail+'&inputzipcode='+$scope.inputzipcode).
        	then(function (responseText) {
		console.log(responseText,$scope.customerObj);
		item = parseInt(responseText.data);
		dataFactory.setval(item);

	
	$scope.customerObj.Customer_Name =  $scope.inputcustomerName;
	$scope.customerObj.Group_Name = $scope.inputgroupName;
    	$scope.customerObj.Address_Line_1= $scope.inputaddressline1;
	$scope.customerObj.Address_Line_2 =$scope.inputaddressline2;
	$scope.customerObj.City = $scope.inputcity;
	$scope.customerObj.State = $scope.inputstatecode;
	$scope.customerObj.Zip_Code = $scope.inputzipcode;
	$scope.customerObj.Cell_Phone_Number = $scope.inputcellphone;
	$scope.customerObj.Home_Phone_Number = $scope.inputhomephone;
	$scope.customerObj.Email_Address = $scope.inputemail;




		console.log($scope.customerObj);
		dataFactory.setcust($scope.customerObj);	
		window.location.href = "http://99.37.7.138:25565/Welcome.php#/customersearch/reservations";
		});
	});
});
scotchApp.controller('customersearchController', function ($scope, $http,dataFactory) {
    $scope.message = '';

    $http.get('http://99.37.7.138:25565/phpscripts/getallcustomersdata.php').
        then(function (responseText) {
            console.log(responseText.data);
		mydata=responseText.data;
            $scope.customerdata = mydata;
    });
    $scope.customerClickedEvent = function(userID){

	for(i in $scope.customerdata){
		if($scope.customerdata[i].ID==userID){
			$scope.clickedCustomerObject = $scope.customerdata[i];
		}
	}
	console.log($scope.clickedCustomerObject);
	dataFactory.setcust($scope.clickedCustomerObject);	
	dataFactory.setval(userID);
	window.location.href = "http://99.37.7.138:25565/Welcome.php#/customersearch/reservations";
    
    }
    $scope.moveToAddNewCustomer = function() { document.location = "http://99.37.7.138:25565/Welcome.php#/newcustomer/"; }
});
scotchApp.controller('contactController', function ($scope) {
    $scope.message = 'Contact us! JK. This is just a demo.';
});
scotchApp.controller('adminController', function ($scope) {
    $scope.message = 'You are on the admin page';
});
scotchApp.controller('modifyuserController', function ($scope, $http, dataFactory) {
    datatosend = dataFactory.getval();

    $http.get('http://99.37.7.138:25565/phpscripts/getuserdata.php?userid=' + datatosend).
        then(function (responseText) {
            console.log(responseText.data);
            inputdata = responseText.data;
            $scope.UserID = dataFactory.getval();
            $scope.Username = inputdata[0].User_Name;
            $scope.Userpassword = inputdata[0].User_Password;

            if (inputdata[0].User_Active == 1) {
                document.getElementById("activecheckbox").checked = true;
            }
            if (inputdata[0].User_Role_ID == 1) {
                document.getElementById("admincheckbox").checked = true;
            }
        });

    var usernametextboxinput = document.getElementById("usernametextbox");
    // Execute a function when the user releases a key on the keyboard
    usernametextboxinput.addEventListener("keyup", function (event) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Trigger the button element with a click
            alert("Updating Database")
            $scope.ConstUsername = $scope.Username;
            $scope.usernameChangedEvent($scope.ConstUsername);
        }
    });


    var userpasswordtextboxinput = document.getElementById("userpasswordtextbox");
    // Execute a function when the user releases a key on the keyboard
    userpasswordtextboxinput.addEventListener("keyup", function (event) {
        // Cancel the default action, if needed
        event.preventDefault();
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Trigger the button element with a click
            alert("Updating Database")
            $scope.ConstPassword = $scope.Userpassword;
            $scope.passwordChangedEvent($scope.ConstPassword);
        }
    });

    $scope.usernameChangedEvent = function (changedValue) {
        var usernameTB = document.getElementById("usernametextbox");
        if ($scope.ConstUsername != changedValue) {
            usernameTB.style.backgroundColor = "Yellow";
        } else {
            usernameTB.style.backgroundColor = "White";
        }
    };

    $scope.passwordChangedEvent = function (changedValue) {
        var usernameTB = document.getElementById("userpasswordtextbox");
        if ($scope.ConstPassword != changedValue) {
            usernameTB.style.backgroundColor = "Yellow";
        } else {
            usernameTB.style.backgroundColor = "White";
        }
    };
});
scotchApp.controller('adduserController', function ($scope, $http) {
                $scope.handleUserCreationRequest = function () {
                    UnameToSend = document.getElementsByName('inputUserName')[0].value;
                    UroleToSend = document.getElementsByName('inputUserRole')[0].value;
                    $http.get('http://99.37.7.138:25565/phpscripts/adduser.php?newname=' + UnameToSend + '&newrole=' + UroleToSend).
                        then(function (responseText) {
                            if (responseText.status == 201) {
                                document.location.reload(true);
                            } else {
                                alert("Error With Transaction");
                            }
                        });
                }
            });
scotchApp.controller('selectuserController', function ($scope, $http, dataFactory) {
                $http.get('http://99.37.7.138:25565/phpscripts/getactiveusers.php').
                    then(function (response, dataFactory) {
                        $scope.userdata = response.data;
                    });
                $scope.actionToTake = function (usertoremove) {
                    dataFactory.setval(usertoremove);
                    window.location.href = "http://99.37.7.138:25565/Welcome.php#/admin/modifyuser";
                }
});
