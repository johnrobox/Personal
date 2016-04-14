
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

<div ng-app = "myApp">	
	<div ng-controller="PersonListCtrl">
	    <ul>
	        <li ng-repeat="x in categories">
	            {{ x.category_name }}
	        </li>
	    </ul>
	   <button ng-click="loadData()">Refresh</button>
	   <button id="clickme">Click me</button>
	</div>
</div>

<script type="text/javascript">
	var myApp = angular.module('myApp', []);
	

		myApp.controller('PersonListCtrl',function($scope,$http){
			//$scope.loadData = function(){
					
				//}
				getAll($scope, $http);

				$("#clickme").click(function() {
					getAll($scope, $http);
				});

		});

		function getAll($scope, $http){
			$http.get('http://practice.com/angularjs/json/all-category.php').success(function(data, status, headers, config) {
						$scope.categories = data.category;
						alert();
					}).error(function(data, status, headers, config) {
						console.log("No data found..");
				  	});
		}


	
</script>