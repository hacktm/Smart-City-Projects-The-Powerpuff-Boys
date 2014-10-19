spreadout.controller("WelcomeCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors", "City",
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
]);