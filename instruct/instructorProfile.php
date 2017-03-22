<?php
require ('../functionlib.php');
session_start();


/******************************************************
***               Instructor Profile                  ***
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
$fName = $_SESSION['fName'];
$lName = $_SESSION['lName'];
$email = $_SESSION['email'];
$user = $_SESSION['user'];
$classCreated = '';
$classesStyle = 'display: block;';


// TEST ENVIRONMENT Variables
//$fName = 'TEST ENVIRONMENT';
//$lName = ' ';
//$email = 'test@testing.com';

/** Check to see if the instructor has any classes */
if (getClassNum($email) == 0){
    $classesStyle = 'display: none;';
} else $classesStyle = 'display: block;';




if ($_SERVER['REQUEST_METHOD']=='POST') {
    if (isset($_POST['logOutSubmit'])) {
    session_destroy();
    reDir('../main.php');
    }
    if(isset($_POST['createAClassSubmit'])){
        if(checkClass($email, $_POST['className'])){
            if($user->createClass($_POST['className'], $_POST['sDate'], $_POST['eDate'], $_POST['maxEnrollment'])){
                $classCreated = 'Class Created Successfully';
            }else $classCreated = 'Class was not created successfully';
        }else $classCreated = 'Duplicate Class Name';

    }
    if(isset($_POST['submitGradeBook'])){
        if(isset($_POST['class'])) {
            $_SESSION['classID'] = $_POST['class'];
            reDir('gradeBook.php');
        }
    }
}
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
<html>
<head>
    <title>$fName $lName</title>

</head>
<body>
<h1>Welcome $fName !!!</h1>
    <div id="classes" name="classes" style="$classesStyle">
    <h2>Current Classes</h2>
        <table border="5" style="text-align: center; padding: 5px;">  <!-- Remove the Styling for the table and make your own! -->
            <thead>
                <td> </td>
                <td>Course</td>               
                <td>Students Enrolled</td>
                <td>Available Seats</td>
                <td>Class Grade Average</td>
                <td>Class Link</td>
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
    <div id="createAClass">
        <table>
        <h2>Create a new Class</h2>
            <thead>
            <td>Class Name</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Maximum Enrollment</td>
            <td>  </td>
            </thead>
            <tr><form action="$PHP_SELF" method="post" id="createAClass" name="createAClass">
                <td><input type="text" name="className" id="className" required></td>
                <td><input type="date" name="sDate" id="sDate" required</td>
                <td><input type="date" name="eDate" id="eDate" required</td>
                <td><input type="number" name="maxEnrollment" id="maxEnrollment" required </td>
                <td><input type="submit" name="createAClassSubmit" id="createAClassSubmit" value="Create Class"</td>
            </form></tr>
            <tr><td colspan="5" style="color: red">$classCreated</td></tr>
        </table>
    </div>
    <form id="signOutForm" action="$PHP_SELF" method="post">
  <input type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit">
</form>
</body>
<!-- JavaScript -->
    <script src="script/instruct.js" type="text/javascript"></script>
</html>


HTML;
