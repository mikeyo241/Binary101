<?php
/******************************************************
 ***              CREATE NEW Password               ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            21 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***                                                ***
******************************************************/
function checkLink($resetLink){

    //      *** Establish a connection to the database  ***
    $link = dbConnect();

    // Make sure that there isn't any password reset keys in the database!
    $qry = "UPDATE ACCOUNT SET ACC_RESET_LINK = NULL , ACC_RESET_EXPIRES= NULL WHERE ACC_RESET_EXPIRES < NOW()";
    mysqli_query($link, $qry);

    $qry2 = "SELECT * FROM ACCOUNT WHERE ACC_RESET_LINK= '$resetLink'";

    //      *** Implement Query's   ***
    if($res = mysqli_query($link, $qry2)){
        if(mysqli_num_rows($res) == 1){
            $data = mysqli_fetch_assoc($res);
            $email = $data['ACC_EMAIL'];
            // There is a matching key in the database!!
            $link->close();
            return $email;
        } else {
            $_SESSION['tokenError'] = 'Password Reset Link is Expired! Please get a new link!!';
            $link->close();
            reDir('forgotPassword.php');
            return false;
        }
    }else {
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}
require('../functionlib.php');         //  The entire function library for the project.

$displayResetPassword = 'none';
$userNotify = 'Enter a new password';
$fName = '';
$lName = '';



if(isset($_GET["tRiD45"]))
{
    $resetLink  = $_GET["tRiD45"];
    if($email = checkLink($resetLink)){
        $displayResetPassword = 'block';
        $user = new account($email);
        $fName = $user->getFirstName();
        $lName = $user->getLastName();
    }
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['resetSubmit'])) {
        if ($_POST['loginPass'] == $_POST['cFPass']) {
            if ($user->changePassword($_POST['loginPass'])) {

                if ($user->getAccountType() == 'INSTRUCTOR') {
                    $_SESSION['user'] = new Instructor($loginEmail);
                    reDir("instruct/instructorProfile.php");
                } else if ($user->getAccountType() == 'STUDENT') {
                    $_SESSION['user'] = new Student($loginEmail);
                    reDir("student/studentProfile.php");
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
    <link rel="stylesheet" type="text/css" href="forgot.css"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <style>
        
   
</style>
        


</head>

<body>
   <header>           
      <img id="logo" src="../img/logo.PNG" alt="Website Logo" align="top-left">
   </header>
   
   
   <div id="resetPassword" $displayResetPassword">
        <h2>Welcome $fName $lName</h2>
        <h3 style="color: black;">$userNotify</h3>
   <form id="resetPasswordForm" action="$PHP_SELF" method="post">
        <table>    
          <tr>
              <td><input placeholder="New Password" type="password" name="pass" id="pass" required> </td>
          </tr>
          <tr>
              <td><input placeholder="Confirm New Password" type="password" name="cFPass" id="cFPass" required> </td>
          </tr>
          
              <td><input type="submit" value="Reset Password" id="resetSubmit" name="resetSubmit" > </td>
          </tr>
        </table>
      </form>
   </div>
   
   
</body>
</html>


HTML;



