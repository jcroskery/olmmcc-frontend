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
function displayPopupNotification($message, $link){
    setcookie('Notification', $message, time() + 5, '/', 'www.olmmcc.tk', 'true', false);
    header('location: ' . $link);
}