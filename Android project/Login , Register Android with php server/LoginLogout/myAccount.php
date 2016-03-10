<?php

if($_SERVER["REQUEST_METHOD"] == "POST") {
	require 'connection.php';
	myAccount();
} else {
    echo 'Error';
}

function myAccount() {
    global $connect;       
    $data = json_decode(file_get_contents('php://input'), true);

    $response = array();
    
    if (!$data) {
        $response['error']['message'] = "Invalid request.";
    } else {
        if (!isset($data['token']) || empty(trim($data['token']))) {
            $response['error']['message'] = "Token is required.";
        } else {
            $token = trim($data['token']);
            $query = mysqli_query($connect, "SELECT firstname, lastname, email, last_login FROM users WHERE token ='$token'");
            if ($query->num_rows > 0 ) {
                while($row = $query->fetch_assoc()) {
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $email = $row['email'];
                    $lastLogin = $row['last_login'];
                }
                
                $response = array(
                    'okay' => array(
                        'firstname' => ucwords(strtolower($firstname)),
                        'lastname' => ucwords(strtolower($lastname)),
                        'email' => $email,
                        'last_login' => date('F d, Y', strtotime($lastLogin))
                        )
                );
            } else {
                $response['error']['message'] = "Token is not correct.";
            }
            mysqli_close($connect);
        }
    }
    echo json_encode($response);
} 