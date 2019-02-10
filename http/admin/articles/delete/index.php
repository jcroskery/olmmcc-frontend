<?php
include_once '/srv/http/helpers/wrapper.php';
require_once '/srv/http/helpers/displayMessage.php';
if ($_SESSION['admin']) {
    $path = '/srv/http/articles/';
    if(isset($_POST['songs'])){
        $path .= ('songs/' . $_POST['songs']);
    } else {
        $path .= ('main/' . $_POST['main']);
    }
    if(unlink($path)){
        $message = "Sucesfully deleted " . $path . ".";
        displayPopupNotification($message, '/admin/articles');
    } else {
        $message = "Error, please try again.";
        displayPopupNotification($message, '/admin/articles');
    }
} else {
    notLoggedIn();
}