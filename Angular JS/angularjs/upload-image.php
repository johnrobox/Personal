<?php

	include("connection.php");
	include("Library/ImageFileValidator.php");

	
	// $imageName =  trim(htmlspecialchars($_POST['imageName']));
	// //$uploadedFileName = uniqid().$fileExtension;

	// $image = $_FILES['image']['name'];
	//print_r($_FILES['image']);

	$imageObject =  new ImageFileValidator($_FILES['image']);
	$getResult = $imageObject->runImageValidation();
	if ($getResult['valid']) {
		echo "okay";
	} else {
		echo $getResult['message'];
	}
	die();

	// if (move_uploaded_file($_FILES['image']['tmp_name'], 'images/'.$_FILES['image']['name'])) {
	// 	$sql = "INSERT INTO image (name, image, flag) VALUES ('$imageName', '$image', 1)";
	// 	if ($connection->query($sql) === TRUE) {
	// 		echo "New record created successfully";
	// 	} else {
	// 		echo "Error: " . $sql . "</br>" . $connection->error;
	// 	}
	// }
	// echo "<pre>";
	// print_r($_POST);

	// print_r($_FILES);
