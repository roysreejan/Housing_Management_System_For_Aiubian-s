function get(id) {
    return document.getElementById(id);;
}

function verifyUser(t, uid) {
    var xhr = new XMLHttpRequest();

    xhr.open("GET", "controller/VerifyUser.php?t=" + t + "&uid=" + uid, true);
    debugger;
    xhr.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText === '1') {
                location.reload();
            }
        }
    };

    xhr.send();
}