<?php 

	include('../Php/connection.php');

	$imageId =  $_POST['image_id'];

	$sql = "SELECT image.id, image.name FROM image WHERE id = $imageId";

	$result = $connection->query($sql);

	$response = array();
	while ($row = mysqli_fetch_assoc($result)) {
		# code...
		$response = $row;
	}

	echo json_encode($response);

	$connection->close();