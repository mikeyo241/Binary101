<?php
require '../vendor/phpmailer/phpmailer/PHPMailerAutoload.php';
 require('../lib/functionlib.php');

/******************************************************
 ***               Instructor Gradebook                  ***
 ***                                                ***
 ***    Created by:         Michael A Gardner       ***
 ***    Updated:            26 September 2016       ***
 ***    Class:              CPT - 264 - 002         ***
 ***    Document:           profile.php             ***
 ***    CSS:                styles.css, nav.css     ***
 ***    jQuery:             jQuery.js, Alpha.js     ***
 ***                                                ***
 ******************************************************/
if ($_SESSION['isLogged'] != 'TuIlI' || !$_SESSION['LOGCHECK']) {  // Make sure the user is logged in!!! This is a private page!!
    session_destroy();
    reDir('../main.php');
}
/*  Variables  */
$user = $_SESSION['user'];
$fName = $user->getFirstName();
$lName = $user->getLastName();
$email = $user->getEmail();
$classCreated = '';
$classesStyle = 'display: block;';
$classID = $_SESSION['classID'];
$class = new Classroom($classID);
$classData = searchClasses($classID);
$classData = $classData->fetch_assoc();
$className = $classData['CLS_NAME'];
$headings = "";

if ($class->getStudentEnrollment() != false) {
    $students = $class->getStudentEnrollment();
    if ($students->num_rows > 0) {
        $i = 0;
        $courses = $class->getCourses();
        $courseArray = array();
        // Setup course headings
        if ($courses != null){
            while ($row = $courses->fetch_assoc()) {
                $courseArray[$i] = $row['CRS_ID'];
                $headings = $headings . "<td>" . $row['CRS_NAME'] . "</td>";
                $i++;
            }
            $i = 0;
        }
        // Cycle through students' grades
        $classInfo = "";
        while ($row = $students->fetch_assoc()) {
            $student = new Student($row['STU_EMAIL']);
            $studentName = $student->getLastName() . ", " . $student->getFirstName();
            $average = $student->getGradeByClass($classID);
            $classInfo .= "<tr><td>$studentName</td>";

            foreach ($courseArray as $courseID) {
                $classInfo .= "<td>" . $student->getGradeByCourse($classID, $courseID) . "</td>";
                $i++;
            }
            $i = 0;
            $classInfo .= "<td>$average</td></tr>";
        }
    } else {
        $classInfo = 'There are no classes associated with that email!';
    }
}









echo <<< HTML


<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/instruct/instructAssets/styles/instruct.css"/>
</head>
<body>
<h1> This page Is Still Under Construction $fName!!!! </h1>

<p>Check back later for an awesome grade book page!!!</p>

<h2> The ClassID for the gradebook you are looking for is $classID </h2>
</body>
<div id="classes" name="classes" style="$classesStyle">
    <h2>$className</h2>
        <table border="5" style="text-align: center; padding: 5px;">  <!-- Remove the Styling for the table and make your own! -->
            <thead>
                <td>Student</td>               
                $headings
                <td>Student Average</td>          
            </thead>
            <form id="gradeBook" name="gradeBook" action="$PHP_SELF" method="post">
                $classInfo
            </form>
        </table>
    </div>
</html> 

HTML;



