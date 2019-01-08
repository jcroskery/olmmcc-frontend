<?php
session_start();
require_once '/srv/http/helpers/accountFunctions.php';
require_once '/srv/http/helpers/displayMessage.php';
if(htmlspecialchars($_SESSION['changeEmailVerificationId']) == $_GET['changeEmailVerificationId']){
    changeEmail($_SESSION['newEmail'], $_SESSION['id']);
    setNotInvalidEmail($_SESSION['id']);
    unVerifyAccount($_SESSION['id']);
    session_unset();
    $message = "Your email was successfully changed. Please login to your account and verify it.";
    displayPopupNotification($message, '/login/');
} else {
    $message = "An error occurred. Please try to login again or contact the webmaster.";
    displayPopupNotification($message, '/login/');
}