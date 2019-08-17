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
function redirect() {
    window.localStorage.removeItem("session");
    window.localStorage.setItem("notification", "Successfully logged out!");
    window.location = "/";
}
function handleSession() {
    parsedResponse = JSON.parse(this.responseText);
    if (parsedResponse.username !== '') {
        let signups = document.querySelectorAll("a[href='/signup']");
        let signup = signups[signups.length - 1]; //only the last one needs to be changed
        signup.href = 'javascript:;';
        signup.textContent = "Logout";
        signup.id = '';
        signup.addEventListener('click', () => {
            let deleteForm = new FormData();
            deleteForm.append("session", window.localStorage.getItem("session"));
            submitXHR(deleteForm, 'https://api.olmmcc.tk/kill_session', redirect);
        });
        let logins = document.querySelectorAll("a[href='/login']");
        for (let i = 0; i < logins.length; i++) {
            let active = document.getElementById('active');
            if (active && active.href.includes('/account/')) {
                active.textContent = "Welcome, " + parsedResponse.username;
                logins[i].id = 'active';
            }
            logins[i].href = '/account/';
            logins[i].textContent = "Welcome, " + parsedResponse.username;
        }
    }
}
(function () {
    if (window.localStorage.getItem("notification") !== null) {
        let handleNotification = () => {
            createNotification(window.localStorage.getItem("notification"))
            window.localStorage.removeItem("notification");
        }
        let scriptSrc = '/api/notification/notification.js';
        let scripts = document.getElementsByTagName("script");
        for (var i = 0; i < scripts.length; i++) {
            if (scripts[i].getAttribute('src') === scriptSrc) {
                return handleNotification();
            }
        }
        let script = document.createElement('script');
        script.addEventListener('load', handleNotification);
        script.src = scriptSrc;
        document.body.appendChild(script);
    }
})();
if (window.localStorage.getItem("session")) {
    let sessionForm = new FormData();
    sessionForm.append("session", window.localStorage.getItem("session"));
    sessionForm.append("details", "username");
    submitXHR(sessionForm, 'https://api.olmmcc.tk/get_account', handleSession);
}