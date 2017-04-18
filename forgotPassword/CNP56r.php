<?php
/******************************************************
 ***              CREATE NEW Password               ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            21 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***                                                ***
******************************************************/
require('../vendor/paragonie/random_compat/psalm-autoload.php');
require('../lib/functionlib.php');         //  The entire function library for the project.
checkIfLoggedIn();

$userNotify = 'Create a new password for your account';
$account = $_SESSION['account'];
$fName = $account->getFirstName();
$lName = $account->getLastName();
$email = $account->getEmail();



if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['resetSubmit'])) {
        if ($_POST['pass'] == $_POST['cFPass']) {
            if ($account->changePassword($_POST['pass'])) {

                if ($account->getAccountType() == 'INSTRUCTOR') {
                    $_SESSION['user'] = new Instructor($email);
                    reDir("../instruct/instructorProfile.php");
                } else if ($account->getAccountType() == 'STUDENT') {
                    $_SESSION['user'] = new Student($email);
                    reDir("../student/studentProfile.php");
                } else echo "Wrong Account TYPE!!! ERROR!!!";
            }
        } $userNotify = "Passwords must match!";

    }
}


echo <<< HTML
<html lang="en">
<head>
    <title>Binary 101</title>
    <meta name="author" content="Group 6" />
    <meta name="owner" content="Michael Gardner, Nathaniel Merck, Christian Cook, Cory Wilson" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="forgotPassAssets/styles/forgot.css"/>
    <style>
        
   
</style>
        


</head>

<body>
   <header>           
      <img id="logo" src="../assets/img/logo.PNG" alt="Website Logo" align="top-left">
   </header>

   
   <div id="resetPassword">
        <h2 style="color: white; font-family: monospace">Welcome $fName $lName</h2>
        <h3 style="color: white; font-family: monospace">$userNotify</h3>
   <form id="resetPasswordForm" action="$PHP_SELF" method="post">
        <table>    
          <tr>
              <td><input placeholder=" New Password" type="password" name="pass" id="pass" required> </td>
          </tr>
          <tr>
              <td><input placeholder=" Confirm New Password" type="password" name="cFPass" id="cFPass" required> </td>
          </tr>
          
              <td><input type="submit" value="Reset Password" id="resetSubmit" name="resetSubmit" style="width: 115px"> </td>
          </tr>
        </table>
      </form>
   </div>
   

</body>
</html>


HTML;



