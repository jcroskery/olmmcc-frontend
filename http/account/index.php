<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/accountFunctions.php';
refreshAccount();
if(wrapperBegin('Your Account', 'account', true)) {
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$subscriptionDefault = [];
$subscriptionDefault[$_SESSION['subscription_policy']] = 'selected="selected"';
$accountLevel; 
$disabled='';
if($_SESSION['admin'] == 1){
    $accountLevel = 'Admin';
} else {
    $accountLevel = 'Member';
    $disabled = 'disabled="disabled"';
}
echo <<<HTML
        <div id="main-text" class='centerDiv'>
            <H1>Your Account</H1>
            <span class='leftFloat'>Email: $email</span>
            <form action='/account/email'>
                <button class='rightFloat' type='submit'>Change Account Email</button>
            </form>
            <br><br><br>
            <span class='leftFloat'>Username: $username</span>
            <form action='/account/username'>
                <button class='rightFloat' type='submit'>Change Account Username</button>
            </form>
            <br><br><br>
            <span class='leftFloat'>Subscription policy: </span>
            <form action="/account/subscription/" method='post'>
                <select class='rightFloat' name='subscriptionPolicy' onchange="this.form.submit()">
                    <option value='0' $subscriptionDefault[0]>No emails</option>
                    <option value='1' $subscriptionDefault[1]>Emails</option>
                    <option value='2' $subscriptionDefault[2]>Emails and reminders</option>
                </select>
            </form>
            <br>
            <br>
            <br>
            <span class='leftFloat'>Account type: $accountLevel</span>
            <form action='/admin/'>
                <button $disabled class='rightFloat' type='submit'>Go to Administrator settings</button>
            </form>
            <br>
            <br>
            <br>
            <span class='smallSpan'><a href='/account/password/'>Change Password</a> or <a href='/account/delete/'>Delete Account</a></span>
        </div>

HTML;
wrapperEnd();
} else {
    notLoggedIn();
}
