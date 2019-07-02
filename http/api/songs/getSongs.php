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
include_once '/srv/http/api/database/accessTable.php';
foreach (getAllRows('articles') as $article) {
    foreach ($article as $propertyName => $property) {
        if ($propertyName !== 'id') {
            $json[$propertyName] = $property;
        }
    }
    $json['expiry'] = DateTime::createFromFormat('Y-m-d', $article['expiry'])->getTimestamp();
    if (!isset($formattedArticle) || $formattedArticle['expiry'] <= $json['expiry']) {
        $formattedArticle = $json;
    }
}
if($formattedArticle['expiry'] >= time()) {
    foreach (getRows('songs', 'article', $formattedArticle['title']) as $song) {
        $songs[$song['id']] = ['name' => $song['name'], 'link' => $song['link'], 'role' => $song['role']];
    }
    echo json_encode(['title' => $formattedArticle['title'], 'text' => $formattedArticle['text'], 'songs' => $songs]);
} else {
    echo json_encode(['title' => '']);
}
