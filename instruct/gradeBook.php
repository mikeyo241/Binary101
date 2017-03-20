<?php
session_start();
require ('../functionlib.php');

/******************************************************
 ***               Instructor Gradebook                  ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            26 September 2016       ***
 ***    Class:              CPT - 264 - 002         ***
 ***    Document:           profile.php             ***
 ***    CSS:                styles.css, nav.css     ***
 ***    jQuery:             jQuery.js, Alpha.js     ***
 ***                                                ***
 ******************************************************/
if ($_SESSION['isLogged'] != 'TuIlI' || !$_SESSION['LOGCHECK']) {  // Make sure the user is logged in!!! This is a private page!!
    session_destroy();
    reDir('../main.php');
}


/*  Variables  */
$fName = $_SESSION['fName'];
$lName = getLastName($_SESSION['email']);
$email = $_SESSION['email'];
$classCreated = '';
$classesStyle = 'display: block;';
$classID = $_SESSION['classID'];


echo <<< HTML


<html lang="en">
<head>
    
</head>
<body>
<h1> This page Is Still Under Construction $fName!!!! </h1>

<p>Check back later for an awesome grade book page!!!</p>

<h2> The ClassID for the gradebook you are looking for is $classID </h2>
</body>
</html> 

HTML;



