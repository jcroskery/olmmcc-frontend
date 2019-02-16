<?php
include_once '../helpers/wrapper.php';
include_once '/srv/http/helpers/displayMessage.php';
if(loggedIn()){
    session_unset();
    $message = 'Successfully logged out.';
    displayPopupNotification($message, '/');
} else {
    notLoggedIn();
}