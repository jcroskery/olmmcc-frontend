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
function handleLogin(json) {
    if (json.message) {
        createNotification(json.message);
    } else {
        let email = json.email;
        window.localStorage.setItem("unverified_session", json.session);
        let formData = new FormData();
        formData.append("session", json.session);
        sendReq(formData, 'https://api.olmmcc.tk/send_login_email', (json) => {
            if (json.success == true) {
                window.localStorage.setItem("notification", "An login code has been sent to your email at " + email + ". Please check your inbox and spam folder. If you do not receive the email then log in again.");
                window.location = "/login/verify";
            }
        });
    }
}