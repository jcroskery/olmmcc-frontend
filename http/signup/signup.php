<?php
require_once '/srv/http/helpers/validationFunctions.php';
require_once '/srv/http/helpers/accountFunctions.php';
require_once '/srv/http/helpers/sessionStart.php';
require_once '/srv/http/helpers/displayMessage.php';
$email = strtolower(sanitizeString($_POST['email']));
$username = sanitizeString($_POST['username']);
$password1 = sanitizeString($_POST['password1']);
$password2 = sanitizeString($_POST['password2']);
$emailValid = checkEmail($email);
$usernameValid = checkUsername($username);
$passwordValid = checkPassword($password1);
$passwordsMatch = checkPasswordsMatch($password1, $password2);
if ($passwordsMatch !== true) {
    return displayPopupNotification($passwordsMatch, '/signup/');
}
if ($passwordValid !== true) {
    return displayPopupNotification($passwordValid, '/signup/');
}
if ($emailValid!==true) {
    return displayPopupNotification($emailValid, '/signup/');
}
if ($usernameValid !== true) {
    return displayPopupNotification($usernameValid, '/signup/');
}
createAccount($email, $username, password_hash($password1, PASSWORD_DEFAULT));
session_unset();
displayPopupNotification("Your account was sucessfully created! Please login to your new account.", '/login/');