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
        <div id="main-text" class='centerDiv'>
            <H1>Your Account</H1>
            <div class='row'>
                <div class='leftColumn'>
                    <p>Email: $email</p>
                    <p>Username: $username</p>
                </div>
                <div class='rightColumn'>
                    <button formaction='/account/email/'>Change Account Email</button>
                    <p><a href='/account/username/'>Change Account Username</a></p>
                </div>
            </div>
            <br>
            <form action="/account/subscription/" method='post'>
                <span>Subscription policy: </span>
                <select name='subscriptionPolicy'>
                    <option value='0' $subscriptionDefault[0]>No emails</option>
                    <option value='1' $subscriptionDefault[1]>Emails</option>
                    <option value='2' $subscriptionDefault[2]>Emails and reminders</option>
                </select>
                <br>
                <br>
                <input type="submit" value="Set Subscription Policy"/>
            </form>
            <br>
            <span class='smallSpan'><a href='/account/password/'>Change Password</a> or <a href='/account/delete/'>Delete Account</a></span>
        </div>

HTML;
wrapperEnd();
} else {
    notLoggedIn();
}
