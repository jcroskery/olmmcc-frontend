<?php
include_once '/srv/http/helpers/displayMessage.php';
include_once '/srv/http/helpers/sessionStart.php';
function wrapperBegin($title, $pageId, $loginRequired = false)
{
    $verificationCodes;
    $bodyClassName = $pageId . 'Class';
    if($pageId == 'home'){
        $verificationCodes = <<<HTML
        <meta name="google-site-verification" content="1jz_Cu9-cImeDq9RlvewQ2dcjKSnz8AJZU6p_4w0Fq0"/> 
        <meta name="msvalidate.01" content="994981451F10A9DCC776A33A6B67BAAC" />
HTML;
    }
    if($loginRequired && !loggedIn()){
        return false;
    }
    echo <<<HTML
    <!DOCTYPE html>
    <html lang='en'>

    <head>
    <meta charset="UTF-8" />
        <title>OLMM Children's Choir-$title</title>
        <link rel="stylesheet" type="text/css" href="/css/main.css"> 
        $verificationCodes
        <meta name="description" content="Official site of the OLMM Children's Choir, or the OLMMCC for short. We are a group of children who love singing for God and performing music at various events in and around our parish.">
        <meta name="keywords" content="olmm, olmmcc, children, choir, russell, tk, childrens, children's, $pageId">
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
    if($_SESSION['popupNotification'] != ''){
        $otherScripts .= $_SESSION['popupNotification'];
        $_SESSION['popupNotification'] = '';
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
    $message = "Please log in to view this page";
    displayPopupNotification($message, '/login/');
}
function topnav($id){
    $active = array();
    $active[$id] = "id='active'";
    echo <<<HTML
    <div id="topnav">
            <div class="left-align">
                <a $active[home] href="/">Home</a>
                <a $active[about] href="/about">About</a>
                <a $active[songs] href="/songs">Songs</a>
                <a $active[calendar] href="/calendar">Calendar</a>
                <a $active[faq] href="/faq">FAQ</a>
                <a $active[contact] href="/contact">Contact</a>
                <a class="tradlink" href="http://www.olmm.ca">Visit OLMM's homepage</a>
            </div>
            <div class="right-align">
HTML;
$username = $_SESSION['username'];
    if(isset($_SESSION['username'])){
        echo <<<HTML
        <a $active[logout] class="login" href="/logout">Logout</a>
        <a $active[account] class="login" href="/account">Welcome, $username</a>
HTML;
    } else {
        echo <<<HTML
            <a $active[signup] class="login" href="/signup">Sign up</a>
            <span>or</span>
            <a $active[login] class="login" href="/login">Login</a>
HTML;
    }
    echo <<<HTML
            </div>
            
        </div>

HTML;
}
function bottom(){
    echo <<<HTML
    <div class="bottom">
        <span class='bottomSpan'>&copy; Justus Croskery. <a href='/license'>License</a> <a href='/privacy/'>Privacy Policy</a></span>
    </div>

HTML;
}