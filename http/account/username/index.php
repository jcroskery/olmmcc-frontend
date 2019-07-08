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
if ($_SESSION['verified']) {
    if ($_POST['username'] != '') {
        if (getRow('users', 'username', $_POST['username'])) {
            if ($_POST['username'] == $_SESSION['username']) {
                $message = "This username is already registered to your account.";
                echo json_encode(['message' => $message]);
            } else {
                $message = "Sorry, this username has already been taken. Please select another.";
                echo json_encode(['message' => $message]);
            }
        } else {
            changeRow('users', $_SESSION['id'], 'username', $_POST['username']);
            $message = 'Sucessfully updated username!';
            echo json_encode(['message' => $message]);
        }
    } else {
        $message = 'An error occurred, please try again.';
        echo json_encode(['message' => $message]);
    }
}