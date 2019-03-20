<?php
/*
Copyright (C) 2019  Justus Croskery
To contact me, email me at justus@olmmcc.tk.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/.
*/
include_once '/srv/http/helpers/wrapper.php';
if($_SESSION['admin']){
    wrapperBegin('Administrator Settings');

    echo <<<HTML
    <div id="main-text">
        <h1>Administrator Settings</h1>
        <h2><a href='/admin/accounts'>Accounts</a></h2>
        <p>Create, modify, and delete accounts.</p>
        <h2><a href='/admin/articles'>Articles</a></h2>
        <p>Create and edit song articles.</p>
        <h2><a href='/admin/calendar'>Calendar</a></h2>
        <p>Create, modify, and delete calendar events.</p>
        <h2><a href='/admin/css'>CSS</a></h2>
        <p>Change the style of pages with Cascading Style Sheets (CSS).</p>
        <h2><a href='/admin/email'>Emails</a></h2>
        <p>Send emails at a certain time, useful for special announcements.</p>
        <h2><a href='/admin/pages'>Pages</a></h2>
        <p>Edit the content of certain pages.</p>
        <h2><a href='/admin/songs'>Songs</a></h2>
        <p>Add, view, modify, and delete songs.</p>
    </div>
HTML;

    wrapperEnd();
} else {
    notLoggedIn();
}

