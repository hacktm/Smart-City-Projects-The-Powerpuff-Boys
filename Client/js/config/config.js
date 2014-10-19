spreadout.config(["$locationProvider", "$httpProvider", "$routeProvider", "bmApiUrlsProvider", "bmCookiesProvider", "bmAuthRequestBufferProvider",
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
