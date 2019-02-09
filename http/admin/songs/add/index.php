<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/songFunctions.php';
require_once '/srv/http/helpers/displayMessage.php';
if($_SESSION['admin']) {
    $name = sanitizeString($_POST['name']);
    $link = sanitizeString($_POST['link']);
    $notes = sanitizeString($_POST['notes']);
    addSong($name, $link, $notes);
    $message = "Sucessfully added ". $name . ".";
    displayPopupNotification($message, '/admin/songs');
} else {
    notLoggedIn();
}