var app = angular.module('myApp', []);

app.controller('myController', function($scope) {
	$scope.friends = [
		{
			id : 1,
			firstname : 'Joshua',
			lastname : 'Ferrer',
			age : 21,
			tweets : [
				{id : 1, text : 'Wow would you look at that sky.'},
				{id : 2, text : 'Got a 30k raise today... I might actualy good'},
				{id : 3, text : 'I hate it when people tweet about me.'}
			]
		},
		{
			id : 2,
			firstname : 'Michael',
			lastname : 'Larubis',
			age : 23,
			tweets : [
				{id: 1, text : 'Will haha you and your sky issues.'},
				{id: 2, text : 'My wife got a 30k raise today. lol'},
				{id: 3, text : 'I love it when people tweet ablut me.'}
			]
		}
	];
})

app.directive('contactCard', function(){
	return {
		restrict : 'E',
		scope : {
			myData : ' = data',
			title : '='
		},
		replace : true,
		// transclude : true,  (if used need to put a ng-transclude in template file)
		// template : '<h1>{{ myData.firstname }} </h1>',
		templateUrl : 'templates/directives/contactCard.html',

		link : function(scope, element, attrs) {
			element.click(function(){
				alert('click');
			});
		},

		controller : function($scope) {
			console.log($scope.myData);

		}
	}
});