function get(id) {
    return document.getElementById(id)
}

/**
 * Registratoin
 */

var hasError = false;

// inputs
// var registration = get('registration');
var regName = get('reg-name');
var regEmail = get('reg-email');
var regPhoneNumber = get('reg-phone-number');
var regPassword = get('reg-password');
var regConfirmPassword = get('reg-confirm-password');
// var regStudent = get('student');
// var regFlatOwner = get('flat-owner');
var regAiubIdNid = get('reg-aiub-id_nid');

// errors
var regErrName = get("js-error-name");
var regErrEmail = get("js-error-email");
var regErrPhoneNumber = get("js-error-phone-number");
var regErrPassword = get("js-error-password");
var regErrConfirmPassword = get("js-error-confirm-password");
var regErrType = get("js-error-type");
var regErrAiubIdNid = get("js-error-aiubid_nid");


function refreshRegistration() {
    hasError = false;
    regErrName.innerHTML = "";
    regErrEmail.innerHTML = "";
    regErrPhoneNumber.innerHTML = "";
    regErrPassword.innerHTML = "";
    regErrConfirmPassword.innerHTML = "";
    regErrType.innerHTML = "";
    regErrAiubIdNid.innerHTML = "";
}

function refreshLogin() {
    hasError = false;
    regErrEmail.innerHTML = "";
    regErrPassword.innerHTML = "";
    regErrType.innerHTML = "";
}

function validateGender() {
    var gn = document.getElementsByName("type");
    for (var i = 0; i < gn.length; i++) {
        if (gn[i].checked) {
            return true;
        }
    }
    return false;
}

function registrationValidation() {
    refreshRegistration();

    // name
    if (regName.value.length === 0) {
        hasError = true;
        regErrName.innerHTML = "*Name Required";
    } else if (regName.value.length <= 2) {
        hasError = true;
        regErrName.innerHTML = "*Name must be greater than 2 characters";
    }

    // email
    if (regEmail.value.length === 0) {
        hasError = true;
        regErrEmail.innerHTML = "*Email Required";
    } else if (!regEmail.value.includes("@") || !regEmail.value.includes(".")) {
        hasError = true;
        regErrEmail.innerHTML = "*Email must contain @ character and . character";
    }

    // phone number
    if (regPhoneNumber.value.length === 0) {
        hasError = true;
        regErrPhoneNumber.innerHTML = "*Phone number Required";
    } else if (isNaN(regPhoneNumber.value)) {
        hasError = true;
        regErrPhoneNumber.innerHTML = "*Phone number contain number";
    } else if (regPhoneNumber.value.length !== 11) {
        hasError = true;
        regErrPhoneNumber.innerHTML = "*Phone number must contain at least 11 number";
    }

    // password
    if (regPassword.value.length === 0) {
        hasError = true;
        regErrPassword.innerHTML = "*Password Required";
    } else if (regPassword.value.length <= 7) {
        hasError = true;
        regErrPassword.innerHTML = "*Password must contain at least 8 character";
    } else if (!regPassword.value.includes('#') && !regPassword.value.includes('?')) {
        hasError = true;
        regErrPassword.innerHTML = "*Password must contain # character or one ? character";
    } else {
        var upper = 0;
        var lower = 0;
        var number = 0;
        var arr = regPassword.value.split('');

        for (var i = 0; i < arr.length; i++) {
            if (65 <= arr[i].charCodeAt(0) && 90 >= arr[i].charCodeAt(0))
                upper++;
            else if (97 <= arr[i].charCodeAt(0) && 122 >= arr[i].charCodeAt(0))
                lower++;
            else if (48 <= arr[i].charCodeAt(0) && 57 >= arr[i].charCodeAt(0))
                number++;
        }

        if (!(upper >= 1 && lower >= 1 && number >= 1)) {
            hasError = true;
            regErrPassword.innerHTML = "*Password must contain 1 number and combination of uppercase and lowercase alphabet";
        }
    }

    // confirm password
    if (regConfirmPassword.value.length === 0) {
        hasError = true;
        regErrConfirmPassword.innerHTML = "*Confirm Password Required";
    } else if (regPassword.value !== regConfirmPassword.value) {
        hasError = true;
        regErrConfirmPassword.innerHTML = "*Password and Confirm Password not match";
    }

    // gender
    if (!validateGender()) {
        hasError = true;
        regErrType.innerHTML = "*User type Required";
    }

    // aiub id or nid
    if (regAiubIdNid.value.length === 0) {
        hasError = true;
        regErrAiubIdNid.innerHTML = "*AIUB ID / National ID number Required";
    } else if (isNaN(regAiubIdNid.value)) {
        hasError = true;
        regErrAiubIdNid.innerHTML = "*AIUB ID / National ID number must contain number";
    }

    return !hasError;
}


/**
 * Login
 */

// inputs
var loginEmail = get('login-email');
var loginPassword = get('login-password');

// errors
var loginErrEmail = get("js-error-email");
var loginErrPassword = get("js-error-password");
var loginErrType = get("js-error-type");

function loginValidation() {
    refreshLogin();

    // email
    if (loginEmail.value.length === 0) {
        hasError = true;
        loginErrEmail.innerHTML = "*Email Required";
    } else if (!loginEmail.value.includes("@") || !loginEmail.value.includes(".")) {
        hasError = true;
        loginErrEmail.innerHTML = "*Email must contain @ character and . character";
    }

    // password
    if (loginPassword.value.length === 0) {
        hasError = true;
        loginErrPassword.innerHTML = "*Password Required";
    } else if (loginPassword.value.length <= 7) {
        hasError = true;
        loginErrPassword.innerHTML = "*Password must contain at least 8 character";
    } else if (!loginPassword.value.includes('#') && !loginPassword.value.includes('?')) {
        hasError = true;
        loginErrPassword.innerHTML = "*Password must contain # character or one ? character";
    } else {
        var upper = 0;
        var lower = 0;
        var number = 0;
        var arr = loginPassword.value.split('');

        for (var i = 0; i < arr.length; i++) {
            if (65 <= arr[i].charCodeAt(0) && 90 >= arr[i].charCodeAt(0))
                upper++;
            else if (97 <= arr[i].charCodeAt(0) && 122 >= arr[i].charCodeAt(0))
                lower++;
            else if (48 <= arr[i].charCodeAt(0) && 57 >= arr[i].charCodeAt(0))
                number++;
        }

        if (!(upper >= 1 && lower >= 1 && number >= 1)) {
            hasError = true;
            loginErrPassword.innerHTML = "*Password must contain 1 number and combination of uppercase and lowercase alphabet";
        }
    }

    // gender
    if (!validateGender()) {
        hasError = true;
        loginErrType.innerHTML = "*User type Required";
    }

    return !hasError;
}

function confirmDelete() {
    return confirm("Are you sure you want to delete?");
}