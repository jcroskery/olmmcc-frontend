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
include_once '/srv/http/api/database/accessTable.php';
include_once '/srv/http/helpers/displayMessage.php';
$subscriptionOptions = ['You are now unsubscribed from receiving emails.', 'You are now subscribed to receive emails.', 'You are now subscribed to receive emails and reminders.'];
if (loggedIn()) {
    $subscription_policy = $_POST['subscriptionPolicy'];
    if ($subscription_policy > -1 && $subscription_policy < 3) {
        changeRow('users', $_SESSION['id'], 'subscription_policy', $subscription_policy);
        $message = 'Subscription policy updated successfully! ' . $subscriptionOptions[$subscription_policy];
        displayPopupNotification($message, '/account/');
    } else {
        $message = 'This is already your subscription policy.';
        displayPopupNotification($message, '/account/');
    }
} else {
    notLoggedIn();
}
