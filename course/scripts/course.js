/**
 * Created by mikey on 2/24/2017.
 */

// Chapter 3 Decimal-to-Binary converter
$(document).ready(function(){
    var $decimalInput = $("#decimalInput");
    $decimalInput.change(function() {
        $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
    });
    $decimalInput.keyup(function() {
        $("#binaryOutput").val(Math.floor(Number($("#decimalInput").val())).toString(2));
    });
});

// Chapter 3 Speed Quiz
// Needs timer functionality and scoring
$(document).ready(function() {
    // Questions come from PHP arrays in chapterQuestions.php
    var currentQuestion = 0;
    $(".quizInput").keyup(function() {
        if ($(this).val() == questionsArray[questionNumbers[currentQuestion]]) {
            $(this).css('background-color', 'LightGreen');
            currentQuestion++;
            if (currentQuestion >= questionsArray.length) { // Quiz over
                $(this).attr("readonly", "true");
                $("#success").show();
                return;
            }
            $("label[for=question]").text(questionNumbers[currentQuestion]);
            $("#question").val("");

            $("#questionNumber").text("Question " + (currentQuestion + 1));

        }
        else if ($(this).val().length >= 4) {
            $(this).css('background-color', 'LightCoral');
            $(this).val("");
        }
        else
            $(this).css('background-color', 'white');
    });
});

// Chapter 4 Binary Bit-Toggler
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