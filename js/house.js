function get(id) {
    return document.getElementById(id)
	
}
var hasError = false;
var hName = get('h-name');
var hAddress = get('h-address');
var hPrice = get('h-price');

var hErrName = get("js-error-name");
var hErrAddress = get("js-error-address");
var hErrPrice = get("js-error-price");

function refreshAddhouse() {
    hasError = false;
    hErrName.innerHTML = "";
    hErrAddress.innerHTML = "";
    hErrStatus.innerHTML = "";
    hErrPrice.innerHTML = "";
}
function validateStatus() {
    var st = document.getElementsByName("status");
    for (var i = 0; i < st.length; i++) {
        if (st[i].checked) {
            return true;
        }
    }
    return false;
}

function addhouseValidation() {
    refreshAddhouse();

    // name
    if (hName.value.length === 0) {
        hasError = true;
        hErrName.innerHTML = "*Name Required";
    } else if (hName.value.length <= 2) {
        hasError = true;
        hErrName.innerHTML = "*Name must be greater than 2 characters";
    }
	 // address
	if (hAddress.value.length === 0) {
        hasError = true;
        hErrAddress.innerHTML = "*Address Required";
    }
    // status
    if (!validateStatus()) {
        hasError = true;
        hErrStatus.innerHTML = "*Status Required";
    }
	// price
	if (hPrice.value.length === 0) {
        hasError = true;
        hErrPrice.innerHTML = "*Price Required";
    }
    

    return !hasError;
}