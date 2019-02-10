<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/logincreds.php';
require_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/helpers/songArticle.php';
include_once '/srv/http/helpers/mainArticle.php';
function changeArticleName($oldfile, $newfile){
    rename($oldfile, $newfile);
    $message = "Sucessfully changed " . $oldfile ." to " . $newfile;
    displayPopupNotification($message, '/admin/articles');
}
if ($_SESSION['admin']) {
    if(isset($_POST['Song'])){
        if($_POST['Song']=='edit'){
            edit();
        } else {
            $filepath = '/srv/http/articles/songs/';
            changeArticleName($filepath . $_POST['Song'], $filepath . $_POST['name']);
        }
    } else {
        if ($_POST['Main'] == 'edit') {
            edit();
        } else {
            $filepath = '/srv/http/articles/main/';
            changeArticleName($filepath . $_POST['Main'], $filepath . $_POST['name']);
        }

    }
    $name = sanitizeString($_POST['name']);
} else {
    notLoggedIn();
}