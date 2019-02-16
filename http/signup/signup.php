<?php
require_once '/srv/http/helpers/accountFunctions.php';
require_once '/srv/http/helpers/sessionStart.php';
require_once '/srv/http/helpers/displayMessage.php';
$email = strtolower(sanitizeString($_POST['email']));
$username = sanitizeString($_POST['username']);
$password1 = sanitizeString($_POST['password']);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$password2 = sanitizeString($_POST['password2']);
function checkEmail()
{
    global $email;
    if (strlen($email) <= 64) {
        if (!getAccountFromEmail($email)) {
            return true;
        }
        $message = 'Sorry, your email address has already been registered. Please use a different address or log in with your account.';
    } else {
        $message = 'Sorry, your email is too long. Please use a different email address.';
    }
    displayPopupNotification($message, '/signup/');
    return false;
}
function checkUsername()
{
    global $username;
    if (strlen($username) <= 16 && strlen($username) >= 4 && !preg_match('/[^A-Za-z0-9]/', $username)) {
        if (!getAccountFromEmail($email)) {
            return true;
        }
        $message = "Sorry, this username has already been taken. Please select another.";
    } else {
        $message = 'Sorry, your username is invalid. Please use between 4 and 16 characters and only letters and numbers for your username.';
    }
    displayPopupNotification($message, '/signup/');
    return false;
}
function checkPassword()
{
    global $password1, $password2;
    if (strlen($password1) <= 128 && strlen($password1) >= 8) {
        if ($password1 == $password2) {return true;}
        $message = "Sorry, your passwords do not match. Please try again.";
    } else {
        $message = 'Please use a password between 8 and 128 characters long.';
    }
    displayPopupNotification($message, '/signup/');
    return false;
}
if (checkEmail() && checkUsername() && checkPassword()) {
    createAccount($email, $username, $hashedPassword);
    session_unset();
    $message = "Your account was sucessfully created! Please login to your new account.";
    displayPopupNotification($message, '/login/', false);
}
