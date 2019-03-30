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
wrapperBegin('Login', 'login');
echo <<<HTML
<form method="post" action="login.php" class='mainForm'>
        <h1>Login</h1>
        <div class='centerDiv'>
                <label for='email'>Email: </label>
                <input type="email" id = 'email' name="email" autofocus="true" autocomplete="on" placeholder="Your email" required="required"/>
                <br>
                <label for='password'>Password: </label>
                <input type="password" id='password' name="password" autocomplete="off" placeholder="Your password"required="required"/>
        </div>
        <br>
        <input type="submit" value="Login" class="submit" />
        <br>
        <span class='smallSpan'><a href='/account/password/'>Forgot your password?</a></span>
</form>
HTML;
wrapperEnd();