<?php
require('../vendor/paragonie/random_compat/psalm-autoload.php');
require('../lib/functionlib.php');



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

checkIfLoggedIn();


$classCreated = '';
$classesStyle = 'display: block;';

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
            $classCreation = $user->createClass($_POST['className'], $email, $_POST['sDate'], $_POST['eDate'], $_POST['maxEnrollment']);
            if($classCreation != false){
                $classCreated = 'Class Created Successfully';
                $courses = getCourses();
                while ($row = $courses->fetch_assoc()) {
                    $CRS_ID = $row["CRS_ID"];
                    $checkbox = "check_" . $CRS_ID;
                    if (isset($_POST["$checkbox"])) {
                        $result = $user->addCourseToClass($classCreation, $CRS_ID);
                    }
                }
            }
            else
                $classCreated = 'Class was not created successfully';
        }
        else
            $classCreated = 'Duplicate Class Name';

    }
    if(isset($_POST['submitGradeBook']) && isset($_POST['class'])){
        $_SESSION['classID'] = $_POST['class'];
        reDir('gradeBook.php');
    }
    if (isset($_POST['courseSubmit'])) {
        $courses = getCourses();
    }
}

if (getClassData($email) != false) {

    $searchResult = getClassData($email);
    if ($searchResult->num_rows > 0) {
        $i = 0;
        while ($row = $searchResult->fetch_assoc()) {
            $class = new Classroom($row['CLS_ID']);
            $clsID = $class->getCLS_ID();
            $className = $class->getCLS_NAME();
            $totalStudents = $class->getStudentEnrollment();
            $maxEnrollment = $class->getCLS_MAXENROLLMENT();
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
    <meta name="author" content="Group 6" />
    <meta name="owner" content="Michael Gardner, Nathaniel Merck, Christian Cook, Cory Wilson" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- All Links, Meta data, scripts, and css goes inside the <head> tags.  -->
<!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="instructAssets/styles/instruct.css"/>
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
   
       <div id="space">
            <!--   for separating other divs    -->
        </div>

        <div id="classes" class="col-md-8" name="classes" style="$classesStyle">
        <h2 id="classesTitle">Current Classes</h2>
            <table id="classesTable" border="5">  <!-- Remove the Styling for the table and make your own! -->
                <thead>
                    <td>Select</td>
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
            
                <!-- where input submit was before i moved it  ~Nathaniel   -->
                
            </table>
        </div>
        
        <div id="space1">
            <input value="View Grade Book" type="submit" id="submitGradeBook" name="submitGradeBook">
        </div>
        </form>
    
        <div id="createAClass">
            <table id="createTable">
            <h2 id="createClassTitle">Create a new Class</h2>
                <thead>
                <td>Class Name</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Maximum Enrollment</td>
                <td> </td>
                </thead>
                <tr><form action="$PHP_SELF" method="post" id="createAClass" name="createAClass">
                    <td><input type="text" name="className" id="className" required></td>
                    <td><input type="date" name="sDate" id="sDate" required</td>
                    <td><input type="date" name="eDate" id="eDate" required</td>
                    <td><input type="number" name="maxEnrollment" id="maxEnrollment" required </td>
                    <td><input type="submit" name="createAClassSubmit" id="createAClassSubmit" value="Create Class"</td>
                    <td colspan="2" style="color: red">$classCreated</td>
            </table>
            <h3 id="selectTitleBABY">Select Required Chapters</h3>
            <table id="chapterTable" border="5">
                <thead>
                    <td>Course Name</td><td>Action</td>
                </thead>
HTML;
            $courses = getCourses();
            while ($row = $courses->fetch_assoc()) {
                echo "<tr>";
                $CRS_NAME = $row["CRS_NAME"];
                $CRS_ID = $row["CRS_ID"];
                echo "<td>$CRS_NAME</td>";
                echo <<< HTML
                <td>
                <input type="checkbox" name="check_$CRS_ID" checked />
                <input type="hidden" name="CRS_ID" value="$CRS_ID"  />
                </td></tr>
HTML;
            }
echo <<< HTML

    </form>
            </table>
        </div>
        
        <div id="space">
            <!--   for separating other divs    -->
        </div>
    
    
        <form id="signOutForm" action="$PHP_SELF" method="post">
            <input type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit">
        </form>
        
        <div id="space">
            <!--   for separating other divs    -->
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
<!-- JavaScript -->
    <script src="script/instruct.js" type="text/javascript"></script>
</html>

HTML;

