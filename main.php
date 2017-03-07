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
require('functionLib.php');
$displayAlert = '';
if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (!empty($_POST['create'])) {       // If there is post data from the create account form.
        $fName = cleanIt($_POST['fName']);           // Student or instructor's first Name
        $mName = cleanIt($_POST['mName']);           // Middle Name
        $lName = cleanIt($_POST['lName']);           // Last Name
        $email = cleanIt($_POST['email']);           // Email address
        $cfEmail = cleanIt($_POST['cfEmail']);         // Confirm Email address (Should be the same as email)
        $pass = cleanIt($_POST['pass']);            // The user's Password
        $cfPass = cleanIt($_POST['cfPass']);          // Confirm password field
        $accType = cleanIt($_POST['selectItBABY']);    // Instructor or Student account type
        $sName = cleanIt($_POST['sName']);           // School Name
        $prefix = cleanIt($_POST['prefix']);
        $suffix = cleanIt($_POST['suffix']);
        $birthMonth = cleanIt($_POST['birthMonth']);
        $birthDay = cleanIt($_POST['birthDay']);
        $birthYear = cleanIt($_POST['birthYear']);
        $schoolID = cleanIt($_POST['schoolID']);        // Like Tri-County's T-Number
        $userName = cleanIt($_POST['userName']);        // Unique Username

        if (createAccount($fName, $mName, $lName, 'na', $email, $pass, $accType, $sName,
            $prefix, $suffix, $birthMonth, $birthYear, $birthDay, $schoolID, $userName, 'na')) {
            $displayAlert = 'Account Created!';
        } else {
            $displayAlert = 'Error';
        }
    }
    if (isset($_POST['loginSubmit'])) {
        $userNameL = cleanIt($_POST['userNameL']);
        $lPass = cleanIt($_POST['lPass']);

        if(checkLogin($userNameL, $lPass)) {
            $displayAlert = "Login Success";
            $_SESSION['islogged'] = 'TuIlI';   // TuIlI = "The user Is logged In"
            $_SESSION['LOGCHECK'] = true;
            $_SESSION['userName'] = $userNameL;
            $_SESSION['fName'] = getFirstName($userNameL);
            $accountType = getAccountType($userNameL);
            reDir($accountType.".php");
        }else {
            $_SESSION['islogged'] = false;
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
		        <td colspan="2"><span for="lEmail">Username:</span> <input type="text" name="userNameL" id="userNameL" required>  </td>
		    </tr>
		    <tr>
		        <td><span for="lPass">Password:</span> <input type="password" name="lPass" required> </td>
		    <tr>
		        <td><input type="submit" value="Log In" id="loginSubmit" name="loginSubmit" > </td>
		    </tr>
		</table>
	  </form>
	
	</header>

	<nav>   
	</nav>
	
    
    <div id="createAccForm">
    <form action="$PHP_SELF" name="createAcc" id="createAcc" method="post">
    
      <h2> Create a New Account </h2>
      
     
<!--        <input type="text" name="prefix" placeholder="Prefix">
        <input type="text" name="suffix" placeholder="Suffix" >
        -->
        <select required name="selectItBABY" id="selectItBABY">
            <option value="student" selected >Student</option>
            <option value="instructor">Instructor</option>  
        </select>
        <table>
        <tr>
            <td> <input type="text" name="fName" placeholder="First name" required> </td>
            <td> <input type="text" name="lName" placeholder="Last name" required>  </td>
        </tr>
        <!-- Do we need to know the birthday?  -->
        <tr>
            <td> <input type="text" name="birthMonth" placeholder="Birth Month" >           </td>
            <td> <input type="text" name="birthDay" placeholder="Birth Day" width="20px">   </td>
            <td> <input type="text" name="birthYear" placeholder="Birth Year" >             </td>
        </tr>
        <tr><td colspan="3"><input type="text" name="sName" placeholder="School Name" style="width:355px;" required> </td></tr>
       
        <!-- Do we need to know the school id?  -->
        <!-- <input type="text" name="schoolID" placeholder="Student ID" required> -->

  <!--      
        <br>Birthday:
         <input type="date" name="bday">
         <input type="text" name="userName" placeholder="User Name" required>
    -->    
          
 
        <tr>
            <td colspan="3"> <input type="email" name="email" placeholder="Email" style="width:355px;" required></td>
        </tr>
        <tr>
            <td colspan="3"> <input type="password" id="pass" name="pass" placeholder="Password" style="width:355px;" required> </td>
        </tr>
        <tr>
            <td colspan="3"> <input type="submit" value="Create Account" id="create" name="create"> </td>
        </tr>

    </table>
    </form>
    </div>
    
    <div id=" alertMessage">
    <h1 style="color: red; size: 40px;">$displayAlert</h1>
    </div>



</body>

</html>

HTML;

