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
include_once '/etc/httpd/privateVars.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) {
    die("Connection error");
}
function sanitizePost(&$post){
    foreach($post as &$postVar){
        $postVar = stripslashes($postVar);
        $postVar = strip_tags($postVar, '<p>');
        $postVar = htmlentities($postVar);
    }
}
function deleteRow($table, $id)
{
    global $connection;
    $stmt = $connection->prepare("delete from " . $table . "  where id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return mysqli_error($connection);
}
function createRow($table, $namesArray, $valuesArray)
{
    global $connection;
    $names = '';
    $questionMarks = str_repeat('?,', sizeof($namesArray) - 1) . "?";
    for ($i = 0; $i < sizeof($namesArray); $i++) {
        $names .= ($namesArray[$i] . ',');
    }
    $names = substr($names, 0, strlen($names) - 1);
    $stmt = $connection->prepare("INSERT INTO " . $table . " (" . $names . ") VALUES (" . $questionMarks . ")");
    $stmt->bind_param(str_repeat('s', sizeof($namesArray)), ...$valuesArray);
    $stmt->execute();
    return mysqli_error($connection);
}
function getRow($table, $columnName, $columnValue)
{
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM " . $table . " WHERE " . $columnName . "= ?");
    $stmt->bind_param("s", $columnValue);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_array(MYSQLI_ASSOC);
}
function getAllRows($table)
{
    global $connection;
    $stmt = $connection->prepare("SELECT * FROM " . $table . " order by id");
    $stmt->execute();
    $result = $stmt->get_result();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function getMaxId($table)
{
    global $connection;
    $stmt = $connection->prepare("SELECT MAX(id) FROM " . $table);
    $stmt->execute();
    $result = $stmt->get_result();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function getMinId($table)
{
    global $connection;
    $stmt = $connection->prepare("SELECT MIN(id) FROM " . $table);
    $stmt->execute();
    $result = $stmt->get_result();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function changeRow($table, $id, $columnName, $newValue)
{
    global $connection;
    $stmt = $connection->prepare("UPDATE " . $table . " set " . $columnName . " = ? where id = ?");
    $stmt->bind_param("ss", $newValue, $id);
    $stmt->execute();
    return mysqli_error($connection);
}
function getAllColumns($table)
{
    global $connection;
    $stmt = $connection->prepare("SHOW columns FROM " . $table);
    $stmt->execute();
    $result = $stmt->get_result();
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function getTables()
{
    global $connection;
    $stmt = $connection->prepare("show tables");
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach ($rows as $row) {
        $formattedRows[] = $row[array_key_first($row)];
    }
    return $formattedRows;
}
