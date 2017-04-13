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
    <!--<link type="text/css" href="assets/css/course.css" rel="stylesheet" />  -->
    <!--  This is syles by Michael you can change this
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
    -->
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Binary 101 - Learning Module</a>
    </div>
    <ul class="nav navbar-nav">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=1">Chapter 1
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=1">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>        
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=2">Chapter 2
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=2">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=3">Chapter 3
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=3">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
        </li>
        <li><a href="#">Chapter 1-3 Test</a></li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=4">Chapter 4
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=4">Learning Content</a></li> 
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=5">Chapter 5
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=5">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
        <li><a href="#">Chapter 4-5 Test</a></li>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=6">Chapter 6
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=6">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=7">Chapter 7
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=7">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li><a href="#">Chapter 6-7 Test</a></li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=8">Chapter 8
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=8">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=9">Chapter 9
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=9">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=10">Chapter 10
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=10">Learning Content</a></li>
          <li><a href="#">Start Quiz</a></li>
          <li><a href="#">Chapter 8-10 Test</a></li>
        </ul>
      </li>
      <li><a href="#">Final Exam</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>
  
  
   
   <div id="line">
        <!-- simply for aesthetics  -->
   </div>
   <div class="col-md-2"></div>
   <div class="col-md-8">   

HTML;
chooseChapter($chapter);
echo <<< HTML
    </div>
    <div class="col-md-2"></div>

    <div id="bottomLineRelative">
        <!--   simply for aesthetics   -->
    </div>
   
    <footer>
        <a href="/about.html" style="color: white"> About Us </a>
        | <a href="/privacy.html" style="color: white;"> Privacy Policy </a>
    </footer>   
</body>
<script src="../assets"
<script src="../assets/script/main.js"></script>
<script src="assets/scripts/course.js" type="text/javascript"></script>

</html>
HTML;


