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
function displayResponse(json) {
    createNotification(json.message);
}
function changeEmail() {
    sendReq({
        'email': document.getElementById('email').value
    }, "https://api.olmmcc.tk/send_change_email", (json) => {
        if (json.success) {
            window.localStorage.setItem("notification", "An email containing a verification code for your email change request has been sent to " + json.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/email";
        } else if (json.message) {
            createNotification(json.message);
        }
    });
}
function changeSubscription() {
    sendReq({
        'subscription': document.getElementById('subscription').value
    }, "https://api.olmmcc.tk/change_subscription", displayResponse);
}
function deleteAccount() {
    sendReq({}, "https://api.olmmcc.tk/send_delete_email", (json) => {
        if (json.success) {
            window.localStorage.setItem("notification", "An email containing a verification code for your account deletion request has been sent to " + json.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/delete";
        } else if (json.message) {
            createNotification(json.message);
        }
    });
}
function displayDetails(json) {
    if (json.session == "none") { //Not logged in
        window.localStorage.setItem("notification", "Please log in to view this page."); 
        window.location = '/login/';
        return;
    }
    if (json.admin === "1") {
        window.location = "/admin/";
    }
    document.getElementById('email').value = json.email;
    document.getElementById('subscription').selectedIndex = json.subscription_policy;
}
document.getElementById('changeEmail').addEventListener('click', changeEmail);
document.getElementById('changeSubscription').addEventListener('click', changeSubscription);
document.getElementById('delete').addEventListener('click', deleteAccount);

if (!window.localStorage.getItem("session")) {
    displayDetails({"session": "none"});
} else {
    sendReq({
        "details": "email subscription_policy admin"
    }, "https://api.olmmcc.tk/get_account", displayDetails);
}
