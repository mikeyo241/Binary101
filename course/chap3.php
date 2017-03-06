<?php
    require("../contents.php");
    require('chapterQuestions.php');
?>

<html>
    <head>
        <meta name="title" content="Chapter 3" /> <!-- In the future "Chapter 3" will be a variable!!!!  -->
        <meta name="author" content="Michael Gardner" />
        <meta name="owner" content="Group 6" />
        <meta name="description" content="Learn how Binary works!">
        <meta name="keywords" content="Binary, Hex, Introduction to Computer Science">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="scripts/course.js" type="text/javascript"></script>

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/course.css"/>
    </head>

    <div id="rightSideDiv">

        <h2 id="title">Chapter 3</h2>

        <div id="content">
            <h1>Decimal to Binary Conversion</h1>

            <p> Converting Decimal or base 10 to Binary could be a very hard task especially using the wrong method.  One of the
                easiest ways of conversion is to using the powers of 2 discussed in the previous chapter.
                First we are going to convert 9<sub>10</sub> to binary.
            </p>
            <img src="../img/decimalToBinary1.PNG" >
            <h2>Check out this video from Khan Academy on how to convert Decimal numbers to Binary</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/H4BstqvgBow?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
            <h2>Input any number here to see the binary number it produces</h2>

            <!-- Game Created by Cory Wilson!!! -->
            <form>
                Enter an integer:<br>
                <input type="number" step="1" min="0" value="12" id="decimalInput" />
                <input type="button" id="convert" value="Convert" /><br>
                Binary Output:<br>
                <input type="text" id="binaryOutput" value="1100" readonly="true">

            </form>
            <!--  End of Game Created by Cory Wilson  -->


            <p>Little number conversion game here!</p><br>
            <img src="../img/decimalToBinary2.PNG">
            <h2>Check out Khan Academy's explanation on how to convert bigger numbers to Binary</h2>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/bvcXEJbEzSs?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
            <h2>Think you understand? Try it yourself!!!</h2>


            <form>
                <p id="questionNumber">Question 1</p>
                <label for="question"><?php echo $questionNumbers[0]; ?></label><br>
                <input type="text" id="question" class="quizInput" /><br>
                <p id="success" hidden>You did it!</p>
            </form>

        </div>
    </div>

</html>