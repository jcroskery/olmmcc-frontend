function onKeyUp(e) {
    if(e.ctrlKey && e.altKey && e.keyCode == 72) {
        let active = document.activeElement;
        if (active.name == "password") {
            sendReq({
                "password": active.value,
            }, "https://api.olmmcc.tk/hash_password", (json) => {
                if (json.hash) {
                    active.value = json.hash;
                    createNotification("Successfully hashed password.");
                } else if (json.message) {
                    createNotification(json.message);
                }
            });
        }
    }
}
document.addEventListener('keyup', onKeyUp, false);
