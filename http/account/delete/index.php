<?php
include_once '/srv/http/helpers/displayMessage.php';
require_once '/srv/http/helpers/wrapper.php';
require_once '/srv/http/helpers/sessionStart.php';
require_once '/srv/http/helpers/sendEmail.php';
if(loggedIn()){
    $deleteCode;
    if ($_SESSION['deleteCode'] == '') {
        $deleteCode = hash('sha512', $_SESSION['email'] . bin2hex(random_bytes(20)));
        $_SESSION['deleteCode'] = $deleteCode;
    } else {
        $deleteCode = $_SESSION['deleteCode'];
    }
    $subject = "Delete OLMMCC account";
    $link = "http://" . $_SERVER['HTTP_HOST'] . "/account/delete/deleteAccount.php?deleteCode=3D" . $deleteCode;
    $message = "<p>Hi,</p>Click this link to delete your account. Caution! This action is permanent and irreversible.\r\n" . $link;
    sendEmail($subject, $message, $_SESSION['username'], $_SESSION['email']);
    $message = 'An email containing the link to delete your account has been sent to ' . $_SESSION['email'] . '. Please check your email, including the spam folder, for the link. Please note that it may take a few minutes for the email to be sent.';
    displayMessage($message, '/account/delete/', 'Confirm deletion', 'Resend confirmation email');
} else {
    notLoggedIn();
}