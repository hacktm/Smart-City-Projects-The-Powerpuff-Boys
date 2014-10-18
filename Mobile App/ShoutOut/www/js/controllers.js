angular.module('ShoutOut.controllers', ["ShoutOut.NetworkService"])

.controller('AppCtrl', function($scope, $ionicModal, $timeout) {
  $scope.loggedIn = true;
  
  // Form data for the login modal
  $scope.loginData = {};

  // Create the login modal that we will use later
  $ionicModal.fromTemplateUrl('templates/login.html', {
    scope: $scope
  }).then(function(modal) {
    $scope.modal = modal;
  });
  

  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.modal.hide();
  };
  
  // Open the login modal
  $scope.login = function() {
    $scope.modal.show();
  };
  
  // Execute LogOut
  $scope.logout = function() {
    $scope.loggedIn = false;
  };

  // Perform the login action when the user submits the login form
  $scope.doLogin = function() {
	console.log('User', $scope.loginData.username);
	console.log('Pass', $scope.loginData.password);
	
    // Simulate a login delay. Remove this and replace with your login
    // code if using a login system
    $timeout(function() {
      $scope.closeLogin();
    }, 1000);
	
	$scope.loggedIn = true;
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
		{id:1, title:"County 1"},
		{id:2, title:"County 2"}
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
			{id:1, title:"City 1"},
			{id:2, title:"City 2"}
		];
	} else {
		// A City was Selected
		// Load City
		$scope.cityId = itemId;
		$scope.selectCityTitle = "Done!";
		$scope.closeSelectCity();
	}
  };
})

.controller('SearchController', function($scope, $stateParams) {
	$scope.resuls = [];

	$scope.execute = function(query) {
		alert(query.query);
		$scope.results = [
			{id:1, title:"Item 1"},
			{id:2, title:"Item 2"},
			{id:3, title:"Item 3"},
			{id:4, title:"Item 4"},
			{id:5, title:"Item 5"},
			{id:6, title:"Item 6"},
			{id:7, title:"Item 7"},
			{id:8, title:"Item 8"},
			{id:9, title:"Item 9"},
			{id:10, title:"Item 10"},
			{id:11, title:"Item 11"},
			{id:12, title:"Item 12"},
			{id:13, title:"Item 13"},
			{id:14, title:"Item 14"},
			{id:15, title:"Item 15"},
			{id:16, title:"Item 16"}
		];
	};
})

.controller('CategoriesController', function($scope, $stateParams) {
	$scope.categories = [
		{id:1, title:"Category 1"},
		{id:2, title:"Category 2"},
	];
	$scope.add = function()
	{
		$scope.categories.push({id:3, title:"Category 3"});
	}
})

.controller('CategoryController', function($scope, $stateParams) {
	$scope.categoryName = "Category " + $stateParams.categoryId;
	$scope.companies = [
		{id:1, title:"Company 1"},
		{id:2, title:"Company 2"},
	];
})

.controller('CompanyController', function($scope, $stateParams) {
	$scope.companyName = "Company " + $stateParams.companyId;
	$scope.tickets = [
		{id:1, title:"Ticket 1"},
		{id:2, title:"Ticket 2"},
	];
})

.controller('TicketController', function($scope, $stateParams) {
	$scope.ticketName = "Ticket " + $stateParams.ticketId;
})

.controller('MyTicketsController', function($scope, $stateParams) {
});

