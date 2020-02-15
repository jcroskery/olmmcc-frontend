function onKeyUp(e) {
    if(e.ctrlKey && e.altKey && e.keyCode == 72) {
        if (document.activeElement.name == "password") {
            let formData = new FormData();
            formData.append("password", document.activeElement.value);
            formData.append("session", window.localStorage.getItem("session"));
            sendReq(formData, "https://api.olmmcc.tk/hash_password", (json) => {
                document.activeElement.value = json.hash;
                createNotification("Successfully hashed password.");
            });
        }
    }
}
document.addEventListener('keyup', onKeyUp, false);
