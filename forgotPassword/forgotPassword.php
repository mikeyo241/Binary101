<?php
/******************************************************
 ***              Forgot Password                   ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            21 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***                                                ***
 ******************************************************/
require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
require('../vendor/paragonie/random_compat/psalm-autoload.php');
require_once('../lib/functionlib.php');
$userNotify = 'Enter the email address associated with the account';
// Google USER

// Google PASS: l9wdMxj25oextTM
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['resetSubmit'])) {
        if (!checkEMail($_POST['emailForReset'])) {

            // **  Variables  **
            $email = $_POST['emailForReset'];
            $user = new account($email);
            $resetLink = $user->createTemporaryPassword();
            $fName = $user->getFirstName();
            $lName = $user->getLastName();

            // **  Send Email  **
            $mail = new PHPMailer(); // create a new object
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465; // or 587
            $mail->IsHTML(true);
            $mail->Username = "binary101resetpass@gmail.com";
            $mail->Password = "l9wdMxj25oextTM";
            $mail->SetFrom("binary101resetpass@gmail.com", "Binary 101");
            $mail->Subject = "Binary 101 Reset Info";
            $mail->Body = "Hello ". $fName . " " . $lName . " Here is your temporary password: " . $resetLink ;

            $mail->AddAddress("$email", $fName);


            if(!$mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                echo "Message has been sent";
                $_SESSION['displayAlert'] = "Check Your Email for your Temporary Password.";
                reDir('../main.php');
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
    <link rel="stylesheet" type="text/css" href="forgotPassAssets/styles/forgot.css"/>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css"/>
    <style>
        
   
</style>
       
</head>

<body>
   <header>           
      <a href="../main.php"><img id="logo" src="../assets/img/logo.PNG" alt="Website Logo" align="top-left"></a>
   </header>
   
   <div id="line">
        <!-- simply for aesthetics  -->
   </div>
   
   <section>
   
       <div id="resetPassword">
         
          <h3 id="forgotPassH3">$userNotify</h3>
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
       
       
   </section>
   
   
   <div id="bottomLineFixed">
        <!--   simply for aesthetics   -->
    </div>
   
   <footer id="posFixed">
        <a href="../about.html" style="color: white"> About Us </a>
        | <a href="../privacy.html" style="color: white;"> Privacy Policy </a>
    </footer>
   
   
</body>
</html>


HTML;




