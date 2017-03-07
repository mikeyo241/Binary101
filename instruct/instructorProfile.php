<?php
session_start();
require ('../functionLib.php');

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
if ($_SESSION['isLogged'] != 'TuIlI' ||
    !$_SESSION['LOGCHECK']) {  // Make sure the user is logged in!!! This is a private page!!
    session_destroy();
    reDir('../main.php');
}



$fName = getFirstName($_SESSION['email']);
$lName = getLastName($_SESSION['email']);

//$classes = checkClass($userName);

if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (!empty($_POST['logOutSubmit'])) {
    session_destroy();
    }
}

echo <<< HTML
<html>
<head>
    <title>$fName $lName</title>

</head>
<body>
<h1>Welcome $fName !!!</h1>
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
    <form id="signOutForm" action="$PHP_SELF" method="post">
  <input type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit">
</form>
</body>
</html>


HTML;
