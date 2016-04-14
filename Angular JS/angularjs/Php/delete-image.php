<?php

include('connection.php');

$imageId =  $_GET['id'];

$sql = "DELETE FROM image WHERE id = $imageId";

if ($connection->query($sql)) {
	$response = array(
			'delete' => true,
			'message' => 'Image successfully deleted.'
		);
} else {
	$response = array(
		    'delete' => false,
		    'message' => 'Not '
		);
}
$connection->close();

echo json_encode($response);