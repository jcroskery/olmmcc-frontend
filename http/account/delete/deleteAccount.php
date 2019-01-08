<?php
session_start();
include_once '/srv/http/helpers/accountFunctions.php';
require_once '/srv/http/helpers/displayMessage.php';
if(htmlspecialchars($_SESSION['deleteCode']) == $_GET['deleteCode']){
    deleteAccount($_SESSION['id']);
    session_unset();
    $message = "Your account has been successfully deleted. Sorry to see you go!";
    displayPopupNotification($message, '/');
} else {
    $message = "An error occurred. Please try to login again or contact the webmaster.";
    displayPopupNotification($message, '/login/');
}
