<?php
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('Login', 'login');
echo <<<HTML
<form method="post" action="login.php" class='mainForm'>
        <h1>Login</h1>

        <div class='rightDiv'>
                <label for='email'>Email: </label>
                <input type="email" id = 'email' name="email" autofocus="true" autocomplete="on" placeholder="Your email" required="required"/>

                <br>

                <label for='password'>Password: </label>
                <input type="password" id='password' name="password" autocomplete="off" placeholder="Your password"required="required"/>
        </div>
        <br>

        <input type="submit" value="Login" class="submit" />

        <br>

        <a class='a' href='/account/password/'>Forgot your password?</a>
</form>
HTML;
wrapperEnd();