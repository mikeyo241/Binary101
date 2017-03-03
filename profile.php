<?php

/*
 * Programmer:       Nathaniel Merck
 */

echo <<< HTML
<html>

        <!-- <link rel="stylesheet" type="text/css" href="Bin101/css/style.css"/>  -->    <!-- Directory changes name --> 
        <link rel="stylesheet" type="text/css" href="css/style.css"/>

<head>
	<header>
		<!-- <img src="Bin101/img/logo.PNG" alt="Website Logo" align="top-left"> -->  <!-- Directory changes name -->
        <img id="logo" src="img/logo.PNG" alt="Website Logo" align="top-left">     
            
        <h4 id="wel">Welcome <!-- <?php echo "(dollar sign)name";    ?>     THIS IS THE VARIABLE FOR THE FIRST NAME --></h4>
            
        <!-- <img id="icon" src="Bin101/img/icon.png" alt="Profile Icon" align="top-left"> -->  <!-- Directory changes name -->
        <img id="icon" src="img/icon.png" alt="Profile Icon" align="top-left"> <!-- Directory changes name -->
                
	</header>

	<nav id="navbar">  
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
	</nav>

</head>

<body>

    <div id="titlediv">
        <h2 id="title">[ Profile ]</h2>
    </div>

    <div id="content">
        
    </div>
    
</body>

</html>

HTML;

