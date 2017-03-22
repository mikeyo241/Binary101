<?php
/******************************************************
 ***              Forgot Password                   ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            21 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***                                                ***
 ******************************************************/
require_once('../functionlib.php');
require_once ('../PHPMailer/PHPMailer-master/PHPMailerAutoload.php');
$userNotify = 'Enter the email address associated with the account';
// Google USER

// Google PASS: l9wdMxj25oextTM
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['resetSubmit'])) {
        if (!checkEMail($_POST['emailForReset'])) {
            $user = new account($_POST['emailForReset']);
            $fName = $user->getFirstName();
            $lName = $user->getLastName();
            $email = $_POST['emailForReset'];
            $mail = new PHPMailer;
            $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "binary101resetpass@gmail.com";
            $mail->Password = "l9wdMxj25oextTM";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->From = "binary101resetpass@gmail.com";
            $mail->FromName = "Binary 101";
            $mail->addAddress("$email", "$fName $lName");
            $mail->isHTML(true);
            $resetLink = $user->createResetLink();
            $mail->Subject = "Password Reset Link";
            $mail->Body = "<a href='$resetLink'>Reset Your Password!!</a>'";

            if (!$mail->send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {   //   Message has been sent successfully
                $userNotify = "Check your Email for a link: $email";
            }
        }

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
   
   
   <div id="resetPassword" ">
     
        <h3 style="color: black;">$userNotify</h3>
   <form id="resetPasswordForm" action="$PHP_SELF" method="post">
        <table>    
          <tr>
              <td><input placeholder="Email Address" type="email" name="emailForReset" id="emailForReset" required> </td>
          </tr>          
              <td><input type="submit" value="Send Email" id="resetSubmit" name="resetSubmit" > </td>
          </tr>
        </table>
      </form>
   </div>
   
   
</body>
</html>


HTML;




