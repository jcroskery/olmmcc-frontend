<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/songFunctions.php';
require_once '/srv/http/helpers/displayMessage.php';
if($_SESSION['admin']) {
    foreach($_POST as $id => $var){
        deleteSong($id);
        $message = "Deletion successful.";
        displayPopupNotification($message, '/admin/songs');
    }
} else {
    notLoggedIn();
}