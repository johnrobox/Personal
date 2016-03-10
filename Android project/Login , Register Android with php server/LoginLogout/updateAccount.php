<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require 'connection.php';
	updateAccount();
} else {
    echo 'Error';
}

function updateAccount() {
    global $connect;       
    $data = json_decode(file_get_contents('php://input'), true);

    $response = array();
    
    if (!$data) {
        $response['error']['message'] = "Invalid request.";
    } else {
        if (!isset($data['firstname']) || empty(trim($data['firstname']))) {
            $response['error']['message'] = "Firstname is required.";
        } else if (!isset($data['lastname']) || empty(trim($data['lastname']))) {
            $response['error']['message'] = "Lastname is required.";
        } else if (!isset($data['email']) || empty(trim($data['email']))) {
            $response['error']['message'] = "Email is required.";
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $response['error']['message'] = 'Invalid email format.';
        } else {
            $firstname = ucwords(strtolower(trim($data['firstname'])));
            $lastname = ucwords(strtolower(trim($data['lastname'])));
            $email = trim($data['email']);
            $token = $data['token'];
            
            mysqli_query($connect, "UPDATE users SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE token = '$token'");
            mysqli_close($connect);
            $response['okay']['message'] = "Account successfully change.";
        }
    }
    echo json_encode($response);
}