function submitDelete() {
    sendReq({
        "code": document.getElementById('code').value
    }, "https://api.olmmcc.tk/delete_account", (json) => {
        if (json.success == true) {
            window.localStorage.setItem("notification", "Your account has been successfully deleted.");
            window.localStorage.removeItem("session");
            window.location = "/";
        } else {
            createNotification("Something went wrong. Your code may be incorrect.");
        }
    });
}
document.getElementById('verify').addEventListener('click', submitDelete);
document.getElementById('code').addEventListener('keydown', (event) => {
    if (event.code === 'Enter') {
        submitDelete();
    }
});
