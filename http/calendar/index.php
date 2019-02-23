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
include_once '../helpers/wrapper.php';
wrapperBegin('Calendar', 'calendar');
echo <<<HTML
    <button class='calendarButton' id='leftbutton'><img class='buttonImage' src='../images/Leftarrow.gif' alt = 'Previous month'></button>
    <button class='calendarButton' id='rightbutton'><img class='buttonImage' src = '../images/Leftarrow.gif' alt = 'Next month'></button>
    <table class='calendar'>
HTML;
echo <<<HTML
        <caption id='caption'></caption>
        <tr id='tr'>
            <th>Sunday</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
        </tr>
HTML;
for($i = 0; $i < 6; $i++){
    echo "<tr class='bodytr'>";
    for($j = 1; $j <= 7; $j++){
        $id = $i*7+$j;
        echo "<td id='" . $id . "'></td>";
    }
    echo "</tr>";
}
echo <<<HTML
    </table> 
    
HTML;
wrapperEnd('<script src="/js/calendarclass.js"></script><script src="/js/calendar.js"></script>', false);