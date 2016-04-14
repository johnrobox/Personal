<?php	
	include('../Library/ImageFileValidator.php');
	include('../Php/connection.php');
	
	$imageName = (isset($_POST['imageName']) && $_POST['imageName'] != "undefined") ? trim($_POST['imageName']) : "";

	if (isset($_FILES['imageFile'])) {
		$imageFile = $_FILES['imageFile'];
		$validator = new ImageFileValidator($imageFile);
		$result =  $validator->runImageValidation();
	} else {
		$image = "";
	} 
	
	if (empty($imageName)) {
		$response = array(
			'upload' => false,
			'message' => 'Image name is required.');
	} else if (empty($imageFile)) {
		$response = array(
			'upload' => false,
			'message' => 'Image is required.');
	} else if (!$result['valid']) {
		$response = array(
				'upload' => false,
				'message' => $result['message']
			);
	} else {
		if (move_uploaded_file($imageFile['tmp_name'], '../images/' . $result['imageName'])) {
			$sql = "INSERT INTO image (name, image, flag) VALUES ('$imageName', '" . $result['imageName'] . "', 1)";
			if ($connection->query($sql) === TRUE) {
				$response = array(
					'upload' => true,
					'message' => "New record created successfully"
					);
			} else {
				$response = array(
					'upload' => false,
					'message' => 'Error in saving to database'
					);
			}
		}
	}
	echo json_encode($response);

	$connection->close();
