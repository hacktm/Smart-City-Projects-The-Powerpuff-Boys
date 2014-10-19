var spreadout = angular.module("spreadout", ["ngResource", "ngRoute", "bmComponents", "ui.bootstrap", "l10n", "l10n-tools"]);;spreadout.config(["l10nProvider", function (l10nProvider) {
    l10nProvider.add("en-us", {
        "_login_":"Login",
        "_hello_": "Hello,",
        "_browse_": "Browse",
        "_public_api_": "Public API",
        "_contact_": "Contact",
        "_what_are_you_looking_for_": "what are you looking for?",
        "_go_complain_":"Please select a company",
        "_forgot_password_": "Forgot password?",
        "_invalid_cred_": "Invalid credentials",
        "_pricing_": "Pricing"
    });
}]);
;spreadout.config(["$locationProvider", "$httpProvider", "$routeProvider", "bmApiUrlsProvider", "bmCookiesProvider", "bmAuthRequestBufferProvider",
    function($locationProvider, $httpProvider, $routeProvider, bmApiUrlsProvider, bmCookiesProvider, bmAuthRequestBufferProvider) {

        bmApiUrlsProvider.setHostname("spreadout", "spreadout.cloudapp.net/api");
        bmApiUrlsProvider.setHostname("bm", "spreadout.cloudapp.net");
        bmApiUrlsProvider.setUrlGenerator("bm",  function (hostname, port, apiVersion) {
            return (hostname || "");
        });

        bmApiUrlsProvider.setApiVersion("spreadout", 1);
        bmApiUrlsProvider.setUrlGenerator("spreadout",  function (hostname, port, apiVersion) {
            return (hostname || "") + (port || "") + "/v" + apiVersion;
        });

        $httpProvider.interceptors.push("bmAuthResponseInterceptor");

        bmApiUrlsProvider.apiVersion = 1;

        $routeProvider
            .when('/', {
                templateUrl: "templates/start.html",
                controller: "WelcomeCtrl",
                reloadOnSearch: false
            })
            .when('/start', {
                templateUrl: "templates/start.html",
                controller: "WelcomeCtrl",
                reloadOnSearch: false
            })
            .when("/signup", {
                templateUrl: "templates/signup.html",
                controller: "SignupCtrl",
                reloadOnSearch: false
            })
            .when("/browse", {
                templateUrl: "templates/browse.html",
                controller: "BrowseCtrl",
                reloadOnSearch: false
            })
            .when("/company/:id", {
                templateUrl: "templates/company.html",
                controller: "CompanyCtrl",
                reloadOnSearch: false
            })
            .when("/tag/:id", {
                templateUrl: "templates/branch.html",
                controller: "TagCtrl",
                reloadOnSearch: false
            });


        $httpProvider.defaults.headers.common["Content-Type"] = $httpProvider.defaults.headers.post["Content-Type"];
        $httpProvider.interceptors.push("bmAuthResponseInterceptor");

        bmApiUrlsProvider.setUrls("spreadout",
            {
                "branches": "/search/branch",
                "tags": "/search/tag",
                "register": "/person/register",
                "county": "/search/county",
                "city": "/search/city"

            });

        bmCookiesProvider.cookiePrefix = "spreadout";

    }
]);

spreadout.run(["$rootScope", "$http", "bmCookies", "$modal", "Colors", "bmUsers", "$location", "$route",
    function ($rootScope, $http, bmCookies, $modal, Colors, bmUsers, $location, $route) {

        var opened = false;

        $rootScope.$on("bmLoginRequired", function() {

            if(!opened) {
                $modal.open({
                    templateUrl: "templates/login-dialog.html",
                    controller: "LoginCtrl",
                    windowClass: "scs-login-modal"
                }).result.then(function() {
                        opened = false;
                    }, function() {
                        opened = false;
                    });
                opened = true;
            }

        });

        $rootScope.logout =  function() {
            bmUsers.logout($rootScope.user.token).then(function() {
                delete $http.defaults.headers.common[bmAuthRequestBuffer.tokenHeaderName];
                bmCookies.removeItem("user");
            });
        }


        if (bmCookies.hasItem("user")) {
            console.log(Colors);
            $rootScope.user = JSON.parse(bmCookies.getItem("user"));
            console.log($rootScope.user);
            $http.defaults.headers.common["Auth-Token"] = $rootScope.user.authToken;
        }

        $rootScope.templates = {
            NOTIFICATION: "templates/notification.html"
        };
    }
]);
;spreadout.controller("BrowseCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors", "$location",
    function ($scope, $routeParams, Branches, bmUsers, $rootScope, Colors, $location) {

        function init() {
            Branches.getTags().then(function(data) {
                console.log(data);
                $scope.tags = data.data;
            });
        }

        $scope.goTo = function(id) {
            $location.url('/tag/' + id);
        };

        init();


    }
]);;spreadout.controller("CompanyCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors",
    function ($scope, $routeParams, Branches, bmUsers, $rootScope, Colors) {

       function init() {

       };

       init();


    }
]);;spreadout.controller("HeaderCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors",
    function ($scope, $routeParams, Branches, bmUsers, $rootScope, Colors) {

        $(".spr-small-profile").addClass(Colors);
        console.log('dadadadada');


    }
]);;spreadout.controller("LoginCtrl", ["$scope", "$modalInstance", "bmUsers", "$rootScope",
    function ($scope, $modalInstance, bmUsers, $rootScope) {

        $scope.login = function() {
            bmUsers.login({
                loginName: $scope.data.loginName,
                password: $scope.data.password
            }).then(function (data) {
                $rootScope.user = angular.copy(data.data);
                $modalInstance.dismiss();
            }, function (data) {
                if (data.status === 403) {
                    $scope.invalidCredentials = true;
                }
            });
        };

        $scope.ok = function () {
            $modalInstance.close();
        };

        $scope.cancel = function () {
            $modalInstance.dismiss();
        };
    }
]);
;spreadout.controller("SignupCtrl", ["$scope", "$routeParams", "Persons", "bmUsers", "$rootScope", "Colors", "$location",
    function ($scope, $routeParams, Persons, bmUsers, $rootScope, Colors, $location) {

        function init() {
            $scope.newUser = {};

        }

        $scope.register = function() {
            var newuser = angular.copy($scope.newUser);
            console.log(newuser);
            Persons.register(newuser);
        };

        $scope.goTo = function(id) {
            $location.url('/tag/' + id);
        };

        init();


    }
]);;spreadout.controller("TagCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors", "$location",
    function ($scope, $routeParams, Branches, bmUsers, $rootScope, Colors, $location) {

//        console.log($routeParams);
console.log($rootScope);
        function init() {
            var params = {
                id: $routeParams.id
            };

            Branches.getTags(params).then(function(data) {
                console.log(data);
                $scope.branches = data.data[0].branches;
            });
        }

        $scope.goTo = function(id) {
            $location.url('/tag/' + id);
        };

        init();


    }
]);;spreadout.controller("WelcomeCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors", "City",
    function ($scope, $routeParams, Branches, bmUsers, $rootScope, Colors, City) {

        function init() {
            Branches.retrieve().then(function(data) {
                $scope.branches = data.data;
            });
            City.county().then(function(data) {
                $scope.counties = data.data;
                $scope.counties.unshift({id: -1, name:"Select County"});
                $('.selectpicker').selectpicker('resize');
                $scope.selectedCounty = -1;



            });
        }

        $scope.getCities = function() {
            City.city({county: $scope.selectedCounty}).then(function(data) {
                $scope.cities = data.data;
                $scope.selectedCity = $scope.cities[0].id;

            });
        };

        $scope.setCity = function() {
            City.setCity($scope.selectedCity);

            $rootScope.mainCity = City.getCity();
            $rootScope.cityIsSelected = true;
            console.log('dsadas', $rootScope.mainCity);
        };

        $scope.getColor = function() {
            return Colors.toString();
        };


        $scope.login = function() {
            bmUsers.login({
                loginName: $scope.usr.email,
                password: $scope.usr.password
            }).then(function (data) {
                $rootScope.user = angular.copy(data.data);
//                $modalInstance.dismiss();
            }, function (data) {
                if (data.status === 422) {
                    $scope.invalidCredentials = true;
                }
            });
        };

        init();


    }
]);;spreadout.factory("Branches", ["$http", "bmApiUrls",
    function ($http, bmApiUrls) {
        return {
            retrieve: function () {
                return $http.get(bmApiUrls.getUrl("spreadout", "branches"));
            },
            getTags: function (params) {
                if(params) {
                    return $http.get(bmApiUrls.getUrl("spreadout", "tags"), { params: params}) ;
                }
                return $http.get(bmApiUrls.getUrl("spreadout", "tags"));
            }
        }
    }
]);;spreadout.factory("City", ["$http", "bmApiUrls",
    function ($http, bmApiUrls) {
        var savedCity;
        return {
            county: function () {
                return $http.get(bmApiUrls.getUrl("spreadout", "county"));
            },
            city: function (params) {
                return $http.get(bmApiUrls.getUrl("spreadout", "city"), { params: params});
            },
            setCity: function(city) {
                savedCity = city;
            },
            getCity: function() {
                return savedCity;
            }
        }
    }
]);;spreadout.factory("Colors",
    function () {
        var colors = ["spr-bgcolor-green", "spr-bgcolor-purple", "spr-bgcolor-red", "spr-bgcolor-blue", "spr-bgcolor-orange"];
        var chosenColor = Math.floor((Math.random() * 4));
        return colors[chosenColor].toString();
    }
);;spreadout.factory("Persons", ["$http", "bmApiUrls",
    function ($http, bmApiUrls) {
        return {
            register: function (params) {
                return $http.post(bmApiUrls.getUrl("spreadout", "register"), params);
            },
            getTags: function () {
                return $http.get(bmApiUrls.getUrl("spreadout", "tags"));
            }
        }
    }
]);