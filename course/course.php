<?php
require('../lib/functionlib.php');

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
echo $_GET['CLS_ID'];
$_SESSION['CLS_ID'] = $_GET['CLS_ID'];
$CLS_ID = $_SESSION['CLS_ID'];

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

</body>

</html>
HTML;


