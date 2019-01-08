<?php
session_start();
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('Login', 'login');
echo <<<HTML
<form method="post" action="login.php" class="form">
    <h1>Login</h1>
            <pre class="pre">
Email: <input type="email" name="email" class="anInput" autofocus="true" autocomplete="on" placeholder="Your email" required="required"/>
Password: <input type="password" class="anInput" name="password" autocomplete="off" placeholder="Your password"required="required"/>
</pre><input type="submit" value="Login" class="submit" />
<pre>
</pre>
<a class='a' href='/account/password/'>Forgot your password?</a>
        </form>
        
HTML;
wrapperEnd();