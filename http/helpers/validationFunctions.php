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
require_once '/srv/http/helpers/accountFunctions.php';
function checkPasswordsMatch($password1, $password2)
{
    return ($password1 === $password2) ? true : "Your passwords do not match, please re-enter them.";
}
function checkPassword($password)
{
    return (strlen($password) <= 128 && strlen($password) >= 8) ? true : 'Please use a password between 8 and 128 characters long.';
}
function checkUsername($username)
{
    if(strlen($username) <= 16 && strlen($username) >= 4 && !preg_match('/[^A-Za-z0-9]/', $username)){
        return (getAccountFromUsername($username)) ? "Sorry, this username has already been taken. Please select another." : true;
    }
    return 'Sorry, your username is invalid. Please use between 4 and 16 characters and only letters and numbers for your username.';
}
function checkEmail($email)
{
    if(strlen($email) <= 64){
        return (getAccountFromEmail($email)) ? 'Sorry, your email address has already been registered. Please use a different address or log in with your account.' : true;
    }
    return 'Sorry, your email address is too long. Please use a different email address.';
}
