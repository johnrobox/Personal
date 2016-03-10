<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require 'connection.php';
	loginUser();
} else {
    echo 'Error';
}


function loginUser() {
    global $connect;
    
    $data = json_decode(file_get_contents('php://input'), true);
    $response = array();
    
    if (!$data) {
        $response['error']['message'] = 'Invalid request.';
    } else {
        if (!isset($data['email']) || empty(trim($data['email']))) {
            $response['error']['message'] = 'Email is required.';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $response['error']['message'] = 'Invalid email address.';
        } else if (!isset ($data['password']) || empty(trim($data['password']))) {
            $response['error']['message'] = 'Password is required.';
        } else {
            $email = $data['email'];
            $getEmail = mysqli_query($connect, "SELECT id, password FROM users WHERE email = '$email'");
            if ($getEmail->num_rows > 0 ) {
                while($row = $getEmail->fetch_assoc()) {
                    $id = $row["id"];
                    $password = $row["password"];
                }
                if (password_verify($data['password'], $password)) {
                    $token = generateRandomString(50);
                    $lastLogin = date('Y-m-d H:i:s');
                    mysqli_query($connect, "UPDATE users SET token = '$token', last_login = '$lastLogin' WHERE id = $id");
                    $response['token'] = $token;
                } else {
                    $response['error']['message'] = 'Username / Password is not correct.';
                }
            } else {
                $response['error']['message'] = 'Username / Password is not correct.';
            }
        }
    }
    echo json_encode($response);
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 

