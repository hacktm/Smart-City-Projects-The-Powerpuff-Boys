spreadout.factory("Branches", ["$http", "bmApiUrls",
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
]);