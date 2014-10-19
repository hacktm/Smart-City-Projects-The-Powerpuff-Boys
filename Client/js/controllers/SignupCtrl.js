spreadout.controller("SignupCtrl", ["$scope", "$routeParams", "Persons", "bmUsers", "$rootScope", "Colors", "$location",
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
]);