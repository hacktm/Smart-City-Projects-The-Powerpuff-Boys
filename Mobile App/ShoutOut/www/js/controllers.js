angular.module('ShoutOut.controllers', ["ShoutOut.NetworkService"])

.controller('AppCtrl', function($scope, $ionicModal, $timeout, NetDB) {
  if (window.localStorage["loggedIn"])
	$scope.loggedIn = window.localStorage["loggedIn"] || false;
  else {
	window.localStorage["loggedIn"] = "false";
	$scope.loggedIn = false;
  }
  $scope.auth_action = $scope.loggedIn == "true" ? "Logout" : "Login";
  if (window.localStorage["cityId"]) {
    $scope.city_id = window.localStorage["cityId"];
	$scope.city_name = window.localStorage["cityName"];
  } else {
    window.localStorage["cityId"] = "0";
	$scope.city_id = 0;
	window.localStorage["cityName"] = "Select a City!";
	$scope.city_name = "Select a City!";
  }
  
  // Login Logic
   
  $scope.loginData = {};
  
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.loginModal = modal;
  });
  
  $scope.authBtnClick = function() {
	if ($scope.loggedIn == true)
		$scope.doLogout();
	else
		$scope.showLogin();
  }
  
  $scope.showLogin = function() {
    $scope.loginModal.show();
  };

  $scope.closeLogin = function() {
    $scope.loginModal.hide();
  };
  
  $scope.doLogin = function() {
	window.localStorage["user"] = $scope.loginData.username;
	
    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
	
	window.localStorage["loggedIn"] = "true";
	$scope.loggedIn = true;
	$scope.auth_action = "Logout";
  };
  
  $scope.doLogout = function() {
	window.localStorage["loggedIn"] = "false";
    $scope.loggedIn = false;
    $scope.auth_action = "Login";
  };
  
  // Select City Logic
  
  $scope.countyId = -1;
  $scope.cityId = -1;
  
  $ionicModal.fromTemplateUrl('templates/selectCounty.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.selectCityModal = modal;
  });
  
  $scope.showSelectCity = function() {
    $scope.selectCityModal.show();
	
	$scope.selectCityTitle = "Select County";
	$scope.selectCityList = [
		{id:1, name:"County 1"},
		{id:2, name:"County 2"}
	];
  };
  
  $scope.closeSelectCity = function() {
    $scope.selectCityModal.hide();
  };
  
  $scope.itemSelected = function(itemId, itemName) {
	if ($scope.countyId == -1) {
		// A County was Selected
		// Get Cities
		$scope.countyId = itemId;
		$scope.selectCityTitle = "Select City";
		$scope.selectCityList = [
			{id:1, name:"City 1"},
			{id:2, name:"City 2"}
		];
	} else {
		// A City was Selected
		// Load City
		window.localStorage["cityId"] = itemId;
		$scope.city_id = itemId;
		window.localStorage["cityName"] = itemName;
		$scope.city_name = itemName;
		
		$scope.selectCityTitle = "Done!";
		$scope.closeSelectCity();
		
		location.reload();
	}
  };
})

.controller('SearchController', function($scope, $stateParams, NetDB) {
	$scope.resuls = [];
	$scope.loaded = true;
	
	$scope.execute = function(query) {
		$scope.loaded = false;
		$scope.noItems = false;
			
		NetDB.search(query.query, window.localStorage["cityId"], function(data) { 
			if  (!data || data.length == 0) {
				$scope.noItems = true;
			} else {
				$scope.results = data;
			}
			$scope.loaded = true;
		});
	};
})

.controller('CategoriesController', function($scope, $stateParams, NetDB) {
	$scope.categories = [];
	$scope.loaded = false;
	$scope.noItems = false;
	
	NetDB.categories(window.localStorage["cityId"], function(data) { 
		if (!data || data.length == 0) {
			$scope.noItems = true;
		} else {
			$scope.categories = [];
			for (var i=0; i<data.length; i++) {
				if (data[i].branches.length > 0) {
					$scope.categories.push({id:data[i].id, name:data[i].name});
				}
			}
			if ($scope.categories.length == 0) {
				$scope.noItems = true;
			}
		}
		$scope.loaded = true;
	});
})

.controller('CategoryController', function($scope, $stateParams) {
	$scope.categoryId = $stateParams.categoryId;
	$scope.categoryName = $stateParams.categoryName;
	
	$scope.companies = [];
	$scope.loaded = false;
	$scope.noItems = false;
	
	$scope.companies = [
		{id:1, name:"Company 1"},
		{id:2, name:"Company 2"},
	];
})

.controller('CompanyController', function($scope, $stateParams) {
	$scope.companyId = $stateParams.companyId;
	$scope.companyName = $stateParams.companyName;
	
	$scope.companyDesc = "This is a Description.";
})

.controller('TicketsController', function($scope, $ionicModal, $stateParams) {
	$scope.branchId = $stateParams.branchId;
	$scope.ticketType = $stateParams.ticketType;
	$scope.ticketTypeName = $stateParams.ticketType == 1 ? "Proposal" : "Complaint";
	
	$scope.tickets = [];
	$scope.loaded = false;
	$scope.noItems = false;
	
	$scope.tickets = [
		{id:1, name:"Ticket 1"},
		{id:2, name:"Ticket 2"},
	];
	
	$ionicModal.fromTemplateUrl('templates/newTicket.html', {
		scope: $scope
	}).then(function(modal) {
		$scope.newTicketModal = modal;
	});
	
	$scope.createNew = function()
	{
		if (window.localStorage["loggedIn"] == "false") {
			alert("You must Login before you can Create New Tickets.");
		} else {
			if ($scope.newTicket) {
				$scope.newTicket.title = "";
				$scope.newTicket.shortD = "";
				$scope.newTicket.description = "";
			}
			$scope.newTicketModal.show();
		}
	};
	
	$scope.closeNewTicketModal = function()
	{
		$scope.newTicketModal.hide();
	};
	
	$scope.doNewTicket = function()
	{
		console.log($scope.newTicket);
	};
})

.controller('TicketController', function($scope, $stateParams) {
	$scope.ticketName = $stateParams.ticketName;
	
})

.controller('MyTicketsController', function($scope, $stateParams) {
});

