<?php
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('403/404 Error', '');
echo <<<HTML
<div id="main-text">
    <H1>A 403/404 error occurred! Please try again.</H1>
    <p>The error was: The request contains bad syntax or cannot be fulfilled.</p>
</div>
HTML;
wrapperEnd();
