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
include_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/api/session/sessionStart.php';
function wrapperBegin($title, $pageId = '', $loginRequired = false)
{
    $verificationCodes;
    $bodyClassName = $pageId . 'Class';
    if($loginRequired && !loggedIn()){
        return false;
    }
    echo <<<HTML
    <!DOCTYPE html>
    <html lang='en'>

    <head>
    <meta charset="UTF-8" />
        <title>OLMM Children's Choir - $title</title>
        <link rel="stylesheet" type="text/css" href="/css/main.css"> 
        <meta name="google-site-verification" content="OcL4_cqE4ATKo4jJzPRpPmK5hs8zPmri7wRGKHO2Osg" />
        <meta name="msvalidate.01" content="994981451F10A9DCC776A33A6B67BAAC" />
        <meta name="description" content="Official site of the OLMM Children's Choir (OLMMCC).">
        <meta name="keywords" content="olmm, olmmcc, choir, russell, tk, childrens, $pageId">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body class='$bodyClassName'>
        <div id="myPage">
HTML;
    topnav($pageId);
    return true;
}
function wrapperEnd($otherScripts = '', $bottom = true)
{
    if($bottom){
        bottom();
    }
    if($_COOKIE['Notification'] != ''){
        $otherScripts .= '<script src="/js/notification.js"></script>';
    }
    echo <<<HTML
        </div>
    $otherScripts
</body>
</html>
HTML;
}
function loggedIn(){
    return $_SESSION['verified'];
}
function notLoggedIn(){
    if($_SESSION['id']){
        $message = "Please log in to an administrator account to view this page.";
        displayPopupNotification($message, '/login/');
    } else {
        $message = "Please log in to view this page.";
        displayPopupNotification($message, '/login/');
    }
}
function createLinks($classes, $linkId, $href, $title, $activeId){
    $active = ($linkId===$activeId && $linkId!=='') ? 'id="active"' : '';
    return <<<HTML
    <a class='$classes' $active href='$href'>$title</a>
HTML;
}
function topnav($id){
    $links[] = createLinks('leftFloat', 'home', "/", 'Home', $id);
    $links[] = createLinks('leftFloat', 'about', '/about', "About", $id);
    $links[] = createLinks('leftFloat', 'songs', '/songs', "Songs", $id);
    $links[] = createLinks('leftFloat', 'calendar', '/calendar', "Calendar", $id);
    $links[] = createLinks('leftFloat', 'faq', '/faq', "FAQ", $id);
    $links[] = createLinks('leftFloat', 'contact', '/contact', "Contact", $id);
    $links[] = createLinks('leftFloat tradlink', '', 'http://www.olmm.ca', "Visit OLMM's homepage", $id);
    if(isset($_SESSION['username'])) {
        $links[] = createLinks('rightFloat', '', '/logout', 'Logout', $id);
        $links[] = createLinks('rightFloat', 'account', '/account', 'Welcome, ' . $_SESSION['username'], $id);
    } else {
        $links[] = createLinks('rightFloat', 'signup', '/signup', 'Sign up', $id);
        $links[] = createLinks('rightFloat', 'login', '/login', 'Login', $id);
    }
    foreach($links as $link){
        if(strpos($link, 'id="active"')){
            $activeLink = $link;
        }
        $otherLinks .= $link;
    }
    echo <<<HTML
        <div id="topnav">
            $activeLink
            <div class='dropdown'>
                <input type='checkbox' id='dropdownCheck' />
                <label for='dropdownCheck'>
                    <svg class='dropdownSvg' viewBox='0, 0, 50, 50'>
                        <rect x='1' y='10' width='48' height='5' rx='2.5' ry='2.5' />
                        <rect x='1' y='22.5' width='48' height='5' rx='2.5' ry='2.5' />
                        <rect x='1' y='35' width='48' height='5' rx='2.5' ry='2.5' />
                    </svg>
                </label>
                <div class="dropdown-content">
                    $otherLinks
                </div>
            </div>
        </div>

HTML;
}
function bottom(){
    echo <<<HTML
    <div class="bottom">
        <span class='bottomSpan'>&copy; Justus Croskery. <a href='/terms'>Terms of Use</a> <a href='/privacy/'>Privacy Policy</a></span>
    </div>

HTML;
}