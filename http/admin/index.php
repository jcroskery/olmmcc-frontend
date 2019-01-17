<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/sessionStart.php';
if($_SESSION['admin']){
    wrapperBegin('Administrator Settings', '');

    echo <<<HTML
    <div id="main-text" style='text-align: center;'>
        <h1>Administrator Settings</h1>
        <h3><a href='/admin/calendar' class='a'>Calendar</a></h3>
        <p class='h3p'>Create, modify, and delete calendar events.</p>
        <h3><a href='/admin/accounts' class='a'>Accounts</a></h3>
        <p class='h3p'>Create, modify, and delete accounts.</p>
        <h3><a href='/admin/email' class='a'>Emails</a></h3>
        <p class='h3p'>Send emails at a certain time, useful for special announcements.</p>
        <h3><a href='/admin/songs' class='a'>Song Articles</a></h3>
        <p class='h3p'>Specify songs for the upcoming Children's Masses.</p>
        <h3><a href='/admin/pages' class='a'>Pages</a></h3>
        <p class='h3p'>Edit certain pages' content.</p>
        <h3><a href='/admin/css' class='a'>CSS</a></h3>
        <p class='h3p'>Change the style of pages with Cascading Style Sheets (CSS)</p>
    </div>
HTML;

    wrapperEnd();
} else {
    notLoggedIn();
}

