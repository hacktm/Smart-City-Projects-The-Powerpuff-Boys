spreadout.controller("TagCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors", "$location",
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
]);