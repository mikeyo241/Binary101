<?php

/*
 * Programmer:       Nathaniel Merck
 * Title:            login/sign-up page for Group Website Project
 * Date:             3/2/2017
 */
include('functionlib.php');

if (isset($_POST['createAcc'])) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $cfEmail= $_POST['cfEmail'];
    $pass = $_POST['pass'];
    $cfPass = $_POST['cfPass'];
    $accType = $_POST['selectItBABY'];

}
if (isset($_POST['loginForm'])) {
    $lEmail = $_POST['lEmail'];
    $lPass = $_POST['lPass'];

}




















echo <<< HTML
<html>
<head>
	<!-- All Links, Meta data, scripts, and css goes inside the <head> tags.  -->
<!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
	
<!-- <header> and <nav> shouldn't be in the head it should be in the <body>  -->

</head>

<body>
	<header>           
            <img id="logo" src="img/logo.PNG" alt="Website Logo" align="top-left">
            
      <form id="loginForm" action="$PHP_SELF" method="post">
        <table>
		    <tr>
		        <td colspan="2"><span for="lEmail">Email:</span> <input id="emailInput" type="email" name="lEmail" required>  </td>
		    </tr>
		    <tr>
		        <td><span for="lPass">Password:</span> <input type="password" name="lPass" required> </td>
		    <tr>
		        <td><input type="submit" value="Log In" id="submit" > </td>
		    </tr>
		</table>
	  </form>
	
	</header>

	<nav>   
	</nav>
	
    
    <div id="createAccForm">
    <form action="$PHP_SELF" id="createAcc" method="post">
    
      <h2> Create a New Account </h2>
      
        <input type="text" name="sName" placeholder="School Name" style="width:355px;" required>   <br>
        
        <input type="text" name="fName" placeholder="First name" required>
        <input type="text" name="lName" placeholder="Last name" required>  <br>
        
        <input type="email" name="email" placeholder="Email" style="width:355px;" required>   <br>
        
        <input type="email" name="cfEmail" placeholder="Re-enter Email" style="width:355px;" required>    <br>
        
        <input type="password" id="pass" name="regPass" placeholder="Password" style="width:355px;" required>   <br>
        
        <input type="password" ="cfPassword" name="cfPassword" placeholder="Confirm Password" style="width: 355px;" required>   <br>
        <select required name="selectItBABY" id="selectItBABY">
            <option value="student" selected >Student</option>
            <option value="instructor">Instructor</option>  
        </select>
                
        <input type="submit" value="Create Account" id="create">
    
    
    </form>
    </div>
</body>

</html>

HTML;

