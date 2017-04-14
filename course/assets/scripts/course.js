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
    var questionsArray = {
        "0": "0000", "1": "0001", "2": "0010",
        "3": "0011", "4": "0100", "5": "0101", "6": "0110", "7": "0111",
        "8": "1000", "9": "1001", "10": "1010", "11": "1011", "12": "1100",
        "13": "1101", "14": "1110", "15": "1111"
    };
    var questionNumbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
    questionNumbers = shuffleArray(questionNumbers);
    var currentQuestion = 0;
    $("label[for=question]").text(questionNumbers[currentQuestion]);

    $(".quizInput").keyup(function() {
        if ($(this).val() === questionsArray[questionNumbers[currentQuestion]]) {
            $(this).css('background-color', 'LightGreen');
            currentQuestion++;
            if (currentQuestion >= questionNumbers.length) { // Quiz over
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

/**
 * Randomize array element order in-place.
 * Using Durstenfeld shuffle algorithm.
 */
function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}