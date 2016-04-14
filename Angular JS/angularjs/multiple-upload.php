<!DOCTYPE html>
<html>
<head>
  <title>File Upload Example in AngularJS</title>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.4/angular.min.js"></script>
</head>

<body ng-app="fupApp">

    <div ng-controller="fupController">
        <input type="file" id="file" name="file" multiple
            onchange="angular.element(this).scope().getFileDetails(this)" />

        <input type="button" ng-click="uploadFiles()" value="Upload" />

        <!--ADD A PROGRESS BAR ELEMENT.-->
        <p><progress id="pro" value="0"></progress></p>
    </div>

</body>
<script>
    var myApp = angular.module('fupApp', []);

    myApp.controller('fupController', function ($scope) {

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
            var data = new FormData();
            var counter = 0;
            for (var i in $scope.files) {
                data.append(counter, $scope.files[i]);
                counter++;
            }

            // ADD LISTENERS.
            var objXhr = new XMLHttpRequest();
            objXhr.addEventListener("progress", updateProgress, false);
            objXhr.addEventListener("load", transferComplete, false);

            // SEND FILE DETAILS TO THE API.
            objXhr.open("POST", "http://practice.com/angularjs/process.php");
            objXhr.send(data);
        }

        // UPDATE PROGRESS BAR.
        function updateProgress(e) {
            if (e.lengthComputable) {
                document.getElementById('pro').setAttribute('value', e.loaded);
                document.getElementById('pro').setAttribute('max', e.total);
            }
        }

        // CONFIRMATION.
        function transferComplete(e) {
            alert("Files uploaded successfully.");
        }
    });
</script>
</html>