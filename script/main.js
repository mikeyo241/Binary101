
    
$(document).ready(function(){
    var $email = $('input[name=email]');
    var $cfEmail = $('input[name=cfEmail]');
    var $pass = $('input[name=pass]');
    var $cfPass = $('input[name=cfPass]');
    $cfEmail.keyup(function () {
        checkInputs($email, $cfEmail);
    });
    $cfPass.keyup(function() {
        checkInputs($pass, $cfPass);
    })

});

// Validates confirmation fields by comparing their values
function checkInputs(first, second) {
    if (first.val() == second.val())
        second.css('backgroundColor', 'LightGreen');
    else if (second.val().length >= first.val().length)
        second.css('backgroundColor', 'LightCoral');
    else
        second.css('backgroundColor', 'white');
}