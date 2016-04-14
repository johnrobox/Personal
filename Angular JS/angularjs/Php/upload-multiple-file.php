<?php 

	include('../Library/ImageFileValidator.php');
	include('../Php/connection.php');

	if (isset($_POST['category_name']) && $_POST['category_name'] != '? undefined:undefined ?') {
		$categoryName = $_POST['category_name'];
	} else {
		$categoryName = "";
	}

	//print_r($_FILES);

	if (empty($categoryName)) {
		$response = array(
			'upload' => false,
			'message' => 'Category name is required.'
			);

	} else {

		$validImageCounter = 0;

		if(isset($_FILES) && is_array($_FILES) && count($_FILES) != 0) {

			$notUploadedRecord = array();
			$uploadedRecord = array();

			foreach($_FILES as $key) {
				$validator = new ImageFileValidator($key);
				$result =  $validator->runImageValidation();
				if (!$result['valid']) {
					$notUploadedRecord[] = array(
							'image' => $key['name'],
							'error' => $result['message']
						);
				} else {
					if (move_uploaded_file($key['tmp_name'], '../images/' . $result['imageName'])) {
						$filename = pathinfo($key['name'], PATHINFO_FILENAME);
						$sql = "INSERT INTO image (name, image, category_id) VALUES ('$filename', '".$result['imageName']."', $categoryName)";
						$connection->query($sql);

						$uploadedRecord[] = array(
								"image" => $key['name']
							);

						$validImageCounter++;
					} else {
						$notUploadedRecord = array(
							'image' => $key['name'],
							'error' => 'Cannot upload image.'
							);
					}
				}
			}

			$response = array(
					'valid' => true,
					'summary' => array(
							'uploaded' => $uploadedRecord,
							'not_uploaded' => $notUploadedRecord
						)
				);

		} else {
			$response = array(
					'upload' => false,
					'message' => 'Image is required.'
				);
		}

	}

	$connection->close();
	
	// echo '<pre>';
	// print_r($response);

	echo json_encode($response);