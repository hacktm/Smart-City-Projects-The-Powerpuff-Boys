angular.module('ShoutOut.controllers', ["ShoutOut.NetworkService"])

.controller('AppCtrl', function($scope, $ionicModal, $timeout, NetDB) {
  if (window.localStorage["loggedIn"])
	$scope.loggedIn = window.localStorage["loggedIn"] || false;
  else {
	window.localStorage["loggedIn"] = false;
	$scope.loggedIn = false;
  }
  $scope.auth_action = $scope.loggedIn == true ? "Logout" : "Login";
	
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
	
	window.localStorage["loggedIn"] = true;
	$scope.loggedIn = true;
	$scope.auth_action = "Logout";
  };
  
  $scope.doLogout = function() {
	window.localStorage["loggedIn"] = false;
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
  
  $scope.itemSelected = function(itemId) {
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
		window.localStorage["city"] = itemId;
		$scope.cityId = itemId;
		$scope.selectCityTitle = "Done!";
		$scope.closeSelectCity();
	}
  };
})

.controller('SearchController', function($scope, $stateParams, NetDB) {
	$scope.resuls = [];
	$scope.loaded = true;
	$scope.noItems = false;
	
	$scope.execute = function(query) {
		$scope.loaded = false;
		NetDB.search(query.query, window.localStorage["city"], function(data) { 
			if  (!data || data.length == 0) {
				$scope.noItems = true;
			} else {
				$scope.results = data;
				$scope.loaded = true;
			}
		});
	};
})

.controller('CategoriesController', function($scope, $stateParams, NetDB) {
	$scope.categories = [];
	$scope.loaded = false;
	$scope.noItems = false;
	
	NetDB.categories(function(data) { 
		if (!data || data.length == 0) {
			$scope.noItems = true;
		} else {
			$scope.categories = data;
			$scope.loaded = true;
		}
	});
})

.controller('CategoryController', function($scope, $stateParams) {
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
	$scope.companyName = $stateParams.companyName;
	
	$scope.tickets = [];
	$scope.loaded = false;
	$scope.noItems = false;
	
	$scope.tickets = [
		{id:1, name:"Ticket 1"},
		{id:2, name:"Ticket 2"},
	];
})

.controller('TicketController', function($scope, $stateParams) {
	$scope.ticketName = $stateParams.ticketName;
})

.controller('MyTicketsController', function($scope, $stateParams) {
});

