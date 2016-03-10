<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require 'connection.php';
	createStudent();
} else {
    echo 'Error';
}

function createStudent(){
	global $connect;
        
        $data = json_decode(file_get_contents('php://input'), true);
        
        $response = array();
        if (!$data) {
            $response['error']['message'] = 'Invalid request.';
            
        } else {
            if (!isset($data['firstname']) || empty(trim($data['firstname']))) {
                $response['error']['message'] = 'Firstname is required.';
                
            } else if (!isset ($data['lastname']) || empty(trim($data['lastname']))) {
                $response['error']['message'] = 'Lastname is required.';
                
            } else if (!isset($data['email']) || empty(trim($data['email']))) {
                $response['error']['message'] = 'Email is required.';
                
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $response['error']['message'] = 'Invalid email format';
                
            } else if (!isset ($data['password']) || empty(trim($data['password']))) {
                $response['error']['message'] = 'Password is required.';
                
            } else if (strlen($data['password']) < 6) {
                $response['error']['message'] = 'Password must atleast 6 in length.';
                
            } else if (!isset ($data['confirmPassword']) || empty(trim($data['confirmPassword']))) {
                $response['error']['message'] = 'Confirm Password is required.';
                
            } else if ($data['password'] != $data['confirmPassword']) {
                $response['error']['message'] = 'Password and Confirm password is not match.';
                
            } else {
                
                $firstname = $data['firstname'];
                $lastname = $data['lastname'];
                $email = $data['email'];
                $password = password_hash($data['password'], PASSWORD_BCRYPT);
                
                $checkExist = mysqli_query($connect, "SELECT * FROM users WHERE email = '$email'");
                if (mysqli_num_rows($checkExist) > 0) {
                    $response['error']['message'] = 'Email is already exists.';
                    
                } else {
                    $query = "INSERT INTO users(firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password');";
                    mysqli_query($connect, $query);
                    $response['created'] =  true;
                    
                }
                mysqli_close($connect);
            }
        }
	
        echo json_encode($response);
}