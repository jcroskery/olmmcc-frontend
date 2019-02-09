<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/helpers/songArticle.php';
include_once '/srv/http/helpers/mainArticle.php';
if ($_SESSION['admin']) {
    $path = '/srv/http/articles/';
    if(isset($_POST['Song'])){
        $path .= ('songs/' . $_POST['Song']);
    } else {
        $path .= ('main/' . $_POST['Main']);
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