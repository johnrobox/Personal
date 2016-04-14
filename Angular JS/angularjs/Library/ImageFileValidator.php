<?php 
	include('GenerateRandomString.php');
	class ImageFileValidator extends GenerateRandomString {

		private $target_dir = "../images/";
		private $target_file;
		private $imageName;
		private $imageFileType;
		private $imageTempName;
		private $imageSize;
		private $response;

		public function __construct($imageFile) {
			$this->imageName = $imageFile['name'];
			$this->imageTempName = $imageFile['tmp_name'];
			$this->imageSize = $imageFile['size'];

			$this->target_file = $this->target_dir . basename($imageFile['name']);
			$this->imageFileType = pathinfo($this->target_file, PATHINFO_EXTENSION);
		}

		// function to call 
		public function runImageValidation(){
			$run1 = $this->validateExtension();
			$run2 = $this->validateSize();
			$run3 = $this->validateName();
			if (!$run1['valid']) {
				$response = array(
					'valid' => false,
					'message' => $run1['message']
					);	
			} else if (!$run2['valid']) {
				$response = array(
					'valid' => false,
					'message' => $run2['message']
					);
			} else if (!$run3['valid']) {
				$response = array(
					'valid' => false,
					'message' => $run3['message']
					);
			} else {
				$response = array('valid' => true, 'imageName' => $run3['imageName']);
			}
			return $response;
		}

		// Validate  Extension
		public function validateExtension(){
			if ( $this->imageFileType != "jpg" && $this->imageFileType != "JPG" && $this->imageFileType != "png" && $this->imageFileType != "jpeg" && $this->imageFileType != "gif") {
				$response = array(
						'valid' => false,
						'message' => "Sorry, only JPG, JPEG, PNG && GIF files are allowd"
					);
			} else {
				$response = array(
					'valid' => true
					);
			}
			return $response;
		}

		// Validate size
		public function validateSize(){
			if ($this->imageSize > 500000) {
				$response = array(
					'valid' => false,
					'message' => 'Sorry, your file is too large.'
					);
			} else {
				$response = array(
					'valid' => true
					);
			}
			return $response;
		}

		// Validate name
		public function validateName(){
			$imageName = $this->getString(20);
			$this->target_file = $this->target_dir . basename($imageName);
			if (file_exists($this->target_file)) {
				$response = array(
					'valid' => false,
					'message' => 'Sorry, file already exist'
					);
			} else {
				$response = array(
					'valid' => true,
					'imageName' => $imageName . '.' . $this->imageFileType
					);
			}
			return $response;
		}

	}