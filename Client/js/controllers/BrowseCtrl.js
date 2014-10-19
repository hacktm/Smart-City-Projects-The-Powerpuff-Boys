spreadout.controller("BrowseCtrl", ["$scope", "$routeParams", "Branches", "bmUsers", "$rootScope", "Colors", "$location",
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
]);