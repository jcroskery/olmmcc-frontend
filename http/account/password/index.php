<?php
include_once '/srv/http/helpers/wrapper.php';
wrapperBegin('Change Password', '');
$email = $_SESSION['email'];
if($email == ''){
    $emailInput = <<<HTML
    <label for='email'>Email: </label>
    <input id='email' type="email" name="email" autofocus autocomplete="on" placeholder="Your email" required="required" value='$email'/>
    <br>
HTML;
}
$passwordAutoFocus = $email != '' ? 'autofocus="true"' : '';
echo <<<HTML
<form method="post" action="/account/password/confirm.php" class='mainForm'>
    <h1>Change your password: </h1>
    <div class='rightDiv'>
        $emailInput
        <label for='password1'>New Password: </label>
        <input id='password1' type="password" name="password" $passwordAutoFocus autocomplete="off" placeholder="Your password"required="required"/>
        <br>
        <label for='password2'>Repeat New Password: </label>
        <input id='password2' type="password" name="password1" autocomplete="off" placeholder="Repeat your password"required="required"/>
    </div>
    <br>
    <input type="submit" value="Change Password" class="submit" />
</form>
HTML;
wrapperEnd();