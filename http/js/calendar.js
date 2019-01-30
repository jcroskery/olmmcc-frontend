const monthNames = ["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
];
function loadJSON(callback) {

    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', '/json/calendar/calendarEvents.json', true);
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == "200") {
            callback(xobj.responseText);
        }
    };
    xobj.send(null);
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
function adjustCalendar() {
    let adjustValue = (document.documentElement.clientHeight - document.getElementById('topnav').clientHeight - document.getElementsByTagName('caption')[0].clientHeight - document.getElementById('tr').clientHeight) / 6 - 1;
    let nodes = document.getElementsByTagName('tr');
    for (let i = 1; i < nodes.length; i++) {
        nodes[i].style.height = adjustValue + 'px';
    }
    for (let i = 0; i < 2; i++) {
        document.getElementsByTagName("button")[i].style.bottom = 42.5 / 100 * document.documentElement.clientHeight
            - (document.getElementById('topnav').clientHeight / 2) + "px";
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
            detailsDiv.innerHTML += '<p>Description: ' + calendarClassEvent.getDescription + '</p>';
        }
    });

    document.getElementById('graydiv').append(detailsDiv);
    let close = document.createElement('img');
    close.src = '../images/close.gif';
    close.id = 'closeDetails';
    close.onclick = clearDetails;
    document.getElementById('graydiv').append(close);
}
function onClick(clickedId) {
    date = new Date(date.getFullYear(), date.getMonth(), clickedId - firstDay);
    if (document.getElementById(clickedId).innerHTML.includes('<p ')) {
        displayDetails(date);
    }
    drawCalendar();
}
function init(){
    document.onkeydown = keydown;
    drawCalendar()
    adjustCalendar();
    window.onresize = function () { window.location = window.location }
}

loadJSON(function (response) {
    actual_JSON = JSON.parse(response);
    for (var key in actual_JSON) {
        obj = actual_JSON[key];
        eventsArray.push(new calendarclass(new Date(obj.date + " 0:00"), obj.title, obj.starttime, obj.endtime, obj.description));
    }
    init();
});