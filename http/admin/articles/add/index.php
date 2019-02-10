<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/helpers/songArticle.php';
include_once '/srv/http/helpers/mainArticle.php';
if ($_SESSION['admin']) {
    $name = sanitizeString($_POST['name']);
    $type = sanitizeString($_POST['type']);
    $path = '/srv/http/articles/' . ($type=='songs' ? 'songs/' : 'main/');
    $fullpath = $path . $name . '.json';
    if(file_exists($fullpath)){
        $message = "This article already exists, sorry!";
        displayPopupNotification($message, '/admin/articles');
    } else {
        if($type=='songs'){
            createSongArticle($fullpath);
        } else {
            createMainArticle($fullpath);
        }
        $message = "Sucessfully added " . $name . ".";
        displayPopupNotification($message, '/admin/articles');
    }
} else {
    notLoggedIn();
}
