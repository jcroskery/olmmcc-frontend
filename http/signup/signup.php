<?php
require_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) {
    die("Connection error");
}

$email = strtolower(sanitizeString($_POST['email']));
$username = sanitizeString($_POST['username']);
$password = sanitizeString($_POST['password']);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$passwordCheck = sanitizeString($_POST['password2']);
if ($password == $passwordCheck) {
    if (strlen($email) > 32) {
        $message = 'Sorry, your email is too long. Please use a different email address.';
        displayPopupNotification($message, '/signup/');
    } else {
        if (strlen($username) > 16 || preg_match('/[^A-Za-z0-9]/', $username)) {
            $message = 'Sorry, your username is invalid. Please select a different username.';
            displayPopupNotification($message, '/signup/');
        } else {
            if (strlen($password) > 32) {
                $message = 'Sorry, your password is too long. Please shorten it.';
                displayPopupNotification($message, '/signup/');
            } else {
                $stmt = $connection->prepare("SELECT * FROM userlist WHERE email=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();

                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $message = "Sorry, your email address has already been registered. Please log in to your account instead of creating a new one.";
                    displayPopupNotification($message, '/login/');
                } else {
                    $stmt = $connection->prepare("SELECT * FROM userlist WHERE username=?");
                    $stmt->bind_param("s", $username);
                    $stmt->execute();

                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $message = "Sorry, this username has already been taken. Please select another.";
                        displayPopupNotification($message, '/signup/');
                    } else {
                        $stmt = $connection->prepare("INSERT INTO userlist (email, username, password, verified, admin, subscription_policy, invalid_email) VALUES (?, ?, ?, 0, 0, 1, 0)");
                        $stmt->bind_param("sss", $email, $username, $hashedPassword);
                        $stmt->execute();
                        session_unset();
                        $message = "Congratulations! Your account was sucessfully created. Please login with your email and password.";
                        displayPopupNotification($message, '/login/', false);
                    }

                }
            }

        }

    }

} else {
    $message = "Sorry, your passwords do not match. Please try again.";
    displayPopupNotification($message, '/signup/');
}
