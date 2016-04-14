myApp.controller('fupController', function ($scope, $http) {

		// show all images	
		requestAllImage($scope, $http, 0, 1);

		$scope.categorIdReserved = 0;

		$("#categoryMenu"+$scope.categorIdReserved).addClass("categoryActiveMenu");

		// show all Category
		requestAllCategory($scope, $http);

		// for image update name (category spec to return)
		document.getElementById("image_category_update_field").value = 0;

		// create category
		$scope.addNewCategory = function() {
			//$("#categoryMenu4").addClass("categoryActiveMenu");

			var category = $.param({
				category_name : $("#add_category_field").val()
			});
			$http({
				method : 'POST',
				url : 'http://practice.com/angularjs/php/create-category.php',
				data : category,
				headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
			}).success(function(response) {
				if (!response.create) {
					$(".categoryError").html(response.message);
				} else {
					$("#addCategory").modal("hide");

					requestAllCategory($scope, $http);
				}
			})
		}


		// show by image category
		$scope.viewByCategory = function(e) {
			var categoryIs = 0;
			if (e != $scope.categorIdReserved) {
				$("#categoryMenu"+$scope.categorIdReserved).removeClass("categoryActiveMenu");
				$("#categoryMenu"+e).addClass("categoryActiveMenu");
				$scope.categorIdReserved = e;
			}
			if (e != 0) {
				categoryIs = e;
				$http.get('http://practice.com/angularjs/json/image-by-category.php?id='+e+'&&page=1').success(function(data, status, headers, config) {
					
					var output = [];
					var allPages = data.all_pages;
					if (allPages != 1) {
						for (var i=1;  i <= allPages; i++) {
							output.push(i);
							$("#"+i).removeClass("active");
						}
					}
					$scope.activePage = 1;
					$scope.items = data.images;
					$scope.pageNumber = output;
					alert($scope.pageNumber);
					$("#1").addClass("active");

				}).error(function(data, status, headers, config) {
					console.log("No data found..");
				});   
			} else {
				requestAllImage($scope, $http, 0, 1);
			}
			document.getElementById("image_category_update_field").value = categoryIs;
		}

		// update image
		$scope.updateImageName =  function() {
		 	var category_id = $("#image_category_update_field").val();
			var payload = $.param({ 
			 		image_id : $("#image_id_update_field").val(),
			 		image_name : $("#image_name_update_field").val()
			 	});
                $http({
                    method: 'POST',
                    url: 'http://practice.com/angularjs/php/update-image.php',
                    data: payload,
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                }).success(function (response) {
                	if (!response.update) {
                		$("#image_update_error_display").html(response.message);mn
                	} else {
                		$('.errorDisplay').html("<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + response.message + "</div>");
                		$("#editImageModal").modal("hide");
                		requestAllImage($scope, $http, category_id, $scope.activePage);
                	}
                })
		 }

		// delete image
		$scope.deleteImage = function(id, category_id) {
			$http.get('http://practice.com/angularjs/Php/delete-image.php?id='+id).success(function(data, status, headers, config) {
				$('.errorDisplay').html("<div class='alert alert-info'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + data.message + "</div>");
				
				var remaining = $scope.items.length;
				var the_active_page = $scope.activePage;
				var currentPage; 
				if (remaining == 1 && the_active_page > 1) {
					var now_page_is = the_active_page - 1;
					currentPage = now_page_is;
					$scope.activePage = now_page_is;
				} else {
					currentPage = $scope.activePage;
				}
				requestAllImage($scope, $http, category_id, currentPage);
			}).error(function(data, status, headers, config) {
				console.log("No data found..");
			}); 
		}

		// image pagination
		$scope.pagenation = function(e) {
			var category_id =  $scope.categorIdReserved;
			if (typeof category_id == "undefined") {
				category_id = 0;
			}
			$scope.activePage = e;
			requestAllImage($scope, $http, category_id, e);
		}

        // GET THE FILE INFORMATION.
        $scope.getFileDetails = function (e) {
            $scope.files = [];
            $scope.$apply(function () {

                // STORE THE FILE OBJECT IN AN ARRAY.
                for (var i = 0; i < e.files.length; i++) {
                    $scope.files.push(e.files[i])
                }

            });
        };

        // NOW UPLOAD THE FILES.
        $scope.uploadFiles = function () {

            //FILL FormData WITH FILE DETAILS.
            var categoryGetId = $("#category").val();
            var data = new FormData();
            var counter = 0;
            for (var i in $scope.files) {
                data.append(counter, $scope.files[i]);
                counter++;
            }
            data.append("category_name", categoryGetId);

            // ADD LISTENERS.
            var objXhr = new XMLHttpRequest();

            // SEND FILE DETAILS TO THE API.
            objXhr.onreadystatechange = function() {
		    	if (objXhr.readyState == 4 && objXhr.status == 200) {
			      	var response = JSON.parse(objXhr.responseText);
			      	if (response.valid) {

			      		var toDisplay = "";
			      		var forUploadResponseText = "";
			      		var forNotUploadResponseText = "";
			      		var okay = response.summary.uploaded;
			      		var notOkay = response.summary.not_uploaded;
			      		var hasUploaded = false;
			      		var hasNotUploaded = false;

			      		okay.forEach(function(entry){
			      			console.log(entry);
			      			hasUploaded = true;
			      			forUploadResponseText = forUploadResponseText + "<li>" + entry.image + " </li> ";
			      		});

			      		notOkay.forEach(function(entry){
			      			hasNotUploaded = true;
			      			forNotUploadResponseText = forNotUploadResponseText + "<li>" + entry.image + " - ("+entry.error+")</li>";
			      		});

			      		if (hasUploaded) {
			      			toDisplay = "<div style='color: green'><b>List of Uploaded Files </b><ul>" + forUploadResponseText + "</ul></div>";
			      		}
			      		if (hasNotUploaded) {
			      			toDisplay =  toDisplay + "<div style='color: red'><b>List of invalid files </b><ul>" + forNotUploadResponseText + "</ul></div>";
			      		}
			      		$("#addImage").modal("hide");
			      		$('.errorDisplay').html("<div class='alert alert-success'> <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>" + toDisplay + "</div>");
			      		
			      		// show all images	
						requestAllImage($scope, $http, categoryGetId, 1);

			      	} else {
			      		$(".addImageError").html(response.message);
			      	}
			    }
			};

            objXhr.open("POST", "http://practice.com/angularjs/php/upload-multiple-file.php");
            objXhr.send(data);

        }

    });

// show all category function
function requestAllCategory($scope, $http) {
	$http.get('http://practice.com/angularjs/json/all-category.php').success(function(data, status, headers, config) {
				$scope.categories = data.category;
			}).error(function(data, status, headers, config) {
				console.log("No data found..");
			});
			$("#categoryMenu"+2).addClass("categoryActiveMenu");		
}

// show image  all or by category function
function requestAllImage($scope, $http, category_id, page) {
	var requestUrl;
    
	if (category_id != 0 ){
		requestUrl = "http://practice.com/angularjs/json/image-by-category.php?id="+category_id+"&&page="+page;
	} else {
		requestUrl = "http://practice.com/angularjs/json/all-image.php?page="+page;
	}

	$http.get(requestUrl).success(function(data, status, headers, config) {
			
			var output = [];
			var allPages = data.all_pages;
			if (allPages != 1) {
				for (var i=1;  i <= allPages; i++) {
					output.push(i);
					$("#"+i).removeClass("active");
				}
			}
			$("#"+page).addClass("active");

			$scope.items = data.images;
			$scope.pageNumber = output;

		}).error(function(data, status, headers, config) {
			console.log("No data found..");
		});   
}

myApp.filter('searchFor', function(){
					return function(arr, searchString){
						if(!searchString){
							return arr;
						}
						var result = [];
						searchString = searchString.toLowerCase();
						angular.forEach(arr, function(item){
							if(item.name.toLowerCase().indexOf(searchString) !== -1){
								result.push(item);
							}
						});
						return result;
					};
				});