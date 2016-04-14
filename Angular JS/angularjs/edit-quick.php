  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>


      <div ng-app="myApp">
        <div ng-controller="ClickToEditCtrl">

          <div ng-repeat="x in title">
            <div ng-hide="editorEnabled">
              {{ x.menuName }} {{ x.id }}
              <a href="#" ng-click="editorEnabled = ! editorEnabled">Edit title</a>
            </div>

            <div ng-show="editorEnabled">
              <input ng-model="editableTitle" ng-show="editorEnabled">
              <a href="#" ng-click="save(x.id)">Save</a>
              or
              <a href="#" ng-click="disableEditor()">cancel</a>.
            </div>
            <hr>
          </div>

        </div>
      </div>


<script>
var myApp = angular.module('myApp', []);

myApp.controller('ClickToEditCtrl', function ($scope) {

   $scope.title = [
              {menuName:'Home',id: 1},
              {menuName:'Image Gallery',id: 2},
              {menuName:'About',id: 3}
          ];


    //$scope.title = "Welcome to this demo!";
    $scope.editorEnabled = false;
    
    $scope.enableEditor = function() {
      $scope.editorEnabled = true;
      $scope.editableTitle = "hELLO WORLD";
    };
    
    $scope.disableEditor = function() {
      $scope.editorEnabled = false;
    };
    
    $scope.save = function(e) {
      alert($scope.menuName);
      alert(e);
      $scope.title = $scope.editableTitle;

      $scope.disableEditor();

    };

});
</script>