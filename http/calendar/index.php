<?php
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