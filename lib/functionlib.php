<?php
/******************************************************
 ***              Function Library                  ***
 ***                                                ***
 ***    Created by:         Group 6                 ***
 ***    Updated:            21 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***    Document:           functionlib.php         ***
 ***    CSS:                none                    ***
 ***    jQuery:             none                    ***
 ***                                                ***
 ******************************************************/
require_once('account.php');
require_once('student.php');
require_once('instructor.php');

session_start();

//  **  Variables  **
$PHP_SELF = htmlspecialchars($_SERVER['PHP_SELF']);

if(isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $fName = $user->getFirstName();
    $lName = $user->getLastName();
    $email = $user->getEmail();
}


function checkIfLoggedIn()
{
    if ($_SESSION['isLogged'] != 'TuIlI' || !$_SESSION['LOGCHECK']) {  // Make sure the user is logged in!!! This is a private page!!
        session_destroy();
        reDir('../main.php');
    }
}
/** Function:       dbConnect
 * Last Modified:   23 February 2017
 * @param string    $hostname - host name of the server.
 * @param string    $db_user - the database user name.
 * @param string    $db_pword - the database password.
 * @param string    $db_database - the database to use.
 * @return          mysqli - is the mysqli link to the server make sure to close the connection when done!
 * Description:     This is used to connect to the database unless spcified uses default values.
 */
function dbConnect($hostname = 'localhost',$db_user='CIT',$db_pword='CPT283',$db_database='Group6')
{
    $link = mysqli_connect($hostname, $db_user, $db_pword, $db_database) or die ("failed to connect");
    return $link;
}

/**  Function:      cleanIT
 * Last Modified:   23 March 2017
 * @param           string $qry - Query to send to mySQL
 * @return          bool/array - True if command was successful, array of results or null if command returns data
 * Description:		This function simplifies queries to the database.
 */
function sqlQuery($qry) {
    $link = dbConnect();
    if($result = mysqli_query($link,$qry)) {
        if (gettype($result) == "boolean") { // Query returns true/false; not values
            $link->close();
            return $result;
        } else if (mysqli_num_rows($result) == 1) {  // Query returns data
            // $result = $result->fetch_assoc();
            $link->close();
            return $result;
        } else if (mysqli_num_rows($result) > 1) {   // Query returns multiple results
            /*$i = 0;
            while ($row = $result->fetch_assoc()) { //
                $results[$i] = $row;
                $i++;
            }
            $link->close();*/
            $link->close();
            return $result;
        }
    } else {
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return null;
    }
}


/**  Function:      cleanIT
 * Last Modified:   2 November 2016
 * @param     Binarydata - Will be trim(),stripslashes(), and htmlspacialchar() so that nothing bad remains in the variable.
 * @return          string - That has been cleaned as described.
 * Description:		This function is used to test the input and stop possible security threats.
 */
function cleanIt($data) {
    $data = trim($data);					// Strip any extra white space. ex. http://php.net/manual/en/function.trim.php
    $data = stripslashes($data);			// Strip any slashes in the input.  ex. http://php.net/manual/en/function.stripslashes.php
    $data = htmlspecialchars($data);		// This changes Special characters to non html special characters.  ex. http://php.net/manual/en/function.htmlspecialchars.php
    return $data;
}

/** Function:       fixSql
 * Last Modified:   26 November 2016
 * @param           $data -  The data tha needs to be filtered.
 * @return          string - Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.
 * Description:     Used to clean any form input that will go into the database.
 */
function fixSql($data) {
    $data = cleanIt($data);
    $link = dbConnect();
    $data = mysqli_real_escape_string($link, $data);/*  Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.   */
    $link->close();
    return $data;
}
/** Function:   checkPass
 * Last Modified:   2 November 2016
 * @param       $txt -   Password    -- Before md5 Encryption --
 * @return      mixed|string - Returns a cleaned Password.
 * Description: Used to clean the user entered password.
 */
function checkPass($txt)
{
    $txt = cleanIt($txt);
    $txt = filter_var($txt, FILTER_SANITIZE_STRING);    // Strip tags, optionally strip or encode special characters.
    $txt = fixSql($txt);
    // Make sure there is no sequence.
    // Make sure the password doesn't form a word in the english language.
    // Make sure they can't put dumb passwords like 'password'
    // Check the min length requirement.
    return $txt;
}


/** Function:   checkUser
 * Last Modified:   23 February 2017
 * @param       $
 * @return
 * Description: Used to check to see if the user is looged in.
 */
function checkUser()  {
    if ( $_SESSION['islogged'] == 'TuIlI' &&  isset($_SESSION['id']) ){
        return true;
    }else {
        session_destroy();
        reDir('/index.php');
    }

}
/** Function:       checkLogin
 * Last Modified:   2 November 2016
 * @param           $email - Email address  (40 characters MAX)
 * @param           $pw -    Password    md5 Encrypted password      Always 32 characters long
 * @return          bool - Will return true if the user exists and the password is correct.
 * Description:     This function is used to determine if the Email and password entered on the
 *                  login page match the username and password in the database.
 */
function deleteExpiredTempPassword() {
    $link = dbConnect();

    $qry = "UPDATE ACCOUNT SET ACC_TEMP_PASS = NULL , ACC_TEMP_PASS_EXPIRES= NULL WHERE ACC_TEMP_PASS_EXPIRES < NOW()";

    if(mysqli_query($link,$qry)){
        $link->close();
        return true;
    }else {
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}
function checkLogin($id , $pass){
    deleteExpiredTempPassword();
//      ** Check input for database exploits **
    $id = fixSql($id);
    $pass = md5(fixSql($pass));
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's    ***
    $qry = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = '$id'";


    if($result = mysqli_query($link,$qry)) {                // Implement the query
        if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
            $res = mysqli_fetch_assoc($result);             // Put the result into an array
            if($pass == $res['ACC_PASS'] && $id == $res['ACC_EMAIL']) return 'normalLogin';
            else if ($pass ==$res['ACC_TEMP_PASS'] && $id == $res['ACC_EMAIL'] && $res['ACC_TEMP_PASS_EXPIRES'] != NULL) return "tempPassUsed";
            else return "Wrong Email or Password";
        }
    }else {             // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
    return false;
}

function getUser($id , $pass){
//      ** Check input for database exploits **
    $id = fixSql($id);
    $pass = md5(fixSql($pass));
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's    ***
    $qry = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = '$id'";

    if($result = mysqli_query($link,$qry)) {                // Implement the query
        if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
            $res = mysqli_fetch_assoc($result);             // Put the result into an array
            if($pass == $res['ACC_PASS'] && $id == $res['ACC_EMAIL']) {
                if ($res['ACC_TYPE'] == "STUDENT")
                    return new Student($id);
                else
                    return new Instructor($id);
            }
        }
    }else {             // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return null;
    }
    return null;
}


function reDir($location) {
    header("Location: $location");
}

function checkClass($email, $className) {
    $className = fixSql($className);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query **
    $qry = "SELECT CLS_NAME FROM CLASS WHERE ACC_EMAIL = '$email' and CLS_NAME = '$className'";

    if ($result = mysqli_query($link, $qry)) {       // Implement query
        if (mysqli_num_rows($result) >= 1) {       // If there is 1 or more clans with the name entered return all the clans with that name
            $link->close();
            return false;
        }else return true;
    } else {     // Query Failed - Error Messages Not shown !!!!
//        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}
function checkCourse($classID) {

//      ** Check input for database exploits **
    $classID = fixSql($classID);

//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query **
    $qry = "SELECT CRS_ID, CRS_NAME FROM COURSE WHERE CLS_ID = '$classID'";

    if ($result = mysqli_query($link, $qry)) {       // Implement query
        if (mysqli_num_rows($result) >= 1) {       // If there is 1 or more clans with the name entered return all the clans with that name
            $link->close();
            return $result;
        }
    } else {     // Query Failed - Error Messages Not shown !!!!
//        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}

function checkStudentsEnrolled($classID) {
//      ** Check input for database exploits **
    $classID = fixSql($classID);

//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query **
    $qry = "SELECT ACC_EMAIL FROM ENROLLMENT WHERE CLS_ID = '$classID'";

    if ($result = mysqli_query($link, $qry)) {       // Implement query
        if (mysqli_num_rows($result) >= 1) {       // If there is 1 or more clans with the name entered return all the clans with that name
            $students = mysqli_num_rows($result);
            $total = 0;
            foreach($result as $grade){
                $total = $total + $grade;
            }
            $averageGrade = $total / $students;
            $returnValue = array ( $students , $averageGrade);
            $link->close();
            return $returnValue;
        }
    } else {     // Query Failed - Error Messages Not shown !!!!
//        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}

function checkEMail($eMail) {
//      ** Check input for database exploits **
    fixSql($eMail);

//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's    ***
    $qry = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = '$eMail'";

    if($result = mysqli_query($link,$qry)) {                // Implement the query
        if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
            $link->close();
            return false;
        }else if (mysqli_num_rows($result) == 0) {
            $link->close();
            return true;}
    }else {             // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
    return false;
}


function createAccount ($fName, $lName,  $email, $pass, $accType) {

    $email = fixSql($email);

    if(checkEMail($email)) {
        $fName = fixSql($fName);
        $lName = fixSql($lName);
        $pass = fixSql($pass);
        $accType = fixSql($accType);

        if (checkPass($pass)) {
            $pass = md5($pass);
        }

//      *** Establish a connection to the database  ***
        $link = dbConnect();

//      *** Database Query's  ***
        $qry = "INSERT INTO ACCOUNT(ACC_EMAIL, ACC_PASS, ACC_FNAME, ACC_LNAME, ACC_TYPE) VALUES ('$email','$pass','$fName','$lName','$accType')";
        $qry2 = "INSERT INTO $accType VALUES ('$email')";

//      *** Implement Query's   ***
        if (mysqli_query($link,$qry)){}else {
            echo "Error: " . $qry . "<br>" . mysqli_error($link);
            $link->close();
            return false;
        }
        mysqli_query($link,$qry2);

//      ***     Close Connection    ***
        $link->close();
        return true;
    }else return false;
}

function getClassNum($instructorEmail) {
    if ($instructorEmail == 'test@testing.com') return 1;
    $link = dbConnect();

    // db query
    $qry = "SELECT CLS_ID FROM CLASS WHERE ACC_EMAIL = '$instructorEmail' ";

    // query that code
    if($result = mysqli_query($link,$qry)) {
        $classes = mysqli_num_rows($result);
        $link->close();
        return $classes;
    } else {
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}


/**Function:        getClassData()
 * Last Modified:   20 March 2017
 * Description:     This function searches for a specified class and returns the data associated with the class from the database.
 */
function getClassData($instructorEmail){
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query **
    $qry = "SELECT CLS_ID, CLS_NAME, CLS_MAXENROLLMENT FROM CLASS WHERE ACC_EMAIL = '$instructorEmail' ORDER BY CLS_NAME";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        if (mysqli_num_rows($result) >= 1) {       // If there is 1 or more classes  return all the class data;
            $link->close();
            return $result;
        }
    }else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}

function getStudentEnrollment($classID) {
    //      *** Establish a connection to the database  ***
    $link = dbConnect();
//      *** Database Query **
    $qry = "SELECT * FROM ENROLLMENT WHERE CLS_ID = '$classID'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        $studentsEnrolled = mysqli_num_rows($result);
        $link->close();
        return $studentsEnrolled;
    }
    else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}

function getClassAverage($classID) {
    //      *** Establish a connection to the database  ***
    $link = dbConnect();
    $gradeSum = 0.0;

//      *** Database Query **
    $qry = "SELECT COM_SCORE FROM VIEW_CLASS_GRADES WHERE CLS_ID = '$classID'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        $classTotal = mysqli_num_rows($result);
        if(mysqli_num_rows($result) == 0) {
            return -1;
        }else {
            while ($row = $result->fetch_assoc()) {
                $gradeSum = $gradeSum + $row['COM_SCORE'];
            }
        }
        $link->close();
        return ( $gradeSum / $classTotal );
    }
    else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}
/**
 * Generate a random string, using a cryptographically secure
 * pseudorandom number generator (random_int)
 *
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 *
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

function checkClassID($classID){
    $link = dbConnect();

    $qry = "SELECT * FROM CLASS WHERE CLS_ID = '$classID' ";

    // query that code
    if($result = mysqli_query($link,$qry)) {
        if(mysqli_num_rows($result) >= 1) {
            $link->close();
            return false;

        }else return true;
    } else {
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}



/** Function:       getStudentGradeByClass
 * Last Modified:   21 March 2017
 * @param           $studentEmail - Email address of student
 * @param           $classID - ID of class
 * @return          int class average of student
 * Description:     This function returns the grade average given a student and class.
 */
function getStudentGradeByClass($studentEmail, $classID) {
    // Establish a connection to the database
    $link = dbConnect();
    $gradeSum = 0.0;

    // Database Query
    $qry = "SELECT COM_SCORE FROM VIEW_GRADEBOOK WHERE CLS_ID = '$classID' AND STUD_EMAIL='$studentEmail'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        $classTotal = mysqli_num_rows($result);
        if(mysqli_num_rows($result) == 0) {
            return -1;
        }else {
            while ($row = $result->fetch_assoc()) {
                $gradeSum = $gradeSum + $row['COM_SCORE'];
            }
        }
        $link->close();
        if ($gradeSum == 0)
            return -1;
        return number_format(( $gradeSum / $classTotal ), 1);
    }
    else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return null;
    }
}

/** Function:       getClassByID
 * Last Modified:   21 March 2017
 * @param           $classID - ID of class
 * @return          Array containing class details
 * Description:     This function returns information pertaining to a class.
 */
function getClassByID($classID) {
    // Establish a connection to the database
    $link = dbConnect();

    // Database Query
    $qry = "SELECT CLS_ID, CLS_NAME, CLS_MAXENROLLMENT, INSTRUCT_FNAME, INSTRUCT_LNAME FROM VIEW_CLASSES WHERE CLS_ID LIKE '$classID'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        if (mysqli_num_rows($result) >= 1) {       // If there is 1 or more classes  return all the class data;
            $link->close();
            return $result;
        }
    }else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return null;
    }
}

/** Function:       searchClasses
 * Last Modified:   21 March 2017
 * @param           $classID - ID of class
 * @return          array containing class details
 * Description:     This function searches classes by ID and instructor name.
 */
function searchClasses($searchInput) {
    // Database Queries to check
    $qry = "SELECT CLS_ID, CLS_NAME, INSTRUCT_FNAME, INSTRUCT_LNAME FROM VIEW_CLASS 
            WHERE CLS_ID LIKE '$searchInput' OR INSTRUCT_FNAME LIKE '$searchInput' 
            OR INSTRUCT_LNAME LIKE '$searchInput' OR CONCAT_WS(INSTRUCT_FNAME, ' ', INSTRUCT_LNAME) LIKE '$searchInput'";
    $result = sqlQuery($qry);
    return $result;
}





/** Function:       enrollStudent
 * Last Modified:   21 March 2017
 * @param           $studentEmail - Student's email address
 * @param           $classID - ID of class to enroll in
 * @return          True if student is enrolled, false if else (already enrolled, etc.)
 * Description:     This function enrolls a student in a class.
 */
function enrollStudent($studentEmail, $classID) {
    // Establish a connection to the database
    $link = dbConnect();

    // Database Query
    $qry = "SELECT * FROM ENROLLMENT WHERE ACC_EMAIL='$studentEmail' AND CLS_ID='$classID'";
    $result = sqlQuery($qry);
    if ($result != null)
        return false;
    $qry = "INSERT INTO ENROLLMENT (ACC_EMAIL, CLS_ID) VALUES ('$studentEmail', '$classID')";
    sqlQuery($qry);
    return true;
}

function getCourses() {
    $qry = "SELECT * FROM COURSE";
    $result = sqlQuery($qry);
    return $result;
}


?>