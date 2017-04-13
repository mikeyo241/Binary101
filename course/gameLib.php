<?php

/**
 * Game library crated by Cory Wilson
 * April 13, 2017
 */


function chap3Game() {
    echo <<< HTML
    <form>
                <p id="questionNumber">Question 1</p>
                <label for="question" id="questionLabel"></label><br>
                <input type="text" id="question" class="quizInput" /><br>
                <p id="success" hidden>You did it!</p>
    </form>
HTML;
}


?>