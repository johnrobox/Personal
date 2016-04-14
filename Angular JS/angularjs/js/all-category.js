myApp.controller('categoryCtrl',function($scope,$http){
					$http.get('http://practice.com/angularjs/json/all-category.php').success(function(data, status, headers, config) {
						$scope.categories = data.category;
					}).error(function(data, status, headers, config) {
						console.log("No data found..");
				  });
				});