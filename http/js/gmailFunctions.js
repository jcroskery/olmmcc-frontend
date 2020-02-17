if (window.location.search != "") {
    let formData = new FormData();
    formData.append("code", new RegExp('[?&]code=([^&]*)').exec(location.search)[1]);
    formData.append("session", window.localStorage.getItem("session"));
    sendReq(formData, "https://api.olmmcc.tk/send_gmail_code", (_) => {
        window.location.search = "";
    })
} else {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    sendReq(formData, "https://api.olmmcc.tk/is_gmail_working", (json) => {
        if (json.working == false) {
            window.location = "/admin/email/auth";
        }
    });
}
document.getElementById("send").addEventListener("click", () => {
    let formData = new FormData();
    formData.append("session", window.localStorage.getItem("session"));
    let recipients = document.querySelector('input[name = "recipients"]:checked').value;
    if (recipients == "specified") {
        formData.append("recipient", document.getElementById("recipient").value);
    }
    formData.append("recipients", recipients);
    formData.append("subject", document.getElementById("subject").value);
    formData.append("body", document.getElementById("body").value);
    sendReq(formData, "https://api.olmmcc.tk/send_email", (json) => {
        if (json.success == true) {
            createNotification("Successfully sent this email!");
        } else {
            createNotification("Something went wrong. Please try again.")
        }
    });
})

function unhide_recipient() {
    document.getElementById("recipient_label").hidden = false;
    document.getElementById("recipient").hidden = false;
    document.getElementById("recipient_br").hidden = false;
}
document.getElementById("specified").addEventListener("click", () => {
    unhide_recipient();
})
document.getElementById("all_users").addEventListener("click", () => {
    document.getElementById("recipient_label").hidden = true;
    document.getElementById("recipient").hidden = true;
    document.getElementById("recipient_br").hidden = true;
})
if (document.getElementById("specified").checked) {
    unhide_recipient();
}
