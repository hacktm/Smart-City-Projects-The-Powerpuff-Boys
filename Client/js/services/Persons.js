spreadout.factory("Persons", ["$http", "bmApiUrls",
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