<!--		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script> -->

<!DOCTYPE html>
<html >
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<style type="text/css">
		#close{
		    display:block;
		    float:right;
		    width:30px;
		    height:29px;
		    background:url(http://www.htmlgoodies.com/img/registrationwelcome/close_icon.png) no-repeat center center;
		}
		.editBackground{
			display: block;
			float: right;
			width: 30px;
			height: 29px;
			background:url(https://cdn2.iconfinder.com/data/icons/windows-8-metro-style/512/edit.png) no-repeat center center;
		}
		.categoryActiveMenu {
			background-color: #ddd;
		}
    </style>

	<body ng-app = "myApp">
		<div ng-controller="fupController">

		<nav class="navbar navbar-inverse">
		  	<div class="container">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="#">Angular Js Study</a>
			    </div>

				<?php $baseUrl = "http://practice.com/angularjs/"; ?>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      	<ul class="nav navbar-nav"  >
			        	<li role="presentation" ng-repeat="x in names">
				  			<a href="<?php echo $baseUrl;?>{{ x.menuUrl }}">{{ x.menuName }}</a>
				  		</li>
			      	</ul>
			    </div> --><!-- /.navbar-collapse

		  	</div><!-- /.container-fluid -->
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-6">
						<form class="form-horizontal" role="form">
							<div class="form-group">
							    <label class="control-label col-sm-2" for="image">Search</label>
							    <div class="col-sm-10">
							      <input type="text" class="form-control" id="image" placeholder="Search image here" ng-model="searchString">
							    </div>
							</div>
						</form>
					</div>
					<div class="col-sm-4 pull-right">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategory"> Add Category </button>
						<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addImage">Add Image</button>
					</div>
				</div>
			</div>

			<div class="errorDisplay"></div>

			<div class="row">
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-heading" style="height: 70px;">
							<ul class="nav navbar-nav" >
								<li role="presentation" id="categoryMenu0">
									<a href="" ng-click="viewByCategory(0)">All</a>
								</li>
					        	<li role="presentation" ng-repeat="x in categories" id="categoryMenu{{x.id}}">
						  			<a href="" ng-click="viewByCategory(x.id)">{{ x.category_name }}</a>
						  		</li>
					      	</ul>
						</div>
						<div class="panel-body" >

							<div class="col-sm-3" ng-repeat="x in items | searchFor:searchString">
							<button class="editBackground" id="{{x.id}}">Edit</button>
								<a id="close" href="" ng-click="deleteImage(x.id, x.category_id)"></a>
								<div class="alert alert-info">
									<div style="height: 50px;">
									{{ x.name }}
									</div>
									<image src="images/{{ x.image }}"   class="img-responsive" style="height: 200px;"/>
								</div>
							</div>

						</div>
						<div class="panel-footer">
							<div class="forPaginationDesign">
								<ul class="pagination">
								  	<li ng-repeat="x in pageNumber" id="{{x}}" class="<?php $page = '{{x}}'; echo ($page == 1)? 'active' : $page;?>">
								  		<a href="#" ng-click="pagenation(x)">{{x}}</a>
								  	</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	<!-- modal for update image name -->
		<div id="editImageModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						Edit
					</div>
					<div class="modal-body">
						<div id="image_update_error_display" class="text-center" style="color:red"></div>
						<div class="form-group">
							<label for="image_name_update_field">Image Name</label>
							<input type="text" class="form-control" id="image_name_update_field"/>
							<input type="hidden" class="form-control" id="image_id_update_field"/>
							<input type="hidden" class="form-control" id="image_category_update_field"/>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" ng-click="updateImageName()" value="Update" class="btn btn-primary"/>
						<button class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>
		</div>
 
 	<!-- modal for adding images -->
	 	<div id="addImage" class="modal fade" role="dialog">
	 		<div class="modal-dialog">
	 			<div class="modal-content" >
	 				<div class="modal-header">
	 					<button type="button" class="close" data-dismiss="modal">&times;</button>
	 					<h4>Add Image</h4>
	 					<div class="addImageError text-center" style="color: red"></div>
	 				</div>

	 				<div>
		 				<div class="modal-body">
		 					<div class="form-group">
		 						<label for="category">Category Name</label>
		 						<select id="category"  class="form-control" ng-model="categoryName">
		 							<option value="">== Select Image Category ==</option>
		 							<option ng-repeat="x in categories" value="{{ x.id }}">  
		 							{{ x.category_name }}
		 							</option>
		 						</select>
		 					</div>

		 					<div class="form-group">
					        	<input type="file" id="file" name="file" multiple
					            onchange="angular.element(this).scope().getFileDetails(this)" class="form-control"/>
					        </div>

					        <!--ADD A PROGRESS BAR ELEMENT.-->
					        <p><progress id="pro" value="0"></progress></p>

		 				</div>
		 				<div class="modal-footer">
		 					<input type="button" ng-click="uploadFiles()" value="Upload" class="btn btn-primary"/>
		 					<button data-dismiss="modal" class="btn btn-default">Cancel</button>
		 				</div>
	 				</div>

	 			</div>
	 		</div>
 		</div>


 		<!-- modal for add category -->
 		<div id="addCategory" class="modal fade" rold="dialog">
	 		<div class="modal-dialog">
	 			<div class="modal-content" >
	 				<div class="modal-header">
	 					<button type="button" class="close" data-dismiss="modal">&times;</button>
	 					<h4>Add Category</h4>
	 					<div class="categoryError text-center" style="color: red"></div>
	 				</div>

	 				<div>
		 				<div class="modal-body">
		 					<div class="form-group">
		 						<label for="category">Category</label>
		 						<input type="text" id="add_category_field" class="form-control" placeholder="Enter category name" />
		 					</div>
		 				</div>
		 				<div class="modal-footer">
		 					<button class="btn btn-primary" ng-click="addNewCategory()">Create</button>
		 					<button data-dismiss="modal" class="btn btn-default">Cancel</button>
		 				</div>
	 				</div>
	 			</div>
	 		</div>
 		</div>
 	</div>


 		<script>

 		$(document).ready(function() {

			    $(document).on("click", ".editBackground", function() {
				   var imageId = $(this).attr('id');
				   $.ajax({
				   		url : 'http://practice.com/angularjs/json/single-image.php',
				   		'dataType' : 'json',
				   		'type' : 'post',
				   		'data' : {
				   			image_id : imageId
				   		},
				   		success: function(msg) {
				   			$("#editImageModal").modal("show");
				   			document.getElementById("image_name_update_field").value = msg.name;
				   			document.getElementById("image_id_update_field").value = msg.id;
				   		},
				   		error: function(error){

				   		}
				   });
				});


 		});
   
        </script>

        <script> var myApp = angular.module('myApp', []);</script>
        <script src="http://practice.com/angularjs/js/add-image.js"></script>
      <!--   <script src="http://practice.com/angularjs/js/all-image.js"></script>
        <script src="http://practice.com/angularjs/js/all-category.js"></script> -->
        

		<script>
			// This is for menu
			myApp.controller('namesCtrl', function($scope) {
			    $scope.names = [
			        {menuName:'Home',menuUrl: ''},
			        {menuName:'Image Gallery',menuUrl:'image_gallery'},
			        {menuName:'About',menuUrl:'about'}
			    ];
			});
		</script>
 
	</body>
</html>

