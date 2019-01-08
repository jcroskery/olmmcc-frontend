<?php
include_once '/srv/http/helpers/wrapper.php';
if(wrapperBegin('Change Username', '', true)){
echo <<<HTML
<form method='post' action="/account/changeUsername.php" class='form'>
    <h1>Change Your Username</h1>
    <pre class='pre'>
    Enter your new username: <input name='newUsername' type='text' class='anInput' autofocus='true' autocomplete='on' placeholder='Your new username' required='required'/></pre>
    <pre class='pre-center'>
    <input class='submit' type="submit" value="Change Username"/></pre>
</form>
HTML;
wrapperEnd();
} else {
    notLoggedIn();
}