<?php
require('../lib/functionlib.php');
require_once ('coursesLib.php');

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


//checkUser();
if (! isset($_GET['xchwe']) && ! isset($_GET['CLS_ID'])){
    reDir('../main.php');
}
if(isset($_GET['CLS_ID'])){
    $_SESSION['CLS_ID'] = $_GET['CLS_ID'];
    $CLS_ID = $_SESSION['CLS_ID'];
}

if (! isset($_GET['xchwe'])){
    $chapter = 1;
}else {
    $chapter = $_GET['xchwe'];
}

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
    <!-- <link type="text/css" href="../assets/css/style.css" rel="stylesheet" />  -->
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
    nav {
        margin: 20px auto auto auto;
        width: 90%;
        font-size: 17px;
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
    <script src="assets/scripts/course.js" type="text/javascript"></script>

</head>

<body>
   <header>     
      <a href="/main.php"><img id="logo" src="../assets/img/logo.PNG" alt="Website Logo" align="top-left"></a>   
      <h1 id="welcome">Welcome $fName !!!  </h1>
      <img id="icon" src="../assets/img/icon.png" align="top-left">
   </header>
  
  
   
   <div id="line">
        <!-- simply for aesthetics  -->
   </div>
   
   <nav id="chapterNav">
        <a href="course.php?xchwe=1" />Chapter 1</a> |
        <a href="course.php?xchwe=2" />Chapter 2</a> |
        <a href="course.php?xchwe=3" />Chapter 3</a> |
        <a href="course.php?xchwe=4" />Chapter 4</a> |
        <a href="course.php?xchwe=5" />Chapter 5</a> |
        <a href="course.php?xchwe=6" />Chapter 6</a> |
        <a href="course.php?xchwe=7" />Chapter 7</a> |
        <a href="course.php?xchwe=8" />Chapter 8</a> |
        <a href="course.php?xchwe=9" />Chapter 9</a> | 
        <a href="course.php?xchwe=10" />Chapter 10</a> |
        <a href="course.php?xchwe=11" />Chapter 11</a> |
        <a href="course.php?xchwe=12" />Chapter 12</a> |
        <a href="course.php?xchwe=13" />Chapter 13</a> |
        <a href="course.php?xchwe=14" />Chapter 14</a> |
        <a href="course.php?xchwe=15" />Chapter 15</a> |
        <a href="course.php?xchwe=16" />Chapter 16</a>
   </nav>
   

HTML;
chooseChapter($chapter);
echo <<< HTML


    <div id="bottomLineRelative">
        <!--   simply for aesthetics   -->
    </div>
   
    <footer>
        <a href="/about.html" style="color: white"> About Us </a>
        | <a href="/privacy.html" style="color: white;"> Privacy Policy </a>
    </footer>   
</body>

</html>
HTML;


