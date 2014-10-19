angular.module('SpreadOut.controllers', ["SpreadOut.NetworkService"])

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
	if ($scope.loggedIn == "true") {
		$scope.doLogout();
	} else {
		$scope.showLogin();
	}
  };
  
  $scope.showLogin = function() {
    $scope.disabled = false;
	$scope.displayError = false;
	$scope.loginData = {};
	
	$scope.loginModal.show();
  };

  $scope.closeLogin = function() {
    $scope.loginModal.hide();
  };
  
  $scope.doLogin = function() {
	$scope.disabled = true;
	$scope.displayError = false;
	window.localStorage["email"] = $scope.loginData.email;
	
	NetDB.login($scope.loginData.email, $scope.loginData.password, 
		function(data) {
			window.localStorage["loggedIn"] = "true";
			window.localStorage["token"] = data["token"];
			$scope.loggedIn = "true";
			$scope.auth_action = "Logout";
			$scope.closeLogin();
			$scope.disabled = false;
		}, 
		function(data) {
			$scope.displayError = true;
			$scope.disabled = false;
		}
	);
  };
  
  $scope.doLogout = function() {
	NetDB.logout(window.localStorage["token"], 
		function(data) {
			window.localStorage["loggedIn"] = "false";
			window.localStorage["token"] = "";
			$scope.loggedIn = false;
			$scope.auth_action = "Login";
		},
		function(data) {
			alert("Logout Failed \nSomething went wrong...");
		}
	);
  };
  
  // Select City Logic
  
  $scope.countyId = -1;
  $scope.countyName = "";
  $scope.cityId = -1;
  
  $ionicModal.fromTemplateUrl('templates/selectCounty.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.selectCityModal = modal;
  });
  
  $scope.showSelectCity = function() {
    $scope.selectCityModal.show();
	
	$scope.loaded = false;
	$scope.noItems = false;
	
	$scope.selectCityTitle = "Select County";
	$scope.selectCityList = [];
	NetDB.counties(function(data) { 
		if  (!data || data.length == 0) {
			$scope.noItems = true;
		} else {
			$scope.selectCityList = data;
		}
		$scope.loaded = true;
	});
  };
  
  $scope.closeSelectCity = function() {
    $scope.selectCityModal.hide();
	
    $scope.countyId = -1;
	$scope.countyName = "";
	$scope.cityId = -1;
  };
  
  $scope.itemSelected = function(itemId, itemName) {
	if ($scope.countyId == -1) {
		// A County was Selected
		// Get Cities
		$scope.countyId = itemId;
		$scope.countyName = itemName;
		
		$scope.loaded = false;
		$scope.noItems = false;
		
		$scope.selectCityTitle = "Select City";
		$scope.selectCityList = [];
		NetDB.cities($scope.countyId, function(data) { 
			if  (!data || data.length == 0) {
				$scope.noItems = true;
			} else {
				$scope.selectCityList = data;
			}
			$scope.loaded = true;
		});
	} else {
		// A City was Selected
		// Load City
		window.localStorage["cityId"] = itemId;
		$scope.city_id = itemId;
		window.localStorage["cityName"] = itemName + " (" + $scope.countyName + ")";
		$scope.city_name = window.localStorage["cityName"];
		
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

.controller('CategoryController', function($scope, $stateParams, NetDB) {
	$scope.categoryId = $stateParams.categoryId;
	$scope.categoryName = $stateParams.categoryName;
	
	$scope.branches = [];
	$scope.loaded = false;
	$scope.noItems = false;
	
	NetDB.branches(window.localStorage["cityId"], $scope.categoryId, function(data) { 
		if (!data || data.length == 0) {
			$scope.noItems = true;
		} else {
			$scope.branches = [];
			for (var i=0; i<data[0].branches.length; i++) {
				if (data[0].branches.length > 0) {
					$scope.branches.push({
						id:data[0].branches[i].id, 
						companyId:data[0].branches[i].company_id, 
						name:data[0].branches[i].name
					});
				}
			}
			if ($scope.branches.length == 0) {
				$scope.noItems = true;
			}
		}
		$scope.loaded = true;
	});
})

.controller('CompanyController', function($scope, $stateParams, NetDB) {
	$scope.branchId = $stateParams.branchId;
	$scope.companyId = $stateParams.companyId;
	
	NetDB.company($scope.companyId, function(data) { 
		if (!data || data.length == 0) {
			;
		} else {
			$scope.name = data[0].name;
			$scope.description = data[0].description;
			if ($scope.description == "") {
				$scope.description = "No Description";
			}
		}
	});
})

.controller('TicketsController', function($scope, $ionicModal, $stateParams, NetDB) {
	$scope.branchId = $stateParams.branchId;
	$scope.ticketType = $stateParams.ticketType;
	$scope.ticketTypeName = $stateParams.ticketType == 1 ? "Proposal" : "Complain";
	
	$scope.tickets = [];
	$scope.loaded = false;
	$scope.noItems = false;
	
	$scope.tickets = [];
	NetDB.tickets($scope.branchId, $scope.ticketTypeName, function(data) {
		if (!data || data.length == 0) {
			$scope.noItems = true;
		} else {
			$scope.tickets = data;
		}
		$scope.loaded = true;
	});
	
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

