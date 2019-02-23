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
if(wrapperBegin('Change Username', '', true)){
echo <<<HTML
<form method='post' action="/account/changeUsername.php" class='mainForm'>
    <h1>Change Your Username</h1>
    <pre class='pre'>
    Enter your new username: <input name='newUsername' type='text' autofocus='true' autocomplete='on' placeholder='Your new username' required='required'/></pre>
    <pre class='pre-center'>
    <input class='submit' type="submit" value="Change Username"/></pre>
</form>
HTML;
wrapperEnd();
} else {
    notLoggedIn();
}