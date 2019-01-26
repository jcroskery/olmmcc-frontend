<?php
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
