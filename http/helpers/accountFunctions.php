<?php
require_once '/srv/logincreds.php';
function deleteAccount($id)
{
    global $connection;
    $stmt = $connection->prepare("delete from userlist where id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function createAccount($email, $username, $password){
    global $connection;
    $stmt = $connection->prepare("INSERT INTO userlist (email, username, password, verified, admin, subscription_policy, invalid_email) VALUES (?, ?, ?, 0, 0, 1, 0)");
    $stmt->bind_param("sss", $email, $username, $password);
    $stmt->execute();
}
function verifyAccount($id){
    global $connection;
    $stmt = $connection->prepare("UPDATE userlist set verified = 1 where id = ?");
    echo $id;
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function changeEmail($newEmail, $id){
    global $connection;
    $stmt = $connection->prepare("update userlist set email=? where id=?");
    $stmt->bind_param("ss", $newEmail, $id);
    $stmt->execute();
}
function unVerifyAccount($id){
    global $connection;
    $stmt = $connection->prepare("update userlist set verified=0 where id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function getAccountFromEmail($email){
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM userlist WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result();
}
function setNotInvalidEmail($id){
    global $connection;
    $stmt = $connection->prepare("update userlist set invalid_email=0 where id=?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function refreshAccount(){
    include_once '/srv/http/helpers/sessionStart.php';
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
function getSubscriptionPolicyName($subscriptionPolicy){
    $subscriptionNames = ['No emails', 'Emails', 'Emails and reminders'];
    return $subscriptionNames[$subscriptionPolicy];
}