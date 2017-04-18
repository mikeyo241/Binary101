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
    reDir('../index.php');
}
if(isset($_GET['CLS_ID'])){
    $_SESSION['CLS_ID'] = $_GET['CLS_ID'];
    $CLS_ID = $_SESSION['CLS_ID'];
}

if (! isset($_GET['xchwe'])){
    $chapter = 1;
    $activeChapter = array (" active ", " "," "," "," "," "," "," "," ", " ");
}else {
    $chapter = $_GET['xchwe'];
    $activeChapter =   shadeActiveChapter();
}
checkIfLoggedIn();

if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (!empty($_POST['logOutSubmit'])) {
        session_destroy();
        reDir('../index.php');
    }

}


$name = " " . $fName . " " . $lName;
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
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Binary 101 </a>
      
      
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
    <li class="dropdown $activeChapter[0]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=1">Chapter 1
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=1">The History Of Binary</a></li>
          <li><a href="#">Start Quiz</a></li>        
        </ul>
      </li>
      <li class="dropdown $activeChapter[1]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=2">Chapter 2
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=2">Powers of 2</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown $activeChapter[2]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=3">Chapter 3
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=3">Decimal to Binary Conversion</a></li>
          <li><a href="#">Start Quiz</a></li>
          <li><a href="#">Chapter 1-3 Test</a></li>
        </ul>
        </li>
       
        <li class="dropdown $activeChapter[3]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=4">Chapter 4
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=4">Binary to Decimal Conversion</a></li> 
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown $activeChapter[4]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=5">Chapter 5
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=5">Binary Math</a></li>
          <li><a href="#">Start Quiz</a></li>
          <li><a href="#">Chapter 4-5 Test</a></li>
        </ul>
        
      </li>
      <li class="dropdown $activeChapter[5]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=6">Chapter 6
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=6">Binary to Hex Conversion</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown $activeChapter[6]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=7">Chapter 7
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=7">2's Complement</a></li>
          <li><a href="#">Start Quiz</a></li>
          <li><a href="#">Chapter 6-7 Test</a></li>
        </ul>
      </li>
      <li class="dropdown $activeChapter[7]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=8">Chapter 8
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=8">Venn Diagrams</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown $activeChapter[8]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=9">Chapter 9
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=9">Truth Tables</a></li>
          <li><a href="#">Start Quiz</a></li>
        </ul>
      </li>
      <li class="dropdown $activeChapter[9]">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=10">Chapter 10
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="course.php?xchwe=10">Psuedo Code</a></li>
          <li><a href="#">Start Quiz</a></li>
          <li><a href="#">Chapter 8-10 Test</a></li>
        </ul>
      </li>
      <li><a href="#">Final Exam</a></li>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="course.php?xchwe=1"><span class="glyphicon glyphicon-user"></span>$name
       </a>
        <ul class="dropdown-menu text-center">
          <li><a href="../student/studentProfile.php">  Profile</a></li>
          <li><a href="../student/gradebook.php">  Grade Book</a></li>
          <li class="text-center">
            <form id="signOutForm" action="$PHP_SELF" method="post">
                <button type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-log-out"></span> Log out
                </button>
            </form>
          </li>
        </ul>
      </li>
     
    </ul>
  </div>
  </div>
</nav>
  
  <div class="row centered-form center-block" style="margin-top: 60px;">
    <div class="container-fluid col-md-10 col-md-offset-1">
  

HTML;
chooseChapter($chapter);
echo <<< HTML
    </div>

</div> 

</body>
<script src="../assets"
<script src="../assets/script/main.js"></script>
<script src="assets/scripts/course.js" type="text/javascript"></script>

</html>
HTML;


