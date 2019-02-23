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
function addSong($name, $link, $notes){
    global $connection;
    $stmt = $connection->prepare("INSERT INTO songs (name, link, notes) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $link, $notes);
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
function changeNotes($notes, $id){
    global $connection;
    $stmt = $connection->prepare("UPDATE songs set notes = ? where id = ?");
    $stmt->bind_param("ss", $notes, $id);
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