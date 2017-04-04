<?php
require('../lib/functionlib.php');

/******************************************************
 ***               Private Profile                  ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            26 September 2016       ***
 ***    Class:              CPT - 283-001           ***
 ***    Document:           profile.php             ***
 ***    CSS:                styles.css, nav.css     ***
 ***    jQuery:             jQuery.js, Alpha.js     ***
 ***                                                ***
 ******************************************************/

$chapter = 'chap2';
//checkUser();

$_SESSION['CLS_ID'] = $_GET['CLS_ID'];
$CLS_ID = $_SESSION['CLS_ID'];

echo <<< HTML

<html lang="en">
<head>
    <meta name="author" content="Michael Gardner" />
    <meta name="owner" content="Group 6" />
    <meta name="description" content="Learn how Binary works!">
    <meta name="keywords" content="Binary, Hex, Introduction to Computer Science">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    
    
    <!--  ** CSS  ** -->
     <link type="text/css" href="../assets/css/style.css" rel="stylesheet" />
    <link type="text/css" href="assets/css/course.css" rel="stylesheet" />
    <!--  This is syles by Michael you can change this -->
    <style> 
    body {
        background-color: lightgrey;
    }
    #accountMenu {
        position:absolute;
        left: 80%;
        top: 15px;
    }
    #accountMenu H2 {
        color: white;
    }
    
    #learningContent {
        background-color: white;
        border-radius: 20px;
        margin: 30px auto;
        color: black;
        padding: 0 20px;
        width: 90%;
        
    }
    footer {
    position: relative;
    bottom: inherit;
    
    }
</style>

    <!--  ** Java ** -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="scripts/course.js" type="text/javascript"></script>

</head>

<body>
   <header>           
      <img id="logo" src="../assets/img/logo.PNG" alt="Website Logo" align="top-left">
   </header>
   
   <div id="accountMenu">
        <h2>$fName $lName</h2>
    </div>
   
   <div id="line">
        <!-- simply for aesthetics  -->
   </div>
   
   <nav id="chapterNav">
    
   </nav>
   

HTML;
chap1();
echo <<< HTML

   
    <footer>
        <a href="about.html" style="color: white"> About Us </a>
        | <a href="privacy.html" style="color: white;"> Privacy Policy </a>
    </footer>   
</body>

</html>
HTML;


