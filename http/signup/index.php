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
include_once '../helpers/wrapper.php';
wrapperBegin('Sign Up', 'signup');
echo <<<HTML

<form method="post" action="signup.php" class='mainForm'>
        <h1>Sign Up</h1>

        <div class='rightDiv'>
                <label for='email'>Email: </label>
                <input type="email" id='email' name="email" autofocus="true" autocomplete="on" placeholder="Your email" required="required"/>

                <br>


                <label for='username'>Username: </label>
                <input type="text" id='username' name="username" autofocus="true" autocomplete="on" placeholder="Your new username" required="required"/>

                <br>


                <label for='password1'>Password: </label>
                <input type="password" id='password1' name="password1" autocomplete="off" placeholder="Your new password"required="required"/>

                <br>


                <label for='password2'>Repeat password: </label>
                <input type="password" id='password2' name="password2" autocomplete="off" placeholder="Repeat your password"required="required"/>
        </div>
        <br>
        <span>Please look over the terms of the <a target="_blank" class='a' href="/license">license</a>: I accept</span>
        <input type="checkbox" required="true"/>

        <br>
        <br>

        <input type="submit" name="accept" value="Sign up!" class="submit"/>
</form>
HTML;
wrapperEnd();
