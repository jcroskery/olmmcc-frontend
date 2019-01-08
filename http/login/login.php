<?php
session_start();
    require_once '/srv/logincreds.php';
    require_once '/srv/http/helpers/displayMessage.php';
    $connection = new mysqli($hn, $un, $pw, $db);
    if($connection->connect_error) die("Connection error");
    $email = strtolower(sanitizeString($_POST['email']));
    $password = sanitizeString($_POST['password']);
    $stmt = $connection->prepare("SELECT * FROM userlist WHERE email = ?");
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_NUM);
    if(password_verify($password,$row[2])){
        session_unset();
        $_SESSION['id'] = $row[3];
        $_SESSION['verified'] = $row[4];
        $_SESSION['invalid_email'] = $row[7];
        if($row[4]){
            $_SESSION['email'] = $row[0];
            $_SESSION['username'] = $row[1];
            $_SESSION['admin'] = $row[5];
            $_SESSION['subscription_policy'] = $row[6];
            $message = 'Successfully logged in!';
            displayPopupNotification($message, '/');
        } else {
            $_SESSION['notVerifiedEmail'] = $row[0];
            $_SESSION['notVerifiedUsername'] = $row[1];
            header('location: /account/verify/email.php');
        }
        
    } else {
        $message = "Wrong email or password. Please try again.";
        displayPopupNotification($message, '/login/');
    }