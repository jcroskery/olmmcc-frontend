<?php
include_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/http/helpers/sessionStart.php';
require_once '/srv/http/helpers/accountFunctions.php';
header("Refresh: 15;url='/account/verify/'");
if ($_SESSION['id'] != '') {
    if (!$_SESSION['verified']) {
        $files = scandir('/srv/http/json/incoming/');
        foreach ($files as $file) {
            if ($file == 'Email does not exist' . $_SESSION['notVerifiedEmail'] . '.json') {
                $stmt = $connection->prepare("update userlist set invalid_email=1 where id=?");
    
                $stmt->bind_param("s", $_SESSION['id']);
                $stmt->execute();
                unlink('/srv/http/json/incoming/' . $file);
                $_SESSION['invalid_email'] = '1';
            }
        }
        if($_SESSION['invalid_email'] == 1){
            $message = 'Your email address is invalid. Please enter a new one and try again.';
            displayPopupNotification($message, '/account/email');
        } else {
            $message = 'Your account has not been verified yet. An email containing the verification link has been sent to ' . $_SESSION['notVerifiedEmail'] . '. Please note that it may take a few minutes for the email to be sent.';
            displayMessage($message, '/account/verify/email.php', 'Verify your account', 'Resend Verification Email');
        }
    } else {
        $message = 'Your account has already been verified.';
        displayPopupNotification($message, '/');
    }

} else {
    $message = 'You are not logged in. Please log in.';
    displayPopupNotification($message, '/login/');
}
