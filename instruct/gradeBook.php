<?php
session_start();
require ('../functionlib.php');

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
$fName = $_SESSION['fName'];
$lName = $_SESSION['lName'];
$email = $_SESSION['email'];
$classCreated = '';
$classesStyle = 'display: block;';
$classID = $_SESSION['classID'];
$classData = getClassDataById($classID) -> fetch_assoc();
$className = $classData['CLS_NAME'];


if (getClassData($email) != false) {

    $searchResult = getClassData($email);
    if ($searchResult->num_rows > 0) {
        $i = 0;
        while ($row = $searchResult->fetch_assoc()) {
            $clsID = $row['CLS_ID'];
            $className = $row['CLS_NAME'];
            $totalStudents = getStudentEnrollment($row['CLS_ID']);
            $maxEnrollment = $row['CLS_MAXENROLLMENT'];
            $seatsAvailable = $maxEnrollment - $totalStudents;
            if (getClassAverage($row['CLS_ID']) == -1) {  // getClassAverage returns -1 when the glass doesn't any grade data.
                $classAverage = 'No Grades Yet';
            } else $classAverage = getClassAverage($row['CLS_ID']);
            $classInfo[$i] = "
                <tr>
                    <td><input type='radio' name='class' id='class' value='$clsID' </td>
                    <td>$className</td>
                    <td>$totalStudents</td>
                    <td>$seatsAvailable</td>
                    <td>$classAverage</td>
                    <td>$clsID</td>
                </tr>";
            $i++;
        }
    } else {
        $classInfo[0] = 'There are no classes associated with that email!';
    }
}









echo <<< HTML


<html lang="en">
<head>
    
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
                <td> </td>
                <td>Student</td>               
                <td>Students Enrolled</td>
                <td>Available Seats</td>
                <td>Class Grade Average</td>          
            </thead>
                <form id="gradeBook" name="gradeBook" action="$PHP_SELF" method="post">
                   
HTML;
if(isset($classInfo)) {
    foreach ($classInfo as $value) {
        echo $value;
    }
}
echo <<< HTML
                <tr><td colspan="5"><input value="View Grade Book" type="submit" id="submitGradeBook" name="submitGradeBook"></td></tr>
            </form>
        </table>
    </div>
</html> 

HTML;



