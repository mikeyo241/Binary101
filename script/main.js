
$(document).ready(function(){

    var $fName = $('input[name=fName]');
    var $lName = $('input[name=lName]');
    var $email = $('input[name=email]');
    var $pass = $('input[name=pass]');
    var $cfPass = $('input[name=cfPass]');
    var $create = $('#create');

    var $tooltips = $(".tooltiptext");
    var $fNameError = $("#fNameError");
    var $lNameError = $("#lNameError");
    var $emailError = $("#emailError");
    var $passwordError = $("#passwordError");
    var $cfPasswordError = $("#cfPasswordError");

    $fName.focus(function() {
       hideTooltips();
    });
    $lName.focus(function() {
       hideTooltips();
    });
    $email.keyup(function () {
        hideTooltips();
        if (validateEmail($email))
            hideTooltips();
    });
    $email.focus(function() {
        hideTooltips();
    });
    $email.focusout(function() {
        if (!validateEmail($email)) {
            showTooltip($emailError);
        }
        else
            hideTooltips();
    });
    $pass.keyup(function () {
        if (validatePassword($pass))
            hideTooltips();
    });
    $pass.focusout(function() {
        if (!validatePassword($pass))
            showTooltip($passwordError);
        else
            hideTooltips();
    });
    $cfPass.keyup(function () {
        if (validatePassword($cfPass) && checkInputs($pass, $cfPass))
            hideTooltips();
    });
    $cfPass.focusout(function() {
        if (!validatePassword($cfPass) || !checkInputs($pass, $cfPass))
            showTooltip($passwordError);
        else
            hideTooltips();
    });


    $create.click(function() {
        if ($fName.val().length == 0)
            showTooltip($fNameError);
        else if ($lName.val().length == 0)
            showTooltip($lNameError);
        else if (!validateEmail($email))
            showTooltip($emailError);
        else if (!validatePassword($pass))
            showTooltip($passwordError);
        else if (!checkInputs($pass, $cfPass))
            showTooltip($cfPasswordError);
        else {
           $("#createAcc").submit();
        }
    });


    // Validates confirmation fields by comparing their values
    function checkInputs(first, second) {
        if (first.val() == second.val() && second.val().length > 0 && validatePassword((second))) {
            second.css('backgroundColor', 'LightGreen');
            return (true);
        }
        else if (second.val().length >= first.val().length && second.val().length > 0) {
            second.css('backgroundColor', 'LightCoral');
        }
        else
            second.css('backgroundColor', 'white');
        return (false);
    }

    function validateEmail(email) {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)(\.edu){1}$/.test(email.val())) {
            email.css('backgroundColor', 'LightGreen');
            return (true);
        }
        else if (email.val().length < 1) {
            email.css('backgroundColor', 'White');
        }
        else {
            email.css('backgroundColor', 'LightCoral');
        }
        return (false);
    }

    function validatePassword(password) {
        var regEx = /(?=.*[A-Z]){8,20}/;
        if (regEx.test(password.val())) {
            password.css('backgroundColor', 'LightGreen');
            return (true);
        }
        else if (password.val().length < 1) {
            password.css('backgroundColor', 'White');
        }
        else
            password.css('backgroundColor', 'LightCoral');
        return (false);
    }

    function showTooltip(field) {
        hideTooltips();
        field.css("visibility", "visible");
        field.css("opacity", "1");
    }

    function hideTooltips() {
        $tooltips.css("visibility", "hidden");
    }






});

