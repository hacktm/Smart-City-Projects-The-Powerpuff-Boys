angular.module("SpreadOut.NetworkService", [])

.service('NetDB', function($http) {
var URL = "http://spreadout.cloudapp.net/api/v1/";
var AUTH = "http://spreadout.cloudapp.net/users/authentication";
return {
    login: function(email, pass, callback, failback) {
		$http.post(AUTH, {loginName: email, password: pass})
			.success(function (response) {
				callback(response);
			})
			.error(function(response) {
				failback(response);
			});
	},
	logout: function(token, callback, failback) {
		$http.delete(AUTH + "/" + token)
			.success(function (response) {
				callback(response);
			})
			.error(function(response) {
				failback(response);
			});
	},
	counties: function(callback) {
		$http.get(URL + "search/county").success(function (response) {
			callback(response);
		});
	},
    cities: function(countyId, callback) {
		$http.get(URL + "search/city?county=" + countyId).success(function (response) {
			callback(response);
		});
	},
	categories: function(cityId, callback) {
		$http.get(URL + "search/tag?city=" + cityId).success(function (response) {
			callback(response);
		});
	},
	company: function(companyId, callback) {
		$http.get(URL + "search/company?id=" + companyId).success(function (response) {
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
	tickets: function(branchId, typeString, callback) {
		$http.get(URL + "search/ticket?branch_id=" + branchId + "&type=" + typeString).success(function (response) {
			callback(response);
		});
	},
	ticket: function() {
	
	}
}
});
