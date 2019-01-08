<?php
include_once '/srv/http/helpers/wrapper.php';
if (loggedIn() || $_SESSION['invalid_email'] = 1) {
    wrapperBegin('Change Email', '');
    $email = $_SESSION['email'] == '' ? $_SESSION['notVerifiedEmail'] : $_SESSION['email'];
    echo <<<HTML
<form method='post' action="/account/email/confirm.php" class='form'>
    <h1>Change Your Email</h1>
    <pre class='pre'>
    Enter your new email: <input name='newEmail' type='email' class='anInput' autofocus='true' autocomplete='on' placeholder='Your current email is $email' required='required'/></pre>
    <pre class='pre-center'>
    <input class='submit' type="submit" value="Change Email"/></pre>
</form>
HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}
