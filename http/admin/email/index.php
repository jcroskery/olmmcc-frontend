<?php
include_once '/srv/http/helpers/wrapper.php';
if($_SESSION['admin']){
    wrapperBegin('Compose Email', '');
    echo <<<HTML
    <div id='main-text'>
        <H1>Compose Email</H1>
        <form action='email.php' method='post'  style='text-align: center;'>
            <span class='pre'>From: </span>
            <select name='subscriptionPolicy'>
                <option value='justus@olmmcc.tk' selected='selected'>justus@olmmcc.tk</option>
                <option value='justus.croskery@gmail.com'>justus.croskery@gmail.com</option>
            </select>
            <br>
<span class='pre'>To: </span>
<select name='emailAddresses'>
    <option value='Choir' selected='selected'>Choir</option>
    $allAccounts
</select>
<input type='button' value='Add' onclick='addEmail'/>
<br>
<span class='pre'>Body: </span>
<br>
<textarea id="emailBody" placeholder='Email body here' name="body"></textarea>
<br>
<input class='submit' type="submit" value="Send Email"/>
        </form>
    </div>
HTML;
    wrapperEnd("<script src='/js/emailAdmin.js/>");
} else {
    notLoggedIn();
}