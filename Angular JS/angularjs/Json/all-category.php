<?php 

	include('../Php/connection.php');

	$sql = "SELECT * FROM category";

	$result = $connection->query($sql);

	$counter = 0;
	$response = array();
	while ($row = mysqli_fetch_assoc($result)) {
		# code...
		$response['category'][] = $row;
		$counter++;
	}
	$response['number_of_category'] = $counter;
	echo json_encode($response);

	$connection->close();