<?php 
	$baseUrl = "http://practice.com/angularjs/";

	$navigation = array(
		'nav' => array(
				0 => array(
						'menuName' => 'Home',
						'menuUrl' => $baseUrl
					),
				1 => array(
						'menuName' => 'Image Gallery',
						'menuUrl' => $baseUrl.'image_gallery.php'
					),
				2 => array(
						'menuName' => 'About',
						'menuUrl' => $baseUrl.'about.php'
					)
			)
	);

	echo json_encode($navigation);