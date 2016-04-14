<?php

include('connection.php');

$imageName =  trim($_POST['image_name']);
$imageId =  $_POST['image_id'];

if (!isset($imageName) || empty($imageName)){
	$response = array(
			'update' => false,
			'message' => "Image name is required."
		);
} else if (strlen($imageName) <= 2) {
	$response = array(
			'update' => false,
			'message' => "Image name atleast 3 characters in length"
		);
} else {
	$sql =  "UPDATE image SET name = '$imageName' WHERE id = $imageId";
	if ($connection->query($sql)) {
		$response = array(
			'update' => true,
			'message' => "Image name updated successfully.");
		$connection->close();
	} else {
		$response = array(
			'update' => false,
			'message' => "Update image name error.");
	}
}

echo json_encode($response);

