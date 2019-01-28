<?php
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/helpers/accountFunctions.php';
refreshAccount();
if(wrapperBegin('Your Account', 'account', true)) {
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$subscriptionName = getSubscriptionPolicyName($_SESSION['subscription_policy']);
$subscriptionOptions = '<option disabled selected>' . $subscriptionName . '</option>';
for($i = 0; $i < 3; $i++){
    if($i != $_SESSION['subscription_policy']) {
        $subscriptionOptions .= "<option value='$i'>" . getSubscriptionPolicyName($i) . "</option>";
    }
}
$accountLevel = $_SESSION['admin'] ? 'Admin' : 'Member'; 
$disabled = $_SESSION['admin'] ? '' : "disabled='disabled'";
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
            <span class='leftFloat'>Subscription policy: $subscriptionName</span>
            <form action="/account/subscription/" method='post'>
                <select class='rightFloat' name='subscriptionPolicy' onchange="this.form.submit()">
                    $subscriptionOptions
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
