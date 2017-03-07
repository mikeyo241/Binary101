<?php

require ('functionlib.php');

/******************************************************
***               Instructor Profile                  ***
***                                                ***
***    Created by:         Michael A Gardner       ***
***    Updated:            26 September 2016       ***
***    Class:              CPT - 264 - 002         ***
***    Document:           profile.php             ***
***    CSS:                styles.css, nav.css     ***
***    jQuery:             jQuery.js, Alpha.js     ***
***                                                ***
******************************************************/
if ($_SESSION['islogged'] != 'TuIlI' ||  $_SESSION['LOGCHECK']!= true) {  // Make sure the user is logged in!!! This is a private page!!
    session_destroy();
    reDir('../main.php');
}




$userName = $_SESSION['userName'];
$_SESSION['islogged'];
$_SESSION['LOGCHECK'];
$classes = checkClass($userName);



echo <<< HTML
<html>
<head>
    <title>welcome $name</title>

</head>
<body>
    <div id="classes" name="classes" >
        <table>
            <tr>
                <td>Course</td>
                <td>Section</td>
                <td>Students Enrolled</td>
                <td>Available Seats</td>
                <td>Class Grade Average</td>          
            </tr>
            
        </table>
    </div>
</body>
</html>


HTML;
