<?php
/******************************************************
 ***          Login/Create Account Page             ***
 ***                                                ***
 ***    Created by:         Group 6                 ***
 ***    Updated:            17 March 2017            ***
 ***    Class:              CPT - 264-002           ***
 ***    Document:           index.php               ***
 ***    CSS:                course.css              ***
 ***    jQuery:             course.js               ***
 ***                                                ***
 ******************************************************/
/*
 * Programmer:       Nathaniel Merck
 * Title:            login/sign-up page for Group Website Project
 * Date:             3/30/2017
 */

/* Michael A Gardner    -   login System    -   2 March 2017        */
require('vendor/paragonie/random_compat/psalm-autoload.php');
require('lib/functionlib.php');         //  The entire function library for the project.
//session_start();                    // Start a session with the server.

if(isset($_SESSION['displayAlert']))  $displayAlert = $_SESSION['displayAlert']; //  Variable used to tell the user what is going on if a account creation fails.
else $displayAlert = '';

/* This will check if the user is already logged in and redirect them back to their profiles from the home page  */
if(isset($_SESSION['isLogged']) && isset($_SESSION['LOGCHECK']) && isset($_SESSION['email']) && isset($_SESSION['fName']) ){
    if($_SESSION['accType'] == 'INSTRUCTOR')reDir("instruct/instructorProfile.php");
    if($_SESSION['accType'] == 'STUDENT') reDir("student/studentProfile.php");
}

/* If the request method is POST then execute the following */

if ($_SERVER['REQUEST_METHOD']=='POST') {


    if (!empty($_POST['fName']) && !empty($_POST['lName']) && !empty($_POST['email'])
        && !empty($_POST['pass']) && !empty($_POST['cfPass']) && !empty($_POST['selectItBABY'])) {
        // If there is post data from the create account form.
        $fName = cleanIt($_POST['fName']);           // Student or instructor's first Name
        $lName = cleanIt($_POST['lName']);           // Last Name
        $email = cleanIt($_POST['email']);           // Email address
        $pass = cleanIt($_POST['pass']);             // The user's Password
        $cfPass = cleanIt($_POST['cfPass']);         // Confirm password field
        $accType = cleanIt($_POST['selectItBABY']);  // Instructor or Student account type


        if (createAccount($fName,$lName,$email,$pass,$accType)) {
            // If the create account function returns true which means the account was created in the database!! so execute the following:

            $displayAlert = 'Account Created!';     // Alert the User.
            $_SESSION['isLogged'] = 'TuIlI';        // TuIlI = "The user Is logged In"
            $_SESSION['LOGCHECK'] = true;           // This must be true for the user to be logged in.
            $_SESSION['email'] = $email;            // Email Variable
            $_SESSION['fName'] = $fName;            // The user's first name
            $_SESSION['lName'] = $lName;            // The user's last name
            $_SESSION['accType'] = $accType;        // The user's account type MUST BE 'INSTRUCTOR' OR 'STUDENT'
            if($accType == 'INSTRUCTOR') {
                $_SESSION['user'] = new Instructor($email, $fName, $lName);
                reDir("instruct/instructorProfile.php");
            }
            else if($accType == 'STUDENT') {
                $_SESSION['user'] = new Student($email, $fName, $lName);
                reDir("student/studentProfile.php");
            }

        } else {
            // Create account returned false!  The account most likely exists already however, due to exploit
            // concerns we will just say the following:
            $displayAlert = "Account couldn't be Created";
        }
    }
    if (isset($_POST['loginSubmit'])) {         // If the the login form submit button has been pressed
        $loginEmail = cleanIt($_POST['loginEmail']);        // remove exploits from Login Email address
        $lPass = cleanIt($_POST['loginPass']);              // remove exploits from Login password

        if(checkLogin($loginEmail, $lPass) == 'normalLogin') {
            $displayAlert = "Login Success";
            $_SESSION['isLogged'] = 'TuIlI';     // TuIlI = "The user Is logged In"
            $_SESSION['LOGCHECK'] = true;       // extra login check this must be set to true for the user to be logged in.
            $user = new Account($loginEmail);

            if ($user->getAccountType() == 'INSTRUCTOR') {
                $_SESSION['user'] = new Instructor($loginEmail);
                reDir("instruct/instructorProfile.php");
            } else if ($user->getAccountType() == 'STUDENT') {
                $_SESSION['user'] = new Student($loginEmail);
                reDir("student/studentProfile.php");
            }
        }else if(checkLogin($loginEmail, $lPass) == 'tempPassUsed'){
            $_SESSION['isLogged'] = 'TuIlI';     // TuIlI = "The user Is logged In"
            $_SESSION['LOGCHECK'] = true;       // extra login check this must be set to true for the user to be logged in.
            $account = new Account($loginEmail);
            $_SESSION['account'] = $account;
            reDir("forgotPassword/CNP56r.php");

        } else {
            // If the login fails then make sure the user can't go to secured pages
            $_SESSION['isLogged'] = false;
            $_SESSION['LOGCHECK'] = false;
            $displayAlert = "Login Fail";
        }
    }
}
/*  End Login System  */



echo <<< HTML
<html lang="en">
<head>
    <title>Binary 101</title>
    <meta name="author" content="Group 6" />
    <meta name="owner" content="Michael Gardner, Nathaniel Merck, Christian Cook, Cory Wilson" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- All Links, Meta data, scripts, and css goes inside the <head> tags.  -->
<!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
        


</head>

<body>
   <header>           
      <a href="index.php"><img id="logo" src="assets/img/logo.PNG" alt="Website Logo" align="top-left"></a>
            
      <form id="loginForm" action="$PHP_SELF" method="post">
        <table>
          <tr>
              <td><span>E-Mail:</span> </td><td><input type="email" name="loginEmail" id="loginEmail" required>  </td>
          </tr>
          <tr>
              <td><span>Password:</span></td><td> <input type="password" name="loginPass" id="loginPass" required> </td>
          </tr>
          <tr> 
              <a id="forgotPass" href="forgotPassword/forgotPassword.php">Forgot Password</a>
              <input type="submit" value="Log In" id="loginSubmit" name="loginSubmit" > 
          </tr>
        </table>
      </form>
      <!--      nevermind this idea~
      <img id="backPic" src="assets/img/backgroundWallpaper.jpg" align="top">
      -->
   </header>
      <div id="line">
            <!-- simply for aesthetics  -->
      </div>
      
    <section id="mainSection">
          
        <div id="createAccForm">
        <form action="$PHP_SELF" name="createAcc" id="createAcc" method="post">
        
          <h2 id="createAccTitle"> Create a New Account </h2>
                  
            <table id="table">
            <tr>
                <td>
                    <div class="tooltip" id="fNameTooltip">
                        <span class="tooltiptext" id="fNameError">Please enter your first name.</span> </div>
                        <input type="text" name="fName" placeholder="First name" > 
                    
                </td>
                    
                <td>
                    <div class="tooltip" id="lNameTooltip">
                        <span class="tooltiptext" id="lNameError">Please enter your last name.</span></div>
                        <input type="text" name="lName" placeholder="Last name" >  
                  
                </td>
            </tr>       
            <tr>
                <td colspan="2">
                    <div class="tooltip" id="emailTooltip"><span class="tooltiptext" id="emailError">Please enter a valid .edu email address.</span></div>
                    <input type="email" name="email" placeholder="Email">
                </td> 
            </tr>
            <tr> 
                <td>
                    <div class="tooltip" id="passwordTooltip">
                        <span class="tooltiptext" id="passwordError">Password must be 8 characters long and contain at least 1 uppercase character.</span></div>
                        <input type="password" id="pass" name="pass" placeholder="Password" > 
                  
                </td> 
                 
                <td>
                    <div class="tooltip" id="cfPasswordTooltip">
                        <span class="tooltiptext" id="cfPasswordError">Passwords don't match.</span></div>
                        <input type="password" ="cfPass" name="cfPass" placeholder="Confirm Password" >                    
                
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <select required name="selectItBABY" id="selectItBABY">
                        <option value="STUDENT" selected >Student</option>
                        <option value="INSTRUCTOR">Instructor</option>  
                    </select>
                </td>
            </tr>
            
            <tr> <td colspan="3"> <input type="button" onclick="validateCreateAcc()" value="Create Account" id="create" name="create" > </td> </tr>
    
            </table>
        </form>
        </div>
        
        <div id=" alertMessage">
            <h2 style="
    font-size: 44px;
    font-family: Andale Mono, monospace;
    margin-bottom: 35px;     text-align: center;
    margin-top: 123px;
    color: red; ">$displayAlert</h2>
        </div>
        
        
    </section>
    
    <div id="bottomLine">
        <!--   simply for aesthetics   -->
    </div>

    <footer>
        <a href="about.html" style="color: white"> About Us </a>
        | <a href="privacy.html" style="color: white;"> Privacy Policy </a>
    </footer>


</body>

<!-- JavaScript -->
    <script src="assets/script/main.js" type="text/javascript"></script>
</html>

HTML;

