<?php

	$serverName = "localhost";
	$userName = "root";
	$password = "";
	$database = "angularjs";

	// create connection
	global $connection;
	$connection = new mysqli($serverName, $userName, $password, $database);
	
	// check connection
	if ($connection->connect_error) {
		die("Connection failed : " . $connection->connect_error);
	}