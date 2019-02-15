<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/songFunctions.php';
require_once '/srv/http/helpers/displayMessage.php';
if($_SESSION['admin']) { 
    $id = sanitizeString($_POST['id']);
    changeName(sanitizeString($_POST['name']), $id);
    changeLink(sanitizeString($_POST['link']), $id);
    changeNotes(sanitizeString($_POST['notes']), $id);
    $message = 'Sucessfully updated song.';
    displayPopupNotification($message, '/admin/songs');
} else {
    notLoggedIn();
}