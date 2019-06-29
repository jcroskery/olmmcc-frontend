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
require_once '/srv/http/helpers/wrapper.php';
if ($_SESSION['admin']) {
    $newId = getMinId($_POST["table"]) - 1;
    $result = changeRow($_POST["table"], $_POST['id'], 'id', $newId);
    if ($result) {
        echo json_encode(['success' => false, 'message' => $result]);
    } else {
        $row = getRow($_POST['table'], 'id', $newId);
        $message = "Successfully moved row " . $_POST['id'] . ' to start.';
        echo json_encode(['success' => true, 'message' => $message, 'row' => $row, 'oldId' => $_POST['id']]);
    }
} else {
    notLoggedIn();
}
