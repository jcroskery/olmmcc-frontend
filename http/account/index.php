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
if (wrapperBegin('Your Account', '', true)) {
    echo <<<HTML
        <div id="main-text" class='centerDiv'>
            <H1>Your Account</H1>
            <label class='leftFloat' for='email'>Email: </label>
            <input class='leftFloat' id='email' name='email' type='email' autocomplete='on' placeholder='Your new email address' required='required'/>
            <button class='rightFloat' id='changeEmail'>Change Email</button>
            <br><br>
            <label class='leftFloat' for='username'>Username: </label>
            <input name='username' class='leftFloat' id='username' type='text' autocomplete='on' placeholder='Your new username' required='required'/>
            <button class='rightFloat' id='changeUsername'>Change Username</button>
            <br><br>
            <label class='leftFloat' for='subscription'>Subscription policy: </label>
            <select class='leftFloat' id='subscription' name='subscriptionPolicy'>
                <option value='0'>No Emails</option>
                <option value='1'>Emails</option>
                <option value='2'>Emails and Reminders</option>
            </select>
            <button class='rightFloat' id='changeSubscription'>Change Subscription</button>
            <br><br><br>
            <label class='leftFloat' for='currentPassword'>Current Password: </label>
            <input name='currentPassword' class='leftFloat' id='currentPassword' type='password' placeholder='Your current password' required='required' />
            <br><br>
            <label class='leftFloat' for='newPassword1'>New Password: </label>
            <input name='newPassword1' class='leftFloat' id='newPassword1' type='password' placeholder='Your new password' required='required' />
            <br><br>
            <label class='leftFloat' for='newPassword2'>Repeat Password: </label>
            <input name='newPassword2' class='leftFloat' id='newPassword2' type='password' placeholder='Repeat your new password' required='required' />
            <button class='rightFloat' id='changePassword'>Change Password</button>
            <br><br><br>
            <label for='admin' class='leftFloat' id='adminLabel'>Account type: </label>
            <button class='rightFloat delete' id='delete'>Delete Account</button>
            <br><br>
        </div>
HTML;
    wrapperEnd('account', '<script src="/api/notification/notification.js"></script><script src="/js/submitXhr.js"></script><script src="/account/account.js"></script>');
} else {
    notLoggedIn();
}
