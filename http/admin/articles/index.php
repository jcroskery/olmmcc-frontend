<?php
include_once '/srv/http/helpers/wrapper.php';
if($_SESSION['admin']){
    wrapperBegin('Articles');
    
    echo <<<HTML
    <div id="main-text">
        <h1>Song Articles</h1>

    </div>
HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}