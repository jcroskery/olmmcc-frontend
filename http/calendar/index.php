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
include_once '/srv/http/api/other/leftRightButtons.php';
buttonsBegin('Calendar', 'calendar'); //buttonsBegin adds left/right buttons to the page
echo <<<HTML
    <div class='calendar'>
        <h1></h1>
        <ul class='headerUl'>
            <li>Sunday</li>
            <li>Monday</li>
            <li>Tuesday</li>
            <li>Wednesday</li>
            <li>Thursday</li>
            <li>Friday</li>
            <li>Saturday</li>
        </ul>
HTML;
for($i = 0; $i < 6; $i++){
    echo "<ul class='bodyUl'>";
    for($j = 1; $j <= 7; $j++){
        $id = $i*7+$j;
        echo "<li id='" . $id . "'></li>";
    }
    echo "</ul>";
}
echo "</div>";
wrapperEnd('<script src="/js/popupHelper.js"></script><script src="/js/calendar.js"></script>', false);