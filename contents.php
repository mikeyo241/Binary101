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
	
<!-- <header> and <nav> shouldn't be in the head it should be in the <body>  -->

</head>
<body>

	<header>
		<img id="logo" src="img/logo.PNG" alt="Website Logo" align="top-left">   
            
        <h4 id="wel">Welcome <!-- <?php echo "(dollar sign)name";    ?>     THIS IS THE VARIABLE FOR THE FIRST NAME --></h4>
        
        <img id="icon" src="img/icon.png" alt="Profile Icon" align="top-left"> <!-- Directory changes name -->
                
	</header>
	
	
    <section id="navbar">
            <ul>
                <li>
                    <a href="progress.php"> Progress </a>
                </li>
                <li>
                    <a href="profile.php"> Profile </a>
                </li>
                <li id="toc">
                    <a href="contents.php" > Table of Contents </a>
                </li>
                <li>
                    <a href="chap1.php"> Chapter 1 </a>
                </li>
                <li>
                    <a href="chap2.php"> Chapter 2 </a>
                </li>
                <li>
                    <a href="chap3.php"> Chapter 3 </a>
                </li>
                <li>
                    <a href="chap4.php"> Chapter 4 </a>
                </li>
                <li>
                    <a href="chap5.php"> Chapter 5 </a>
                </li>
                <li>
                    <a href="chap6.php"> Chapter 6 </a>
                </li>
                <li>
                    <a href="chap7.php"> Chapter 7 </a>
                </li>
                <li>
                    <a href="chap8.php"> Chapter 8 </a>
                </li>
                <li>
                    <a href="chap9.php"> Chapter 9 </a>
                </li>
                <li>
                    <a href="chap10.php"> Chapter 10 </a>
                </li>
                <li>
                    <a href="chap11.php"> Chapter 11 </a>
                </li>
            
            </ul>
    </section>
	
	
	<aside id="contentSection">
	    <div id="titlediv">
            <h2 id="title">[ Table of Contents ]</h2>
        </div>
    
        <div id="content">
            
        </div>
    </aside>
    
</body>

</html>

HTML;

