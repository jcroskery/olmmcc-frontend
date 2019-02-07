<?php
require_once '/srv/logincreds.php';
function addSong($name, $link){
    global $connection;
    $stmt = $connection->prepare("INSERT INTO songs (name, link) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $link);
    $stmt->execute();
}
function changeName($name, $id){
    global $connection;
    $stmt = $connection->prepare("UPDATE songs set name = ? where id = ?");
    $stmt->bind_param("ss", $name, $id);
    $stmt->execute();
}
function changeLink($link, $id){
    global $connection;
    $stmt = $connection->prepare("UPDATE songs set link = ? where id = ?");
    $stmt->bind_param("ss", $link, $id);
    $stmt->execute();
}
function deleteSong($id)
{
    global $connection;
    $stmt = $connection->prepare("delete from songs where id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
}
function getSong($name){
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM songs WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_array(MYSQLI_NUM);
}
function getSongs(){
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM songs");
    $stmt->execute();
    $result = $stmt->get_result();
    return mysqli_fetch_all ($result, MYSQLI_ASSOC);
}