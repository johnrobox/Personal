<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    
<!--     angular js  -->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout" ng-app = "myApp">
    <div ng-controller="myCtrl">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Laravel
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

    </div>

    
        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

            <script>
            var myApp = angular.module('myApp', [], function($interpolateProvider) {
                    $interpolateProvider.startSymbol('[[');
                    $interpolateProvider.endSymbol(']]');
                });

            myApp.controller('myCtrl', function ($scope, $http) {
                
                // view all product via API
                getAllProduct($scope, $http);
                
                // add product
                $scope.submitAddProduct = function() {
                    var product = $.param({
                        product_name : $scope.productNameValue,
                        product_description : $scope.productDescValue,
                        product_quantity : $scope.productQuantityValue
                    });
                    
                    $http({
                        method : 'POST',
                        url : 'http://localhost:8000/add_product',
                        data : product,
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    }).success(function(response){
                        if (!response.valid) {
                            $scope.productErrorMessage = response.message;
                        } else {
                            $("#addProductModal").modal('hide');
                            $scope.productMessage = response.message;
                        }
                        getAllProduct($scope, $http);
                    }) 
                }
                
                // Cancel add product
                $scope.cancelAddProduct = function() {
                    $scope.productErrorMessage = "";
                    $scope.productNameValue = "";
                    $scope.productDescValue = "";
                    $scope.productQuantityValue = "";
                    $("#addProductModal").modal("hide");
                }
                
                // Delete product
                $scope.deleteProduct = function(e) {
                    $("#deleteProductModal").modal('show');
                    $scope.productIdToDelete = e;
                }
                $scope.submitProductDelete = function() {
                    $http.get('http://localhost:8000/delete_product/'+$scope.productIdToDelete)
                        .success(function(data, status, headers, config) {
                             if(!data.deleted) {
                                 $scope.productDeleteError = data.message;
                             } else {
                                 getAllProduct($scope, $http);
                                 $('#deleteProductModal').modal('hide');
                                 $scope.productMessage = data.message;
                             }
                        })
                        .error(function() {

                        })
                }
                
                // Update product
                $scope.updateProduct = function(e) {
                    jQuery.map($scope.product_items, function(obj){
                        if (obj.product_id == e){
                            $("#updateProductModal").modal('show');
                            $scope.productNameUpdateValue = obj.product_name;
                            $scope.productDescUpdateValue = obj.product_description;
                            $scope.productQuanUpdateValue = obj.product_quantity;
                            $scope.updateId = obj.product_id;
                        }  
                    })
                }

                $scope.submitProductUpdate = function() {
                    var parameter = $.param({
                        product_id : $scope.updateId,
                        product_name : $scope.productNameUpdateValue,
                        product_description : $scope.productDescUpdateValue,
                        product_quantity : $scope.productQuanUpdateValue
                    });
                    //alert(parameter);
                    $http({
                        method : 'POST',
                        url : 'http://localhost:8000/update_product',
                        data : parameter,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                    }).success(function(response) {
                        if (!response.updated) {
                            $scope.productUpdateError = response.message;
                        } else {
                            getAllProduct($scope, $http);
                            $scope.productMessage = response.message;
                            $("#updateProductModal").modal('hide');
                        }
                    }).error(function(){
                        
                    })
                }
                
            });
            
            //function use to get all products
            function getAllProduct($scope, $http) {
                $http.get('http://localhost:8000/all_product')
                    .success(function(data, status, headers, config) {
                        $scope.product_items = data.products;
                    })
                    .error(function() {
                        
                    });
            }
            
            // for search
            myApp.filter('searchFor', function(){
                    return function(arr, searchString){
                        if(!searchString){
                            return arr;
                        }
                        var result = [];
                        searchString = searchString.toLowerCase();
                        angular.forEach(arr, function(item){
                            if(item.product_name.toLowerCase().indexOf(searchString) !== -1){
                                result.push(item);
                            }
                        });
                        return result;
                    };
                });


            </script>

    
</body>
</html>
