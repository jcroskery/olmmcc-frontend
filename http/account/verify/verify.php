<?php
session_start();
require_once '/srv/http/helpers/accountFunctions.php';
require_once '/srv/http/helpers/displayMessage.php';
if(htmlspecialchars($_SESSION['verificationid']) == $_GET['verification']){
    verifyAccount($_SESSION['id']);
    $message = "Your account was successfully verified! Please login to your newly verified account.";
    displayPopupNotification($message, '/login/');
} else {
    $message = "An error occurred. Please try to login again or contact the webmaster.";
    displayPopupNotification($message, '/login/');
}
