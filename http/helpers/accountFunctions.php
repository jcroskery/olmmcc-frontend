<?php
require_once '/srv/logincreds.php';
function deleteAccount($id)
{
    global $connection;
    $stmt = $connection->prepare("delete from userlist where id = ?");
    $stmt->bind_param("s", $id);
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