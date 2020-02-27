function submitChange() {
    sendReq({
        "code": document.getElementById('code').value
    }, "https://api.olmmcc.tk/change_email", (json) => {
        if (json.success == true) {
            window.localStorage.setItem("notification", "Your email address has been successfully changed. Please log in with your new email address.");
            window.localStorage.removeItem("session");
            window.location = "/login/";
        } else {
            createNotification("Something went wrong. Your code may be incorrect.");
        }
    });
}
document.getElementById('verify').addEventListener('click', submitChange);
document.getElementById('code').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        submitChange();
    }
});
