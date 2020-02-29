if (window.location.search != "") {
    sendReq({
        "code": new RegExp('[?&]code=([^&]*)').exec(location.search)[1]
    }, "https://api.olmmcc.tk/send_gmail_code", (_) => {
        window.location.search = "";
    })
} else {
    sendReq({}, "https://api.olmmcc.tk/is_gmail_working", (json) => {
        if (json.working == false) {
            window.location = "/admin/email/auth";
        }
    });
}
document.getElementById("send").addEventListener("click", () => {
    let data = {
        "subject": document.getElementById("subject").value,
        "body": document.getElementById("body").value.replace(/([^\r]\n)/g, "\r\n")
    };
    let recipients = document.querySelector('input[name = "recipients"]:checked').value;
    if (recipients == "specified") {
        data.recipient = document.getElementById("recipient").value;
    }
    data.recipients = recipients;
    sendReq(data, "https://api.olmmcc.tk/send_email", (json) => {
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
