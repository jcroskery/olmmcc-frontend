<?php
include_once '../helpers/wrapper.php';
wrapperBegin('Sign Up', 'signup');
echo <<<HTML

    <form method="post" action="signup.php" class="form">
            <h1>Sign Up</h1>
            <pre class="pre">
Email: <input type="email" name="email" class="anInput" autofocus="true" autocomplete="on" placeholder="Your email" required="required"/>
Username: <input type="text" name="username" class="anInput" autofocus="true" autocomplete="on" placeholder="Your new username" required="required"/>
Password: <input type="password" class="anInput" name="password" autocomplete="off" placeholder="Your new password"required="required"/>
Repeat password: <input type="password" class="anInput" name="password2" autocomplete="off" placeholder="Repeat your password"required="required"/>
</pre>
<pre class="pre-center">
Please look over the terms of the <a target="_blank" class='a' href="/license">license</a>: I accept<input type="checkbox" required="true"/>
<input type="submit" name="accept" value="Sign up!" class="submit"/>
</pre>
        </form>
HTML;
wrapperEnd();
