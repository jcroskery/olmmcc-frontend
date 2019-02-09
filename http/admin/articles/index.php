<?php
include_once '/srv/http/helpers/wrapper.php';
function makeRows($type, $location)
{
    $files = scandir($location);
    $articles;
    foreach ($files as $file) {
        if (is_file($location . $file)) {
            $articles .= <<<HTML
            <tr>
                <td>
                    <form action="/admin/articles/edit/" method="post">
                        <input type='textarea' name='name' value='$file'/>
                        <button type='submit' name=$type value='name'>Change Name</button>
                    </form>
                </td>
                <td>$type Article</td>
                <td>
                    <form action="/admin/articles/edit/" method="post">
                        <button type='submit' name=$type value='edit'>Edit $file</button>
                    </form>
                </td>
                <td>
                    <form action="/admin/articles/delete/" method="post">
                        <button class='delete' type='submit' onclick='alert("To cancel deletion, close the tab now!");' name='$type' value='$file'>Delete $file</button>
                    </form>
                </td>
            </tr>
HTML;
        }
    }
    return $articles;
}
if ($_SESSION['admin']) {
    wrapperBegin('Articles');
    $articles = makeRows('Main', '/srv/http/articles/main/') . makeRows('Song', '/srv/http/articles/songs/');
    echo <<<HTML
        <table class='database'>
            <caption>Articles</caption>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Edit</th>
                <th>Options</th>
            </tr>
            $articles
            <form action="/admin/articles/add/" method="post">
                <tr>
                    <td>
                        <input type='textarea' name='name' value='New Name'/>
                    </td>
                    <td>
                        <select name='type'>
                            <option value='songs'>Song Article</option>
                            <option value='main'>Main Article</option>
                        </select>
                    </td>
                    <td></td>
                    <td>
                        <button type='submit' name='$type' value=$file>Add New Article</button>
                    </td>
                </tr>
            </form>
        </table>
HTML;
    wrapperEnd('', false);
} else {
    notLoggedIn();
}
