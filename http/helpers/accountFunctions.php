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
require_once '/srv/logincreds.php';
function deleteAccount($id)
{
    global $connection;
    $stmt = $connection->prepare("delete from userlist where id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function createAccount($email, $username, $password)
{
    global $connection;
    $stmt = $connection->prepare("INSERT INTO userlist (email, username, password, verified, admin, subscription_policy, invalid_email) VALUES (?, ?, ?, 0, 0, 1, 0)");
    $stmt->bind_param("sss", $email, $username, $password);
    $stmt->execute();
}
function verifyAccount($id)
{
    global $connection;
    $stmt = $connection->prepare("UPDATE userlist set verified = 1 where id = ?");
    echo $id;
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function changeEmail($newEmail, $id)
{
    global $connection;
    $stmt = $connection->prepare("update userlist set email=? where id=?");
    $stmt->bind_param("ss", $newEmail, $id);
    $stmt->execute();
}
function unVerifyAccount($id)
{
    global $connection;
    $stmt = $connection->prepare("update userlist set verified=0 where id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function getAccountFromEmail($email)
{
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM userlist WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_array(MYSQLI_NUM);
}
function getAccountFromUsername($username)
{
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM userlist WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_array(MYSQLI_NUM);

}
function setNotInvalidEmail($id)
{
    global $connection;
    $stmt = $connection->prepare("update userlist set invalid_email=0 where id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function refreshAccount()
{
    include_once '/srv/http/api/session/sessionStart.php';
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM userlist WHERE id = ?");
    $stmt->bind_param("s", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array(MYSQLI_NUM);
    $_SESSION['verified'] = $row[4];
    $_SESSION['email'] = $row[0];
    $_SESSION['username'] = $row[1];
    $_SESSION['admin'] = $row[5];
    $_SESSION['subscription_policy'] = $row[6];
    $_SESSION['invalid_email'] = $row[7];
}
function getSubscriptionPolicyName($subscriptionPolicy)
{
    $subscriptionNames = ['No emails', 'Emails', 'Emails and reminders'];
    return $subscriptionNames[$subscriptionPolicy];
}
