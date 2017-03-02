<?php
require ('../functionlib.php');

/******************************************************
 ***               Private Profile                  ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            26 September 2016       ***
 ***    Class:              CPT - 283-001           ***
 ***    Document:           profile.php             ***
 ***    CSS:                styles.css, nav.css     ***
 ***    jQuery:             jQuery.js, Alpha.js     ***
 ***                                                ***
 ******************************************************/

$chapter = 'chap2';
//checkUser();


echo <<< HTML

<html lang="en">
<head>
    <meta name="author" content="Michael Gardner" />
    <meta name="owner" content="Group 6" />
    <meta name="description" content="Learn how Binary works!">
    <meta name="keywords" content="Binary, Hex, Introduction to Computer Science">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    
    <!--  ** CSS  ** -->
    <link type="text/css" href="css/course.css" rel="stylesheet" />


    <!--  ** Java ** -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="scripts/course.js" type="text/javascript"></script>

</head>

<body>
<!-- Everything below this point will be imputed with a function in the function library!! This is a temporary page 
   - so that we can create a good css template.  
   -->
     <h1>Understanding Binary</h1>
    <p>Binary or base 2 is like our regular base 10 numbering system but instead using 1-10 it uses 0-1.
     As an example, counting in binary looks like this:
     <br> 0000 = 0 <br> 0001 = 1 <br> 0010 = 2 <br> 0011 = 3 <br> 0100 = 4 <br> 0101 = 5 <br> 0110 = 6 <br>
    </p>
    <h2>How is this accomplished?</h2>
    <img src="../img/binToDecimalConversion.PNG">
    <p>The binary number 0111 is converted to decimal or base 10 by taking the values of each bit and adding
     them together to get the decimal number the nibble represents. <br> This can be explained further by the video below
     from techquickie. 
    </p>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/LpuPe81bc2w?rel=0&amp;controls=0&amp;showinfo=0;end=235" frameborder="0" allowfullscreen></iframe>
    <p>Flip the switches to see how turning on and off bits in the nibble changes the number.</p>
<!-- Flip the switches game by Cory Wilson!!!  -->
    <form>
      Flip the switches:<br>
      <input type="button" id="8" class="binaryButton" value="0" />
      <input type="button" id="4" class="binaryButton" value="0" />
      <input type="button" id="2" class="binaryButton" value="0" />
      <input type="button" id="1" class="binaryButton" value="0" /><br>
      Decimal Output:<br>
      <input type="text" id="decimalOutput" value="0" readonly="true">
      
   </form> 
<!-- End of Flip the Switches Game -->

    <br>
    <p>It is important to learn how to quickly calculate nibbles of binary quickly because nibbles will be used more in later chapters and later in your career.

<br>
<h2>Useful Definitions</h2>
<b>Bit</b> - a single digit of binary notation, represented either by 0 or by 1
<br>
<b>Nibble</b> - 4 bits  that can equal 0-16
<br>
<b>Byte</b> - 8 bits  0000 0000 can equal 0- 255
</p>

<h2>Try it yourself!</h2>
<h3 style="color: red;">QUIZ GAME HERE!!!</h3>
<p style="color: red">
This part should be 5 questions like What is 0010 in Decimal, 1111 in Decimal, 1001 in Decimal, 1100 in Decimal, 0011 in Decimal.
</p>
</body>

</html>

HTML;

