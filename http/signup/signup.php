<?php
require_once '/srv/http/helpers/accountFunctions.php';
require_once '/srv/http/helpers/sessionStart.php';
require_once '/srv/http/helpers/displayMessage.php';
$email = strtolower(sanitizeString($_POST['email']));
$username = sanitizeString($_POST['username']);
$password1 = sanitizeString($_POST['password']);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$password2 = sanitizeString($_POST['password2']);
function passwordMatch()
{
    global $password1, $password2;
    if ($password1 == $password2) {return true;}
    $message = "Sorry, your passwords do not match. Please try again.";
    displayPopupNotification($message, '/signup/');
    return false;
}
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
    if (strlen($username) <= 16 && preg_match('/[A-Za-z0-9]/', $username)) {
        if (!getAccountFromEmail($email)) {
            return true;
        }
        $message = "Sorry, this username has already been taken. Please select another.";
    } else {
        $message = 'Sorry, your username is invalid. Please select a different username.';
    }
    displayPopupNotification($message, '/signup/');
    return false;
}
function checkPassword()
{
    global $password;
    if (strlen($password) <= 128 && strlen($password) >= 8) {return true;}
    $message = 'Please use a password between 8 and 128 characters long.';
    displayPopupNotification($message, '/signup/');
    return false;
}
if (passwordMatch() && checkEmail() && checkUsername() && checkPassword()) {
    createAccount($email, $username, $hashedPassword);
    session_unset();
    $message = "Congratulations! Your account was sucessfully created. Please login with your email and password.";
    displayPopupNotification($message, '/login/', false);
}
