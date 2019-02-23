<?php
include_once '/srv/http/helpers/wrapper.php';
if($_SESSION['admin']){
    wrapperBegin('Administrator Settings');

    echo <<<HTML
    <div id="main-text">
        <h1>Administrator Settings</h1>
        <h2><a href='/admin/accounts' class='a'>Accounts</a></h2>
        <p>Create, modify, and delete accounts.</p>
        <h2><a href='/admin/articles' class='a'>Articles</a></h2>
        <p>Create and edit articles.</p>
        <h2><a href='/admin/calendar' class='a'>Calendar</a></h2>
        <p>Create, modify, and delete calendar events.</p>
        <h2><a href='/admin/css' class='a'>CSS</a></h2>
        <p>Change the style of pages with Cascading Style Sheets (CSS).</p>
        <h2><a href='/admin/email' class='a'>Emails</a></h2>
        <p>Send emails at a certain time, useful for special announcements.</p>
        <h2><a href='/admin/songs' class='a'>Songs</a></h2>
        <p>Add, view, modify, and delete songs.</p>
    </div>
HTML;

    wrapperEnd();
} else {
    notLoggedIn();
}

