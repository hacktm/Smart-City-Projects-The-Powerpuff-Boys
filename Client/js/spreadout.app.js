var spreadout = angular.module("spreadout", ["ngResource", "ngRoute", "bmComponents", "ui.bootstrap", "l10n", "l10n-tools"]);;spreadout.config(["l10nProvider", function (l10nProvider) {
    l10nProvider.add("en-us", {
        "_login_":"Login",
        "_what_are_you_looking_for_": "Hi, what are you looking for?",
        "_go_complain_":"Please select a company"
    });
}]);
;spreadout.config(["$locationProvider", "$httpProvider", "$routeProvider", "bmApiUrlsProvider", "bmCookiesProvider", "bmAuthRequestBufferProvider",
    function($locationProvider, $httpProvider, $routeProvider, bmApiUrlsProvider, bmCookiesProvider, bmAuthRequestBufferProvider) {

        bmApiUrlsProvider.setHostname("spreadout", "37.59.106.168");
        bmApiUrlsProvider.setHostname("bm", "37.59.106.168");
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
            .when("/crawlproject/:projectId", {
                templateUrl: "templates/sitechannel/sitechannel-list.html",
                controller: "SiteChannelListCtrl",
                reloadOnSearch: false
            });


        $httpProvider.defaults.headers.common["Content-Type"] = $httpProvider.defaults.headers.post["Content-Type"];
        $httpProvider.interceptors.push("bmAuthResponseInterceptor");

        bmApiUrlsProvider.setUrls("spreadout",
            {
                "demo": "/demo"
            });

        bmCookiesProvider.cookiePrefix = "spreadout";

    }
]);

spreadout.run(["$rootScope", "$http", "bmCookies", "$modal",
    function ($rootScope, $http, bmCookies, $modal) {

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

        if (bmCookies.hasItem("user")) {
            $rootScope.user = JSON.parse(bmCookies.getItem("user"));
            $http.defaults.headers.common["Auth-Token"] = $rootScope.user.authToken;
        }

        $rootScope.templates = {
            NOTIFICATION: "templates/notification.html"
        };
    }
]);
;spreadout.controller("WelcomeCtrl", ["$scope", "$routeParams",
    function ($scope, $routeParams) {

        function init() {


        }

        init();


    }
]);