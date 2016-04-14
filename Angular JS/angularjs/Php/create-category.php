<?php 

include('../Php/connection.php');
$category = trim($_POST['category_name']);


if (!isset($category) || empty($category)){
	$response = array(
			'create' => false,
			'message' => 'Category name is required.'
		);
} else if (strlen($category) < 3 || strlen($category) > 12) {
	$response = array(
			'create' => false,
			'message' => 'Category name must between 3 - 12 in lenght.' .  strlen($category) . $category
		);
} else {
	$sql = "INSERT INTO category (category_name, category_flag) VALUES ('$category', 1)";
	if ($connection->query($sql)) {
		$response = array(
				'create' => true,
				'message' => 'Added successfully.'
			);
	} else {
		$response = array(
				'create' => false,
				'message' => 'Error in adding category.'
			);
	}
}

echo json_encode($response);