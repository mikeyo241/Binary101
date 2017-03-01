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
    <script src="scripts/course.js" type="text/javascript"></script>

</head>

<body>

HTML;
// The Courses will be populated by a function in the function library!!!!
// You can change the function below to look at each chapter that I have created thus far.
// You can view the code in the functionlib.php file!!
// Current Functions:
chap1();
//chap4();     // Just remove the comment and then comment out the current to view the chapter!!

echo <<< HTML
</body>

</html>
HTML;


