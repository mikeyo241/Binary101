/**
 * Created by mikey on 2/24/2017.
 */



$(document).ready(function(){
    $("#convert").click(function() {
        $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
    });
    $("#decimalInput").change(function() {
        $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
    });
    $("#decimalInput").keyup(function() {
        $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
    });
});


$(document).ready(function(){
    var outputInt = 0;
    $(".binaryButton").click(function() {
        if($(this).val() == "0") {
            $(this).val("1");
            outputInt += Number($(this).attr('id'));
        }
        else {
            $(this).val("0");
            outputInt -= Number($(this).attr('id'));
        }
        $("#decimalOutput").val(outputInt);

    });
});