<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/accountFunctions.php';
refreshAccount();
if(wrapperBegin('Your Account', 'account', true)) {
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$subscriptionDefault = [];
$subscriptionDefault[$_SESSION['subscription_policy']] = 'selected="selected"';
echo <<<HTML
        <div id="main-text" style='text-align: center;'>
            <H1>Your Account</H1>
            <div class='row'>
                <div class='leftColumn'>
                    <p>Email: $email</p>
                    <p>Username: $username</p>
                </div>
                <div class='rightColumn'>
                    <p><a class='aBlue' href='/account/email/'>Change Account Email</a></p>
                    <p><a class='aBlue' href='/account/username/'>Change Account Username</a></p>
                </div>
            </div>
            <form action="/account/subscription/" method='post'>
                <span class='pre'>Subscription policy: </span>
                <select name='subscriptionPolicy'>
                    <option value='0' $subscriptionDefault[0]>No emails</option>
                    <option value='1' $subscriptionDefault[1]>Emails</option>
                    <option value='2' $subscriptionDefault[2]>Emails and reminders</option>
                </select>&ensp;&ensp;
                <input class='submit' type="submit" value="Set Subscription Policy"/>
            </form>
            <br>
            <span class='smallSpan'><a class='aBlue' href='/account/password/'>Change Password</a> or <a class='aBlue' href='/account/delete/'>Delete Account</a></span>
        </div>

HTML;
wrapperEnd();
} else {
    notLoggedIn();
}
