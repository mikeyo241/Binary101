<?php
require('../functionlib.php');

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
    <h1>Powers of 2</h1>
    <p>Before we get into powers of 2 (or the base 2 number system)
     we must first understand the number system we use: base 10. Take the number 125 for example:
    </p>
    <img src="../img/powersOf2.PNG">
    <p>As you can see, the numbers we use in our day-to-day lives are constructed using powers of 10.
     Numbers in the 1's column are multiplied by 100 (1). Numbers in the 10's column are multiplied by 101 (10).
      Numbers in the 100's column are multiplied by 102 (100). This process is repeated to create larger numbers,
       with the sum of all columns representing the final number.
    <br>
    Binary (a base 2 number system) works in a similar fashion, but rather than multiply each number by powers of 10,
     you multiply by powers of two. Let's look at the number 13 represented in binary:
    </p>
    <img src="../img/powersOf2_2.PNG">
    <p>Since we're only working with powers of 2, we only need two numbers to represent each column: 
    a 0 or a 1. This on-off relationship (a binary relationship if you will) is the fundamental principle 
    of computer technology. Columns are multiplied by 20, 21, 22, 23, and so on. These "powers of 2" values 
    show up everywhere in computer technology, which is why it's paramount to understand them. Here's a graphical 
    representation of each column's possible value in a full byte (8 bits, or 8 columns):
    </p>
    <img src="../img/powersOf2_3.PNG">
    <h2>GAME - Quiz HERE!!! </h2>
</body>

</html>
HTML;

