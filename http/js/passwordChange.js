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
function changePassword() {
    let formData = new FormData();
    formData.append('password1', document.getElementById('newPassword1').value);
    formData.append('password2', document.getElementById('newPassword2').value);
    formData.append("email", document.getElementById('email').value);
    submitXHR(formData, "https://api.olmmcc.tk/send_password_email", function () {
        let parsedResponse = JSON.parse(this.responseText);
        if (parsedResponse.success) {
            window.localStorage.setItem("session", parsedResponse.session);
            window.localStorage.setItem("notification", "An email containing a verification code for your password change request has been sent to " + parsedResponse.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/password/verify";
        } else if (parsedResponse.message) {
            createNotification(parsedResponse.message);
        }
    });
}

document.getElementById('changePassword').addEventListener('click', changePassword);
document.getElementById('newPassword2').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        changePassword();
    }
});