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
session_start();
if ($_SESSION['admin']) {
    $names = [];
    $contents = [];
    foreach ($_POST as $postName => $postValue) {
        if($postName!='table') {
            $names[] = $postName;
            $contents[] = $postValue;
        }
    }
    $result = createRow($_POST['table'], $names, $contents);
    if($result) {
        echo json_encode(['success' => false, 'message' => $result]);
    } else {
        $rowId = getMaxId($_POST['table']);
        $row = getRow($_POST['table'], 'id', $rowId);
        $message = "Successfully added row " . $rowId . '.';
        echo json_encode(['success' => true, 'message' => $message, 'row' => $row]);
    }
}
