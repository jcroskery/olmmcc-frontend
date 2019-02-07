<?php
include_once '/srv/http/helpers/wrapper.php';
if($_SESSION['admin']){
    wrapperBegin('Articles');
    $files = scandir('/srv/http/articles/songs/');
    $songArticles;
    $mainArticles;
    foreach($files as $file){
        if(is_file('/srv/http/articles/songs/' . $file)){
            $songArticles .= <<<HTML
            <form class='leftFloat' action="/admin/articles/edit/" method="post">
            <button type='submit' name='songs' value=$file>$file</button>
            </form>
            <form class='rightFloat' action="/admin/articles/delete/" method="post">
            <button type='submit' name='songs' value=$file>Delete $file</button>
            </form>
            <br><br><br>
HTML;
        }
    }
    $files = scandir('/srv/http/articles/main/');
    foreach($files as $file){
        if(is_file('/srv/http/articles/main/' . $file)){
            $mainArticles .= <<<HTML
            <form class='leftFloat' action="/admin/articles/edit/" method="post">
            <button type='submit' name='main' value=$file>$file</button>
            </form>
            <form class='rightFloat' action="/admin/articles/delete/" method="post">
            <button type='submit' name='main' value=$file>Delete $file</button>
            </form>
            <br><br><br>
HTML;
        }
    }
    echo <<<HTML
    <div id="main-text">
        <h1>Main Articles</h1>
        $mainArticles
        <h1>Song Articles</h1>
        $songArticles
    </div>
HTML;
    wrapperEnd();
} else {
    notLoggedIn();
}