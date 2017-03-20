<?php
session_start();
require ('../functionlib.php');
/******************************************************
***               Private Profile                  ***
***                                                ***
***    Created by:         Michael A Gardner       ***
***    Updated:            7 March 2017            ***
***    Class:              CPT - 264-002           ***
***    Document:           studentProfile.php      ***
***    CSS:                styles.css              ***
***    jQuery:             None                    ***
***                                                ***
******************************************************/
if ($_SESSION['isLogged'] != 'TuIlI' ||
    !$_SESSION['LOGCHECK']) {  // Make sure the user is logged in!!! This is a private page!!
    session_destroy();
    reDir('../main.php');
}
$fName = getFirstName($_SESSION['email']);
$lName = getLastName($_SESSION['email']);
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (!empty($_POST['logOutSubmit'])) {
        session_destroy();
        reDir('../main.php');
    }
}


echo <<< HTML
<html>
<head>
    <title>$fName $lName</title>

</head>
<body>
<h1>Welcome $fName !!!</h1>
  <form id="signOutForm" action="$PHP_SELF" method="post">
  <input type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit">
</form>
</body>
</html>

HTML;

