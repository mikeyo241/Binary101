<?php

/*
 * Programmer:       Nathaniel Merck
 */

echo <<< HTML
<html>
<head>
	<!-- All Links, Meta data, scripts, and css goes inside the <head> tags.  -->
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="css/style.css"/>
	
<!--  ** Java ** -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="/Binary101/script/main.js" type="text/javascript"></script>

<!-- <header> and <nav> shouldn't be in the head it should be in the <body>  -->

</head>
<body>

	<header>
		<img id="logo" src="/Binary101/img/logo.PNG" alt="Website Logo" align="top-left">   
            
        <h4 id="wel">Welcome <!-- <?php echo "(dollar sign)name";    ?>     THIS IS THE VARIABLE FOR THE FIRST NAME --></h4>
        
        <img id="icon" src="/Binary101/img/icon.png" alt="Profile Icon" align="top-left"> <!-- Directory changes name -->
                
	</header>
	
	
    <section>
        <div id="linkBar">
            <ul>
                <li>
                    <a href="progress.php"> Progress </a>
                </li>
                <li>
                    <a href="profile.php"> Profile </a>
                </li>
                <li >
                    <a id="currentPage" href="contents.php" > Table of Contents </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap1.php"> Chapter 1 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap2.php"> Chapter 2 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap3.php"> Chapter 3 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap4.php"> Chapter 4 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap5.php"> Chapter 5 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap6.php"> Chapter 6 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap7.php"> Chapter 7 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap8.php"> Chapter 8 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap9.php"> Chapter 9 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap10.php"> Chapter 10 </a>
                </li>
                <li>
                    <a href="/Binary101/course/chap11.php"> Chapter 11 </a>
                </li>
            
            </ul>
        </div>
        
        
    
</body>

</html>

HTML;

