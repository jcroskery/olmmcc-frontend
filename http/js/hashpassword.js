function onKeyUp(e) {
    if(e.ctrlKey && e.altKey && e.keyCode == 72) {
        let active = document.activeElement;
        if (active.name == "password") {
            sendReq({
                "password": active.value,
            }, "https://api.olmmcc.tk/hash_password", (json) => {
                active.value = json.hash;
                createNotification("Successfully hashed password.");
            });
        }
    }
}
document.addEventListener('keyup', onKeyUp, false);
