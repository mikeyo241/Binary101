<?php

/*
 * Programmer:       Nathaniel Merck
 * Title:            login/sign-up page for Group Website Project
 * Date:             2/23/2017
 */

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
	</header>

	<nav>   
	</nav>
	
    <form action="main.php" method="post">
		<h4 id="username"> Email <br> <input type="email" name="lEmail" required></h4>
		<h4 id="password"> Password <br> <input type="password" name="lPassword" required></h4>	 <br>
		<input type="submit" value="logIn" id="submit" >
    </form>
    
    
    <form action="main.php" id="createacc" method="post">
    
      <h2> Create a New Account </h2>
      
        <input type="text" name="sName" placeholder="School Name" style="width:355px;" required>   <br>
        
        <input type="text" name="fName" placeholder="First name" required>
        <input type="text" name="lName" placeholder="Last name" required>  <br>
        
        <input type="email" name="regEmail" placeholder="Email" style="width:355px;" required>   <br>
        
        <input type="email" name="cfEmail" placeholder="Re-enter Email" style="width:355px;" required>    <br>
        
        <input type="password" id="regPass" name="regPass" placeholder="Password" style="width:355px;" required>   <br>
        
        <input type="password" ="cfPassword" name="cfPassword" placeholder="Confirm Password" style="width:355px;" required>   <br>
        
        <h4 id="studentacc"> Student <input type="radio" name="account" value="1" required></h4>
        
        <h4 id="instructacc"> Instructor <input type="radio" name="account" value="2" required></h4>
        
        <input type="submit" value="createAccount" id="create">
    
    
    </form>
    
</body>

</html>

HTML;

