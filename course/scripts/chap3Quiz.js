/**
 * Created by coryw on 3/2/2017.
 */

$(document).ready(function() {
    var currentQuestion = 0;
    var quizzing = true;
});

function createQuiz(questionsArray) {
    var quizLength = questionsArray.length;
    var questionNumbers = new Array(quizLength);
    for (i = 0; i < quizLength; i++)
        questionNumbers[i] = i;
    shuffle(questionNumbers);
    console.log(questionNumbers[1]);
}

function shuffle(array) {
    var counter = array.length;
    while (counter > 0) {
        var index = Math.floor(Math.random() * counter);
        counter--;
        var temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
    }
    return array;
}

