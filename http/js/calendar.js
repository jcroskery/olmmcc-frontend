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
dates = document.getElementsByTagName('td');
for (i = 0; i < dates.length; i++) {
    dates[i].onclick = onClick;
}
document.getElementById('leftbutton').onclick = leftClick;
document.getElementById('rightbutton').onclick = rightClick;

const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
function loadJSON() {
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open("get", "/api/calendar/echoCalendarEvents.php", true);
    xobj.send();
    xobj.onload = onGetEvents;
}

function leftClick() {
    date.setMonth(date.getMonth() - 1);
    drawCalendar();
}
function rightClick() {
    date.setMonth(date.getMonth() + 1);
    drawCalendar();
}

eventsArray = [];
date = new Date();
caption = document.getElementById('caption');
month = monthNames[date.getMonth()];
year = date.getFullYear();
firstDay = 0;
lastDay = 0;
caption.innerHTML = month + ' ' + year;

function drawCalendar() {
    month = monthNames[date.getMonth()];
    year = date.getFullYear()
    caption.innerHTML = month + ' ' + year;
    firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    for (let i = 1; i <= 42; i++) {

        let calendarDate = i - firstDay;
        var currentDate = new Date(date.getFullYear(), date.getMonth(), calendarDate);
        if (calendarDate == date.getDate()) {
            document.getElementById(i).className = 'selectedDate';
        } else {
            document.getElementById(i).className = '';
        }
        if (calendarDate > 0 && calendarDate <= lastDay) {
            document.getElementById(i).innerHTML = calendarDate;
            eventsArray.forEach(calendarClassEvent => {
                if (calendarClassEvent.isCorrectDate(currentDate)) {

                    document.getElementById(i).innerHTML += ('<p class="calendarEventTitle">' + calendarClassEvent.getName + '</p>' + '<p class="calendarEvent">' + calendarClassEvent.getTime + '</p>');
                }
            });
        } else {
            document.getElementById(i).innerHTML = '';
        }

    }
}
function keydown(event) {
    if (event.keyCode == 27) {
        clearDetails();
    } else if (event.keyCode == 37) {
        date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 1);
        drawCalendar();
    } else if (event.keyCode == 39) {
        date = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 1);
        drawCalendar();
    } else if (event.keyCode == 38) {
        date = new Date(date.getFullYear(), date.getMonth(), date.getDate() - 7);
        drawCalendar();
    } else if (event.keyCode == 40) {
        date = new Date(date.getFullYear(), date.getMonth(), date.getDate() + 7);
        drawCalendar();
    }
}
function clearDetails() {
    var element = document.getElementById("graydiv");
    if (element != null) {
        element.parentNode.removeChild(element);
    }
}
function displayDetails(clickedId) {
    clearDetails();
    let grayDiv = document.createElement('div');
    grayDiv.id = 'graydiv';
    document.getElementById('myPage').append(grayDiv);
    let detailsDiv = document.createElement('div');
    detailsDiv.id = 'detailsDiv';

    eventsArray.forEach(calendarClassEvent => {
        if (calendarClassEvent.isCorrectDate(date)) {
            detailsDiv.innerHTML = '<h4>' + calendarClassEvent.getName + '</h4>';
            detailsDiv.innerHTML += '<p>Time: ' + calendarClassEvent.getTime + '</p>';
            detailsDiv.innerHTML += '<p>Notes: ' + calendarClassEvent.getNotes + '</p>';
        }
    });
    document.getElementById('graydiv').append(detailsDiv);
    let close = "<svg id='closeDetails' viewBox='0, 0, 100, 100'>";
    close += "<circle cx=50 cy=50 r=50 fill=black />";
    close += "<text id='closeX' x='50%' text-anchor='middle' y='85' fill='white'>X</text>";
    close += "</svg>";
    document.getElementById("detailsDiv").innerHTML += close;
    document.getElementById('closeDetails').onclick = clearDetails;
}
function onClick() {
    date = new Date(date.getFullYear(), date.getMonth(), this.id - firstDay);
    if (document.getElementById(this.id).innerHTML.includes('<p ')) {
        displayDetails(date);
    }
    drawCalendar();
}
function init(){
    document.onkeydown = keydown;
    drawCalendar()
}
function timeFormatter(time){
    var hours = Number(time.substr(0, 2));
    return ((hours > 12) ? hours - 12 : hours) + time.slice(2, -3) + ((hours < 12) ? " AM" : " PM")
}
function onGetEvents() {
    response = this.responseText;
    actual_JSON = JSON.parse(response);
    for (var i = 0; i < actual_JSON.length; i++) {
        obj = actual_JSON[i];
        eventsArray.push(new calendarclass(new Date(obj.date + "T12:00:00"), obj.title, timeFormatter(obj.startTime), timeFormatter(obj.endTime), obj.notes));
    }
    init();
}; 
loadJSON();