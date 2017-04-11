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

<<<<<<< HEAD
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



