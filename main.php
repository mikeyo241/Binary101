<?php

/*
 * Programmer:       Nathaniel Merck
 * Title:            login/sign-up page for Group Website Project
 * Date:             2/23/2017
 */

echo <<< HTML
<html>

<!-- <link rel="stylesheet" type="text/css" href="Bin101/css/style.css"/>  -->    <!-- Directory changes name --> 

        <link rel="stylesheet" type="text/css" href="css/style.css"/>

<head>
	<header>
		<!-- <img src="Bin101/img/logo.PNG" alt="Website Logo" align="top-left"> -->  <!-- Directory changes name -->
            
            <img id="logo" src="img/logo.PNG" alt="Website Logo" align="top-left">
	</header>

	<nav>   
	</nav>

</head>

<body>

    <form action="main.php" method="post">
		<h4 id="username"> Email <br> <input type="email" name="login email" required></h4>
		<h4 id="password"> Password <br> <input type="password" name="login password" required></h4>	 <br>
		<input type="submit" value="Log In" id="submit" >
    </form>
    
    
    <form action="main.php" id="createacc" method="post">
    
      <h2> Create a New Account </h2>
      
        <input type="text" name="school name" placeholder="School Name" style="width:355px;" required>   <br>
        
        <input type="text" name="first name" placeholder="First name" required>
        <input type="text" name="last name" placeholder="Last name" required>  <br>
        
        <input type="email" name="register email" placeholder="Email" style="width:355px;" required>   <br>
        
        <input type="email" name="re-enter email" placeholder="Re-enter Email" style="width:355px;" required>    <br>
        
        <input type="password" name="register password" placeholder="Password" style="width:355px;" required>   <br>
        
        <input type="password" name="re-enter password" placeholder="Confirm Password" style="width:355px;" required>   <br>
        
        <h4 id="studentacc"> Student <input type="radio" name="account" value="1" required></h4>
        
        <h4 id="instructacc"> Instructor <input type="radio" name="account" value="2" required></h4>
        
        <input type="submit" value="Create Account" id="create">
    
    
    </form>
    
</body>

</html>

HTML;

