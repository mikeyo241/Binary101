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
require_once('random_compat-2.0.10/psalm-autoload.php');
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
        $qry = "INSERT INTO ACCOUNT VALUES ('$email','$pass','$fName','$lName','$accType')";
        $qry2 = "INSERT INTO $accType VALUES ('$email')";

//      *** Implement Query's   ***
        mysqli_query($link,$qry);
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
    $qry = "SELECT CLS_ID, CLS_NAME, CLS_MAXENROLLMENT FROM CLASS WHERE ACC_EMAIL = '$instructorEmail'";

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
 * @return          Numeric class average of student
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
            return "-";
        }else {
            while ($row = $result->fetch_assoc()) {
                $gradeSum = $gradeSum + $row['COM_SCORE'];
            }
        }
        $link->close();
        if ($gradeSum == 0)
            return "-";
        return number_format(( $gradeSum / $classTotal ), 1);
    }
    else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
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
        return false;
    }

}

/** Function:       enrollStudent
 * Last Modified:   21 March 2017
 * @param           $studentEmai - Student's email address
 * @param           $classID - ID of class to enroll in
 * @return          True if student is enrolled, false if else (already enrolled, etc.)
 * Description:     This function enrolls a student in a class.
 */
function enrollStudent($studentEmail, $classID) {
    // Establish a connection to the database
    $link = dbConnect();

    // Database Query
    $qry = "SELECT * FROM ENROLLMENT WHERE ACC_EMAIL='$studentEmail' AND CLS_ID='$classID'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        if (mysqli_num_rows($result) >= 1) {       // If student is enrolled, don't re-enroll
            $link->close();
            return false;
        }
        else {  // Student is not enrolled; enroll him/her
            $qry = "INSERT INTO ENROLLMENT (ACC_EMAIL, CLS_ID) VALUES ('$studentEmail', '$classID')";
            if ($result = mysqli_query($link,$qry)) {
                $link->close();
                return true;
            }
            else {     // Query Failed - Error Messages Not shown !!!!
                echo "Error: " . $qry . "<br>" . mysqli_error($link);
                $link->close();
                return false;
            }
        }
    }
    else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}

/** Function:       getStudentEnrollments
 * Last Modified:   21 March 2017
 * @param           $studentEmai - Student's email address
 * @return          Array of classes the student is enrolled in, OR false if no enrollments.
 * Description:     This function returns all the enrollments pertaining to a student.
 */
function getStudentEnrollments($studentEmail) {
    // Establish a connection to the database
    $link = dbConnect();

    // Database Query
    $qry = "SELECT * FROM VIEW_STUDENT_CLASSES WHERE STUD_EMAIL='$studentEmail'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        if (mysqli_num_rows($result) >= 1) {       // If there is 1 or more classes  return all
            $classes = array();
            $i = 0;
            while ($row = $result->fetch_assoc()) { // Create array of class arrays
                $classes[$i]["CLS_ID"] = $row["CLS_ID"];
                $classes[$i]["CLS_NAME"] = $row["CLS_NAME"];
                $classes[$i]["INSTRUCT_NAME"] = "" . $row["INSTRUCT_FNAME"] . $row["INSTRUCT_LNAME"];
                $classes[$i]["GRADE"] = getStudentGradeByClass($_SESSION['email'], $row["CLS_ID"]);
                $i++;
            }
            $link->close();
            return $classes;
        }
        else {
            $link->close();
            return false;
        }
    }
    else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}


function getClassDataById($classId){
    //      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query **
    $qry = "SELECT * FROM CLASS WHERE CLS_ID = '$classId'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
        if (mysqli_num_rows($result) == 1) {       // If there is 1 or more classes  return all the class data;
            $link->close();
            return $result;
        }
    }else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return false;
    }
}


/** Function:
 * Last Modified:
 * @param       $ -
 * @return
 * Description:
 */

function chap1() {
    echo <<< HTML
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

HTML;

}

function chap4(){
    echo <<< HTML
    <h1>Understanding Binary</h1>
    <p>Binary or base 2 is like our regular base 10 numbering system but instead using 1-10 it uses 0-1.
     As an example, counting in binary looks like this:
     <br> 0000 = 0 <br> 0001 = 1 <br> 0010 = 2 <br> 0011 = 3 <br> 0100 = 4 <br> 0101 = 5 <br> 0110 = 6 <br>
    </p>
    <h2>How is this accomplished?</h2>
    <img src="../img/binToDecimalConversion.PNG">
    <p>The binary number 0111 is converted to decimal or base 10 by taking the values of each bit and adding
     them together to get the decimal number the nibble represents. <br> This can be explained further by the video below
     from techquickie. 
    </p>
    <iframe width="560" height="315" src="https://www.youtube.com/embed/LpuPe81bc2w?rel=0&amp;controls=0&amp;showinfo=0;end=235" frameborder="0" allowfullscreen></iframe>
    <p>Flip the switches to see how turning on and off bits in the nibble changes the number.</p>
<!-- Flip the switches game by Cory Wilson!!!  -->
    <form>
      Flip the switches:<br>
      <input type="button" id="8" class="binaryButton" value="0" />
      <input type="button" id="4" class="binaryButton" value="0" />
      <input type="button" id="2" class="binaryButton" value="0" />
      <input type="button" id="1" class="binaryButton" value="0" /><br>
      Decimal Output:<br>
      <input type="text" id="decimalOutput" value="0" readonly="true">
      
   </form> 
<!-- End of Flip the Switches Game -->

    <br>
    <p>It is important to learn how to quickly calculate nibbles of binary quickly because nibbles will be used more in later chapters and later in your career.

<br>
<h2>Useful Definitions</h2>
<b>Bit</b> - a single digit of binary notation, represented either by 0 or by 1
<br>
<b>Nibble</b> - 4 bits  that can equal 0-16
<br>
<b>Byte</b> - 8 bits  0000 0000 can equal 0- 255
</p>

<h2>Try it yourself!</h2>
<h3 style="color: red;">QUIZ GAME HERE!!!</h3>
<p style="color: red">
This part should be 5 questions like What is 0010 in Decimal, 1111 in Decimal, 1001 in Decimal, 1100 in Decimal, 0011 in Decimal.
</p>

    
HTML;

}
?>