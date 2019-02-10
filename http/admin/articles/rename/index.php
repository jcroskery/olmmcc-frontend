<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
function changeArticleName($oldfile, $newfile)
{
    rename($oldfile, $newfile);
    $message = "Sucessfully changed " . $oldfile . " to " . $newfile;
    displayPopupNotification($message, '/admin/articles');
}
if ($_SESSION['admin']) {
    $name = sanitizeString($_POST['name']);
    if (isset($_POST['songs'])) {
        $filepath = '/srv/http/articles/songs/';
        changeArticleName($filepath . $_POST['songs'], $filepath . $name);
    } else {
        $filepath = '/srv/http/articles/main/';
        changeArticleName($filepath . $_POST['main'], $filepath . $name);
    }
    
} else {
    notLoggedIn();
}
