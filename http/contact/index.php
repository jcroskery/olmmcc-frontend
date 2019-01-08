<?php
include_once '../helpers/wrapper.php';
wrapperBegin('Contact', 'contact');
echo <<<HTML
<div id="main-text">
    <h1>Contact me</h1>
    <p>If you have any questions about the choir or this website, email <a class='aBlue' href="mailto:justus@olmmcc.tk">justus@olmmcc.tk</a>.</p>
</div>

HTML;
wrapperEnd();