angular.module("ShoutOut.NetworkService", [])

.service('NetDB', function($http) {
var URL = "http://spreadout.cloudapp.net/api/v1/";
return {
	counties: function(callback) {
		$http.get(URL + "search/branch?name=" + name).success(function (response) {
			callback(response);
		});
	},
    cities: function(county, callback) {
		$http.get(URL + "search/branch?name=" + name).success(function (response) {
			callback(response);
		});
	},
	categories: function(cityId, callback) {
		$http.get(URL + "search/tag?city=" + cityId).success(function (response) {
			callback(response);
		});
	},
	branches: function(cityId, categoryId, callback) {
		$http.get(URL + "search/tag?city=" + cityId + "&id=" + categoryId).success(function (response) {
			callback(response);
		});
	},
	search: function(name, city, callback) {
		var url = URL + "search/branch?";
		if (name && city) url += "name=" + name + "&city=" + city;
		else if (name) url += "name=" + name;
		else if (city) url += "city=" + city;
		
		$http.get(url).success(function (response) {
			callback(response);
		});
	},
}
});
