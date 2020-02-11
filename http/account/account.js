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
    let formData = new FormData();
    let email = document.getElementById('email').value;
    formData.append("session", window.localStorage.getItem("session"));
    formData.append('email', email);
    sendReq(formData, "https://api.olmmcc.tk/send_change_email", (json) => {
        if (json.success) {
            window.localStorage.setItem("notification", "An email containing a verification code for your email change request has been sent to " + json.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/email";
        } else if (json.message) {
            createNotification(json.message);
        }
    });
}
function changeSubscription() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    formData.append('subscription', document.getElementById('subscription').value);
    sendReq(formData, "https://api.olmmcc.tk/change_subscription", displayResponse);
}
function changePassword() {
    let formData = new FormData();
    formData.append('password1', document.getElementById('newPassword1').value);
    formData.append('password2', document.getElementById('newPassword2').value);
    formData.append("session", window.localStorage.getItem("session"));
    sendReq(formData, "https://api.olmmcc.tk/send_password_email", (json) => {
        if (json.success) {
            window.localStorage.setItem("notification", "An email containing a verification code for your password change request has been sent to " + json.email + ". Please check your inbox, including the spam folder, for the link. It may take a few minutes to receive the email.");
            window.location = "/account/password/verify";
        } else if (json.message) {
            createNotification(json.message);
        }
    });
}
function deleteAccount() {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    sendReq(formData, "https://api.olmmcc.tk/send_delete_email", (json) => {
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
    document.getElementById('email').value = json.email;
    document.getElementById('subscription').selectedIndex = json.subscription_policy;
    if (json.admin === "1") {
        document.getElementById('adminLabel').textContent += 'Admin';
        let adminButton = document.createElement('button');
        adminButton.id = 'admin';
        adminButton.classList = 'centerDiv inline';
        adminButton.addEventListener('click', () => { window.location = '/admin/'; });
        adminButton.textContent = "Go to Administrator Settings";
        document.getElementById('delete').insertAdjacentElement('afterend', adminButton);
    } else {
        document.getElementById('adminLabel').textContent += 'Member';
    }
}
document.getElementById('changeEmail').addEventListener('click', changeEmail);
document.getElementById('changeSubscription').addEventListener('click', changeSubscription);
document.getElementById('changePassword').addEventListener('click', changePassword);
document.getElementById('delete').addEventListener('click', deleteAccount);

let accountForm = new FormData();
accountForm.append("details", 
    JSON.stringify(["email", "subscription_policy", "admin"])
);
accountForm.append("session", window.localStorage.getItem("session"));
sendReq(accountForm, "https://api.olmmcc.tk/get_account", displayDetails);
