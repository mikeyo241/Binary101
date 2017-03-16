<?php
                /******************************************************
                ***          Login/Create Account Page             ***
                ***                                                ***
                ***    Created by:         Group 6                 ***
                ***    Updated:            2 March 2017            ***
                ***    Class:              CPT - 264-002           ***
                ***    Document:           index.php               ***
                ***    CSS:                course.css              ***
                ***    jQuery:             course.js               ***
                ***                                                ***
                ******************************************************/
/*
 * Programmer:       Nathaniel Merck
 * Title:            login/sign-up page for Group Website Project
 * Date:             3/4/2017
 */

/* Michael A Gardner    -   login System    -   2 March 2017        */
session_start();
require('functionLib.php');
$displayAlert = '';

if(isset($_SESSION['islogged']) && isset($_SESSION['LOGCHECK']) && isset($_SESSION['email']) && isset($_SESSION['fName']) ){
    if($_SESSION['accType'] == 'INSTRUCTOR')reDir("instruct/instructorProfile.php");
    if($_SESSION['accType'] == 'STUDENT') reDir("student/studentProfile.php");
}
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (!empty($_POST['create'])) {       // If there is post data from the create account form.
        $fName = cleanIt($_POST['fName']);           // Student or instructor's first Name
        $lName = cleanIt($_POST['lName']);           // Last Name
        $email = cleanIt($_POST['email']);           // Email address
                // Confirm Email address (Should be the same as email)
        $pass = cleanIt($_POST['pass']);            // The user's Password
        $cfPass = cleanIt($_POST['cfPass']);          // Confirm password field
        $accType = cleanIt($_POST['selectItBABY']);    // Instructor or Student account type


        if (createAccount($fName,$lName,$email,$pass,$accType)) {
            $displayAlert = 'Account Created!';
            $_SESSION['isLogged'] = 'TuIlI';   // TuIlI = "The user Is logged In"
            $_SESSION['LOGCHECK'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['fName'] = getFirstName($email);
            $_SESSION['accType'] = $accType;
            if($accType == 'INSTRUCTOR')reDir("instruct/instructorProfile.php");
            if($accType == 'STUDENT') reDir("student/studentProfile.php");

        } else {
            $displayAlert = 'Error';
        }
    }
    if (isset($_POST['loginSubmit'])) {
        $loginEmail = cleanIt($_POST['loginEmail']);
        $lPass = cleanIt($_POST['lPass']);

        if(checkLogin($loginEmail, $lPass)) {
            $displayAlert = "Login Success";
            $_SESSION['isLogged'] = 'TuIlI';   // TuIlI = "The user Is logged In"
            $_SESSION['LOGCHECK'] = true;
            $_SESSION['email'] = $loginEmail;
            $_SESSION['fName'] = getFirstName($loginEmail);
            $accountType = getAccountType($loginEmail);
            $_SESSION['accType'] = $accountType;
            if($accountType == 'INSTRUCTOR')reDir("instruct/instructorProfile.php");
            if($accountType == 'STUDENT') reDir("student/studentProfile.php");
        }else {
            $_SESSION['isLogged'] = false;
            $_SESSION['LOGCHECK'] = false;
            $displayAlert = "Login Fail";
        }
    }
}
/*  End Login System  */


















echo <<< HTML
<html>
<head>
	<!-- All Links, Meta data, scripts, and css goes inside the <head> tags.  -->
<!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        
<!-- JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="script/main.js" type="text/javascript"></script>

<!-- <header> and <nav> shouldn't be in the head it should be in the <body>  -->

</head>

<body>
	<header>           
            <img id="logo" src="img/logo.PNG" alt="Website Logo" align="top-left">
            
      <form id="loginForm" action="$PHP_SELF" method="post">
        <table>
		    <tr>
		        <td><span for="lEmail">E-Mail:</span> </td><td><input type="text" name="loginEmail" id="loginEmail" required>  </td>
		    </tr>
		    <tr>
		        <td><span for="lPass">Password:</span></td><td> <input type="password" name="lPass" required> </td>
		    </tr>
		    <tr>
		        <td><input type="button" value="Log In" id="loginSubmit" name="loginSubmit" > </td>
            </tr>
		</table>
	  </form>
	
	</header>

	<nav>   
	</nav>
	
    
    <div id="createAccForm">
    <form action="#" name="createAcc" id="createAcc" method="post">
    
      <h2> Create a New Account </h2>
      
        
        <table>
        <tr>
            <td><div class="tooltip" id="fNameTooltip"><span class="tooltiptext" id="fNameError">Please enter your first name.</span> 
            <input type="text" name="fName" placeholder="First name" required> </td></div>
            <td><div class="tooltip" id="lNameTooltip"><span class="tooltiptext" id="lNameError">Please enter your last name.</span>
            <input type="text" name="lName" placeholder="Last name" required>  </td></div>
        </tr>
     <!--   <tr>   Do we need to know the birthday? I don't think so!
            <td>Birthday</td>
            <td><input type="date" name="bDay" id="bDay"></td>
       </tr> 
        <tr> <td colspan="3"> <input type="text" name="sName" placeholder="School Name"  required> </td></tr>
        <tr> <td colspan="3"> <input type="text" name="userName" placeholder="User Name" required> </td> </tr>
     -->
        
        <tr>
              <td colspan="2"><div class="tooltip" id="emailTooltip"><span class="tooltiptext" id="emailError">Please enter a valid .edu email address.</span>
              <input type="email" name="email" placeholder="Email"  required></td> </div></tr>
        <tr> 
             <td><div class="tooltip" id="passwordTooltip"><span class="tooltiptext" id="passwordError">Password must be 8 characters long and contain at least 1 uppercase character.</span>
             <input type="password" id="pass" name="pass" placeholder="Password" required> </td> </div>
             
             <td><div class="tooltip" id="cfPasswordTooltip"><span class="tooltiptext" id="cfPasswordError">Passwords don't match.</span>
             <input type="password" ="cfPass" name="cfPass" placeholder="Confirm Password" required></td></tr></div>
        </tr>
        <tr><td colspan="2"> <select required name="selectItBABY" id="selectItBABY">
            <option value="STUDENT" selected >Student</option>
            <option value="INSTRUCTOR">Instructor</option>  
        </select></td></tr>
        
        <tr> <td colspan="3"> <input type="button" value="Create Account" id="create" name="create"> </td> </tr>

    </table>
    </form>
    </div>
    
    <div id=" alertMessage">
        <h1 style="color: red; size: 40px;">$displayAlert</h1>
    </div>



</body>

</html>

HTML;

