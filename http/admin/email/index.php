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
    wrapperBegin('Compose Email', '');
    echo <<<HTML
    <div id='main-text'>
        <H1>Compose Email</H1>
        <form action='email.php' method='post'  style='text-align: center;'>
            <span class='pre'>From: </span>
            <select name='subscriptionPolicy'>
                <option value='justus@olmmcc.tk' selected='selected'>justus@olmmcc.tk</option>
                <option value='justus.croskery@gmail.com'>justus.croskery@gmail.com</option>
            </select>
            <br>
<span class='pre'>To: </span>
<select name='emailAddresses'>
    <option value='Choir' selected='selected'>Choir</option>
    $allAccounts
</select>
<input type='button' value='Add' onclick='addEmail'/>
<br>
<span class='pre'>Body: </span>
<br>
<textarea class='largeTextarea' placeholder='Email body here' name="body"></textarea>
<br>
<input class='submit' type="submit" value="Send Email"/>
        </form>
    </div>
HTML;
    wrapperEnd("<script src='/js/emailAdmin.js/>");
} else {
    notLoggedIn();
}