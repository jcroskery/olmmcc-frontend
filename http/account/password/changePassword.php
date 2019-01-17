<?php
include_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/logincreds.php';
require_once '/srv/http/helpers/sessionStart.php';
if(htmlspecialchars($_SESSION['passwordChangeRequest']) == $_GET['passwordChangeRequest']){
    $connection = new mysqli($hn, $un, $pw, $db);
    if($connection->connect_error) die("Connection error");
    $stmt = $connection->prepare("update userlist set password=? where id=?");
    $stmt->bind_param("ss", $_SESSION['newHashedPassword'], $_SESSION['newPasswordId']);
    $stmt->execute();
    session_unset();
    $message = "Your password was successfully changed. Please login to your account.";
    displayPopupNotification($message, '/login/');
} else {
    $message = "An error occurred. Please resend the email or contact the webmaster.";
    displayPopupNotification($message, '/login/');
}