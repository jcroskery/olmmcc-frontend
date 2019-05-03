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
if (wrapperBegin('Your Account', 'account', true)) {
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $subscriptionName = getSubscriptionPolicyName($_SESSION['subscription_policy']);
    $subscriptionOptions = '<option disabled selected>' . $subscriptionName . '</option>';
    for ($i = 0; $i < 3; $i++) {
        if ($i != $_SESSION['subscription_policy']) {
            $subscriptionOptions .= "<option value='$i'>" . getSubscriptionPolicyName($i) . "</option>";
        }
    }
    $accountLevel = $_SESSION['admin'] ? 'Admin' : 'Member';
    $disabled = $_SESSION['admin'] ? '' : "disabled='disabled'";
    echo <<<HTML
        <div id="main-text" class='centerDiv'>
            <H1>Your Account</H1>
            <form action='/account/email/' method='post'>
                <label class='leftFloat' for='email'>Email: </label>
                <input class='leftFloat' id='email' name='email' type='email' autocomplete='on' placeholder='Your new email address' required='required' value='$email'/>
                <button class='rightFloat' type='submit'>Change Email</button>
            </form>
            <br><br>
            <form action='/account/username/' method='post'>
                <label class='leftFloat' for='username'>Username: </label>
                <input name='username' class='leftFloat' id='username' type='text' autocomplete='on' placeholder='Your new username' required='required' value='$username'/>
                <button class='rightFloat' type='submit'>Change Username</button>
            </form>
            <br><br>
            <form action="/account/subscription/" method='post'>
                <label class='leftFloat' for='subscription'>Subscription policy: </label>
                <select class='leftFloat' id='subscription' name='subscriptionPolicy'>
                    $subscriptionOptions
                </select>
                <input class='rightFloat' type='submit' value='Change Subscription'/>
            </form>
            <br><br><br>
            <form action='/account/password/changePassword.php' method='post'>
                <label class='leftFloat' for='currentPassword'>Current Password: </label>
                <input name='currentPassword' class='leftFloat' id='currentPassword' type='password' placeholder='Your current password' required='required' />
                <br><br>
                <label class='leftFloat' for='newPassword1'>New Password: </label>
                <input name='newPassword1' class='leftFloat' id='newPassword1' type='password' placeholder='Your new password' required='required' />
                <br><br>
                <label class='leftFloat' for='newPassword2'>Repeat Password: </label>
                <input name='newPassword2' class='leftFloat' id='newPassword2' type='password' placeholder='Repeat your new password' required='required' />
                <button class='rightFloat' type='submit'>Change Password</button>
            </form>
            <br><br><br>
            <label for='admin' class='leftFloat'>Account type: $accountLevel</label>
            <form action='/account/delete'>
                <button class='rightFloat delete' type='submit'>Delete Account</button>
            </form>
            <form class='inline' action='/admin/'>
                <button $disabled id='admin' class='centerDiv inline' type='submit'>Go to Administrator settings</button>
            </form>
            <br><br>
        </div>

HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}
