<?php
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('Change Password', '');
$email = $_SESSION['email'];
$emailAutoFocus = $email == '' ? 'autofocus="true"' : '';
$passwordAutoFocus = $email != '' ? 'autofocus="true"' : '';
echo <<<HTML
<form method="post" action="/account/password/confirm.php" class='mainForm'>
    <h1>Change your password: </h1>
    <pre class="pre">
    Email: <input type="email" name="email" class="anInput" $emailAutoFocus autocomplete="on" placeholder="Your email" required="required" value='$email'/>
    New Password: <input type="password" class="anInput" name="password" $passwordAutoFocus autocomplete="off" placeholder="Your password"required="required"/>
    Repeat New Password: <input type="password" class="anInput" name="password1" autocomplete="off" placeholder="Repeat your password"required="required"/>
    </pre>
    <input type="submit" value="Change Password" class="submit" />
</form>
HTML;
wrapperEnd();
