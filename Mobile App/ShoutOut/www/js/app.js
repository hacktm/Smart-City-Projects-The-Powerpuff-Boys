angular.module('ShoutOut', ['ionic', 'ShoutOut.controllers'])

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

    .state('app', {
      url: "/app",
      abstract: true,
      templateUrl: "templates/menu.html",
      controller: 'AppCtrl'
    })

    .state('app.search', {
      url: "/search",
      views: {
        'menuContent' :{
          templateUrl: "templates/search.html",
		  controller: "SearchController"
        }
      }
    })

    .state('app.categories', {
      url: "/categories",
      views: {
        'menuContent' :{
          templateUrl: "templates/categories.html",
		  controller: "CategoriesController"
        }
      }
    })
	
	.state('app.category', {
      url: "/category/:categoryId/:categoryName",
      views: {
        'menuContent' :{
          templateUrl: "templates/category.html",
		  controller: "CategoryController"
        }
      }
    })
	
	.state('app.company', {
      url: "/company/:companyId/:comapnyName",
      views: {
        'menuContent' :{
          templateUrl: "templates/company.html",
		  controller: "CompanyController"
        }
      }
    })
	
	.state('app.ticket', {
      url: "/ticket/:ticketId/:ticketName",
      views: {
        'menuContent' :{
          templateUrl: "templates/ticket.html",
		  controller: "TicketController"
        }
      }
    })
	
    .state('app.mytickets', {
      url: "/mytickets",
      views: {
        'menuContent' :{
          templateUrl: "templates/mytickets.html",
          controller: 'MyTicketsController'
        }
      }
    });
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/app/search');
});

