// Input Element variables
var fName = document.getElementsByName('fName')[0];
var lName = document.getElementsByName('lName')[0];
var email = document.getElementsByName('email')[0];
var pass = document.getElementsByName('pass')[0];
var cfPass = document.getElementsByName('cfPass')[0];
var createAcc = document.getElementById('createAcc');

// Tooltip variables
var tooltips = document.getElementsByClassName("tooltiptext");
var fNameError = document.getElementById('fNameError');
var lNameError = document.getElementById('lNameError');
var emailError = document.getElementById('emailError');
var passwordError = document.getElementById('passwordError');
var cfPasswordError = document.getElementById('cfPasswordError');

// Hide tooltips while typing
fName.addEventListener('focus', hideTooltips());
lName.addEventListener('focus', hideTooltips());
email.addEventListener('focus', hideTooltips);

// Hide tooltips when typing email
email.addEventListener('keyup', function(event) {
    if (event.key == "Enter")
        validateCreateAcc();
    console.log(event.key);
    hideTooltips();
    if (validateEmail(email))
        hideTooltips();
});

// Display tooltip when leaving email if invalid
email.addEventListener('blur', function() {
    if (!validateEmail(email) && email.value.length > 1)
        showTooltip(emailError);
    else
        hideTooltips();
});

// Validate password while typing and after
pass.addEventListener('keyup', function() {
    if (event.key == "Enter")
        validateCreateAcc();
    if (validatePassword(pass))
        hideTooltips();
});
pass.addEventListener('blur', function() {
    if (!validatePassword(pass) && pass.value.length > 1)
        showTooltip(passwordError);
    else
        hideTooltips();
});

// Validate confirmed password while typing and after
cfPass.addEventListener('keyup', function() {
    if (event.key == "Enter")
        validateCreateAcc();
    if (checkInputs(pass, cfPass))
        hideTooltips();
});
cfPass.addEventListener('blur', function() {
    if (!checkInputs(pass, cfPass) && cfPass.value.length > 1)
        showTooltip(cfPasswordError);
    else
        hideTooltips();
});

// Validate all account inputs before submitting
function validateCreateAcc() {
    if (fName.value.length == 0) {
        showTooltip(fNameError);
        return (false);
    }
    else if (lName.value.length == 0) {
        showTooltip(lNameError);
        return (false);
    }
    else if (!validateEmail(email)) {
        showTooltip(emailError);
        return (false);
    }
    else if (!validatePassword(pass)) {
        showTooltip(passwordError);
        return (false);
    }
    else if (!checkInputs(pass, cfPass)) {
        showTooltip(cfPasswordError);
        return (false);
    }
    else {
        createAcc.submit();
        return (true);
    }
}

// Validates confirmation fields by comparing their values
function checkInputs(first, second) {
    if (first.value == second.value && second.value.length > 0 && validatePassword((second))) {
        second.style.backgroundColor = "LightGreen";
        return (true);
    }
    else if (second.value.length >= first.value.length && second.value.length > 0) {
        second.style.backgroundColor = "LightCoral";
    }
    else
        second.style.backgroundColor = "White";
    return (false);
}

// Check for valid .edu email
function validateEmail(email) {
    // Check for valid .edu email
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)(\.edu){1}$/.test(email.value)) {
        email.style.backgroundColor = "LightGreen";
        return (true);
    }
    else if (email.value.length < 1)
        email.style.backgroundColor = "White";
    else
        email.style.backgroundColor = "LightCoral";
    return (false);
}

// Check for valid password (8+ characters with one capital)
function validatePassword(password) {
    var regEx = /^(?=.*[A-Z]).{8,}$/;   // Require 8 characters with one capital letter
    if (regEx.test(password.value)) {
        password.style.backgroundColor = "LightGreen";
        return (true);
    }
    else if (password.value.length < 1) {
        password.style.backgroundColor = "White";
    }
    else
        password.style.backgroundColor = "LightCoral";
    return (false);
}

// Display tooltip on given field (and hide all others)
function showTooltip(field) {
    hideTooltips();
    field.style.visibility = "visible";
    field.style.opacity = "1";
}

// Hide all tooltips
function hideTooltips() {
    for (var i = 0; i < tooltips.length; i++)
        tooltips[i].style.visibility = "hidden";
}


