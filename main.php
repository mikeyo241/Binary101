<?php

/*
 * Programmer:       Nathaniel Merck
 * Title:            login/sign-up page for Group Website Project
 * Date:             2/23/2017
 */

echo <<< HTML
<html>


<head>
<!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>

<body>

    <header>
		 <img src="img/logo.PNG" alt="Website Logo" align="top-left">
	</header>

	<nav>   <!--
		<ul>
			<li> <a href="index.php"> Home </a> </li>

			<li> <a href="profile.php"> Profile </a> </li>

			<li> <a href="register.php"> Register </a> </li>

		</ul>   -->


	</nav>

    <form action="index.php" method="post">
		<h4 id="username"> Email <br> <input type="email" name="login email" required></h4>
		<h4 id="password"> Password <br> <input type="password" name="login password" required></h4>	 <br>
		<input type="submit" value="Log In" id="submit" >
    </form>
    
    
    <form action="index.php" id="createAcc" name="createAcc" method="post">
    
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
        
        <input type="submit" value="Create Account" id="create">
    
    
    </form>
    
</body>

</html>

HTML;

