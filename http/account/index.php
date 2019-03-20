<?php
/*
Copyright (C) 2019  Justus Croskery
To contact me, email me at justus@olmmcc.tk.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/.
*/
include_once '/srv/http/helpers/wrapper.php';
include_once '/srv/http/api/account/accountFunctions.php';
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
            <br><br>
            <span class='leftFloat'>Username: $username</span>
            <form action='/account/username'>
                <button class='rightFloat' type='submit'>Save Changes</button>
                <input name='username' type='text' autocomplete='on' placeholder='Your new username' required='required' value='$username'/>
            </form>
            <br><br>
            <span class='leftFloat'>Subscription policy: $subscriptionName</span>
            <form action="/account/subscription/" method='post'>
                <input class='rightFloat' type='submit' value='Save Changes'/>
                <select class='rightFloat' name='subscriptionPolicy'>
                    $subscriptionOptions
                </select>
            </form>
            <br><br>
            <span class='leftFloat'>Account type: $accountLevel</span>
            <form action='/admin/'>
                <button $disabled class='rightFloat' type='submit'>Go to Administrator settings</button>
            </form>
            <br><br>
            <span><a href='/account/password/'>Change Password</a> or <a href='/account/delete/'>Delete Account</a></span>
            <br>
        </div>

HTML;
wrapperEnd();
} else {
    notLoggedIn();
}
