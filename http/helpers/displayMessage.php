<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/sessionStart.php';
function displayMessage($errortext, $link, $error = 'true', $buttons = 'OK'){
    $headerError;
    if($error == 'true'){
        $headerError = "Error!";
    } else if($error == false){
        $headerError = "Success!";
    } else {
        $headerError = $error;
    }
    wrapperBegin($headerError, '');
    
    echo <<<HTML
    <form method="post" action="$link" class="mainForm">
        <h1>$headerError</h1>
        <p>$errortext</p>
HTML;
    if($buttons!="none"){
        echo '<input type="submit" value="' . $buttons . '" class="submit" />';
    }
    
    echo '</form>';
    wrapperEnd();
}
function displayPopupNotification($errortext, $link){
    $_SESSION['popupNotification'] = '<script>' . str_replace('$errortext', $errortext, file_get_contents('/srv/http/js/notification.js')) . '</script>';
    header('location: ' . $link);
}