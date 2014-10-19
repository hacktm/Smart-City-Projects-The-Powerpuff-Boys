spreadout.controller("LoginCtrl", ["$scope", "$modalInstance", "bmUsers", "$rootScope",
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
