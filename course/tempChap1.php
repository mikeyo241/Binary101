<?php
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


/** TEMPORARY CHAP 1 FILE!!!
 * Everything is going to be loaded on the course file!!!
 */

require ('../functionlib.php');
echo <<< HTML

<html lang="en">
<head>
    <meta name="title" content="Chapter 3" /> <!-- In the future "Chapter 3" will be a variable!!!!  -->
    <meta name="author" content="Michael Gardner" />
    <meta name="owner" content="Group 6" />
    <meta name="description" content="Learn how Binary works!">
    <meta name="keywords" content="Binary, Hex, Introduction to Computer Science">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    
    <!--  ** CSS  ** -->
    <link type="text/css" href="css/course.css" rel="stylesheet" />


    <!--  ** Java ** -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="scripts/course.js" type="text/javascript"></script>

</head>

<body>

<!-- Everything below this point will be imputed with a function in the function library!! This is a temporary page 
   - so that we can create a good css template.  
   -->
<h1>The History of Binary</h1>
<p>We all have seen binary before whether it be in movies, TV shows, or on the internet we all have an understanding
 that binary is the 1's and 0's that computers use to operate.
   To a computer binary is converted to electrical signals a high voltage for a
    1 and a low voltage for 0. Tiny transistors in the CPU are used to process 
    these signals to produce everything that you see on screen.  It has been theorized
     by Intel co-founder Gordon Moore that the number of transistors double every 2 years.
       Which although under very skeptical criticism has proved true for 42 years(1975-current year). 
</p>
<p><b>Moore's Law</b> -  is the observation that the number of transistors in a dense integrated circuit doubles approximately every two years.</p>
<p><b>Binary</b> -  a system of numerical notation to the base 2, in which each place of a number, expressed as 0 or 1, corresponds to a power of 2.</p>
<img src="../img/mooresLaw.png" >
<p>In 1679 a German polymath and philosopher  named Gottfried Wilhelm Leibniz documented the binary system.
  Binary is used in computers because it is the most practical way for a computer to process data.</p>

<h2>Why learn how binary works?</h2>

<p>If you are going into Programming the programs you will be writing in a high level language 
such as C++ will be compiled into assembly language which is binary.
<br>
If you are going into IT, binary is used to transmit data across networks 
and chips, It is used to stored data onto the hard drive.
<br>
Every letter you type is ASCii which is a standard that computers used to encode 
letters into binary you will learn more about ASCii in later Chapters.
</p>


</body>

</html>
HTML;
