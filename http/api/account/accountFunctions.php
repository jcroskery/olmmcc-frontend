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
require_once '/srv/http/api/database/accessTable.php';
function deleteAccount($id)
{
    deleteRow('users', $id);
}
function createAccount($email, $username, $password)
{
    createRow('users', ['email', 'username', 'password', 'verified', 'admin', 'subscription_policy', 'invalid_email'], [$name, $link, $notes, 0, 0, 1, 0]);
}
function verifyAccount($id)
{
    changeRow('users', $id, 'verified', 1);
}
function changeEmail($newEmail, $id)
{
    changeRow('users', $id, 'email', $newEmail);
}
function unVerifyAccount($id)
{
    changeRow('users', $id, 'verified', 0);
}
function getAccountFromEmail($email)
{
    return getRow('users', 'email', $email);
}
function getAccountFromUsername($username)
{
    return getRow('users', 'username', $username);
}
function getAccountFromId($id)
{
    return getRow('users', 'id', $id);
}
function setNotInvalidEmail($id)
{
    changeRow('users', $id, 'invalid_email', 0);
}
function setInvalidEmail($id)
{
    changeRow('users', $id, 'invalid_email', 1);
}
function updateSubscription($id, $subscriptionPolicy){
    changeRow('users', $id, 'subscription_policy', $subscriptionPolicy);
}
function refreshAccount()
{
    include_once '/srv/http/api/session/sessionStart.php';
    $row = getAccountFromId($_SESSION['id']);
    $_SESSION['email'] = $row[0];
    $_SESSION['username'] = $row[1];
    $_SESSION['verified'] = $row[4];
    $_SESSION['admin'] = $row[5];
    $_SESSION['subscription_policy'] = $row[6];
    $_SESSION['invalid_email'] = $row[7];
}
function getSubscriptionPolicyName($subscriptionPolicy)
{
    $subscriptionNames = ['No emails', 'Emails', 'Emails and reminders'];
    return $subscriptionNames[$subscriptionPolicy];
}
