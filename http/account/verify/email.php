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
require_once '/srv/http/helpers/sendEmail.php';
include_once '/srv/http/helpers/sessionStart.php';
$verificationid;
if ($_SESSION['verificationid'] == '') {
    $verificationid = hash('sha512', $_SESSION['id'] . bin2hex(random_bytes(20)));
    $_SESSION['verificationid'] = $verificationid;
} else {
    $verificationid = $_SESSION['verificationid'];
}

$subject = "Verify your account";
$link = "http://" . $_SERVER['HTTP_HOST'] . "/account/verify/verify.php?verification=3D" . $verificationid;
$message = "<p>Hi,</p>Here is your verification link: " . $link;
sendEmail($subject, $message, $_SESSION['notVerifiedUsername'], $_SESSION['notVerifiedEmail']);
header('location: /account/verify/');