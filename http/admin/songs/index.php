<?php
include_once '/srv/http/helpers/songFunctions.php';
include_once '/srv/http/helpers/wrapper.php';
if($_SESSION['admin']){
    wrapperBegin('Song Database');

    $songs = getSongs();

    echo <<<HTML
    <div id="main-text">
        <h1>Song Database</h1>

    </div>
    HTML;
    wrapperEnd();
}