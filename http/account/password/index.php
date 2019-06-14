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
wrapperBegin('Change Password');
echo <<<HTML
<form method="post" action="/account/password/confirm.php" class='mainForm'>
    <h1>Forgot your password?</h1>
    <div class='centerDiv'>
        <label for='email'>Email: </label>
        <input id='email' type="email" name="email" autofocus autocomplete="on" placeholder="Your email" required="required" value='$email'/>
        <br>
        <label for='password1'>New Password: </label>
        <input id='password1' type="password" name="password" autocomplete="off" placeholder="Your password"required="required"/>
        <br>
        <label for='password2'>Repeat New Password: </label>
        <input id='password2' type="password" name="password1" autocomplete="off" placeholder="Repeat your password"required="required"/>
    </div>
    <br>
    <input type="submit" value="Change Password" class="submit" />
</form>
HTML;
wrapperEnd();