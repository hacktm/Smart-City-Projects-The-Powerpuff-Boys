spreadout.factory("City", ["$http", "bmApiUrls",
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
]);