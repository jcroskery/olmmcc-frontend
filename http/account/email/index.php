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
if (loggedIn() || $_SESSION['invalid_email'] = 1) {
    wrapperBegin('Change Email', '');
    $email = $_SESSION['email'] == '' ? $_SESSION['notVerifiedEmail'] : $_SESSION['email'];
    echo <<<HTML
<form method='post' action="/account/email/confirm.php" class='mainForm'>
    <h1>Change Your Email</h1>
    <label for='newEmail'>Enter your new email: </label>
    <input name='newEmail' id='newEmail' type='email' autofocus='true' autocomplete='on' placeholder='Your current email is $email' required='required'/>
    <br>
    <input class='submit' type="submit" value="Change Email"/>
</form>
HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}
