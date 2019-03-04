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
function deleteColumn($table, $id)
{
    global $connection;
    $stmt = $connection->prepare("delete from " . $table . "  where id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
function createColumn($table, $namesArray, $valuesArray)
{
    global $connection;
    $names = '';
    $questionMarks = str_repeat('?,', sizeof($namesArray)-1) . "?";
    for ($i = 0; $i < sizeof($namesArray); $i++) {
        $appendCharacter = ($i - 1 != sizeof($names)) ? ',' : '';
        $names .= ($namesArray[$i] . $appendCharacter);
    }
    $stmt = $connection->prepare("INSERT INTO " . $table . " (" . $names . ") VALUES (" . $questionMarks . ")");
    $stmt->bind_param(str_repeat('s', sizeof($namesArray)), ...$valuesArray);
    $stmt->execute();
}
