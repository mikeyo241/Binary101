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
$classData = searchClasses($classID);
$classData = $classData->fetch_assoc();
$className = $classData['CLS_NAME'];


if (getClassData($email) != false) {

    $searchResult = $user->getGradesByClass($classID);
    if ($searchResult->num_rows > 0) {
        $i = 0;
        while ($row = $searchResult->fetch_assoc()) {
            $clsID = $row['CLS_ID'];
            $studentLName = $row['STU_LNAME'];
            $studentFName = $row['STU_FNAME'];
            $score = $row['COM_SCORE'];
            $totalStudents = getStudentEnrollment($row['CLS_ID']);
            //$maxEnrollment = $row['CLS_MAXENROLLMENT'];
            $maxEnrollment = 10;
            $seatsAvailable = $maxEnrollment - $totalStudents;
            if (getClassAverage($row['CLS_ID']) == -1) {  // getClassAverage returns -1 when the glass doesn't any grade data.
                $classAverage = 'No Grades Yet';
            } else $classAverage = getClassAverage($row['CLS_ID']);
            $classInfo[$i] = "
                <tr>
                    <td><input type='radio' name='class' id='class' value='$clsID' </td>
                    <td>$studentLName, $studentFName</td>
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
    <link rel="stylesheet" type="text/css" href="/instruct/instructAssets/styles/instruct.css"/>
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

        <section>
            
            <h2 id="classID"> The ClassID for the gradebook you are looking for is <p id="red">$classID</p> </h2>
            
            <div id="classesEnroll" name="classes" style="$classesStyle">
                <h2 id="className">$className</h2>
                    <table class="col-md-8" id="classesEnrollTable" border="5" >  <!-- Remove the Styling for the table and make your own! -->
                        <thead>
                            <td> </td>
                            <td>Student</td>               
                            <td>Course</td>
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
        
        
     </section>
        
    
    <div id="bottomLineRelative">
        <!--   simply for aesthetics   -->
    </div>

    <footer id="posRelative">
        <a href="/about.html" style="color: white"> About Us </a>
        | <a href="/privacy.html" style="color: white;"> Privacy Policy </a>
    </footer>
 
</body>


</html> 

HTML;



