<?php
include_once '../helpers/wrapper.php';
wrapperBegin('Calendar', 'calendar');
echo <<<HTML
    <button  id='leftbutton' onclick='leftClick()'><img class='img' src='../images/Leftarrow.gif' alt = 'Previous month'></button>
    <button  id='rightbutton' onclick='rightClick()'><img class='img' src = '../images/Leftarrow.gif' alt = 'Next month'></button>
    <table>
HTML;
echo "<caption id='caption'></caption>";
echo <<<HTML
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
        echo "<td id='" . $id . "' onclick='onClick(this.id);'></td>";
    }
    echo "</tr>";
}
echo <<<HTML
    </table> 
    
HTML;
$jsonFile = file_get_contents('/srv/http/json/calendar/calendarEvents.json');
wrapperEnd('<script>var mydata = ' . $jsonFile . '</script><script src="/js/calendarclass.js"></script><script src="/js/calendar.js"></script>', false);