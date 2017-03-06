<?php
/******************************************************
 ***              Function Library                  ***
 ***                                                ***
 ***    Created by:         Group 6                 ***
 ***    Updated:            2 March 2017            ***
 ***    Class:              CPT - 264-002           ***
 ***    Document:           functionlib.php         ***
 ***    CSS:                none                    ***
 ***    jQuery:             none                    ***
 ***                                                ***
 ******************************************************/


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

$PHP_SELF = htmlspecialchars($_SERVER['PHP_SELF']);
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

/*function addAccount($){


    }
*/
function reDir($location) {
    header("Location: $location");
}
function checkUsername($un) {

}


function createAccount ($fName, $mName, $lName, $email, $pass, $accType, $schoolName, $prefix, $suffix,
                        $birthMonth, $birthYear, $birthday, $schoolID, $userName)
{
    if(checkUsername($userName)) {
        $fName = fixSql($fName);
        $mName = fixSql($mName);
        $lName = fixSql($lName);
        $email = fixSql($email);
        $pass = fixSql($pass);
        $accType = fixSql($accType);
        $schoolName = fixSql($schoolName);
        $prefix = fixSql($prefix);
        $suffix = fixSql($suffix);
        $birthMonth = fixSql($birthMonth);
        $birthday = fixSql($birthday);
        $birthYear = fixSql($birthYear);
        $schoolID = fixSql($schoolID);

//      *** Establish a connection to the database  ***
        $link = dbConnect();

//      *** Database Query's  ***
        $qry = "INSERT";

//      *** Implement Query's   ***
        mysqli_query($link, $qry);

//      ***     Close Connection    ***
        $link->close();
        return true;
    }
}

function getFirstName($userID){

}

function setFirstName($userID, $fName){
    $fName = fixSql($fName);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_FNAME = '$fName' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getMiddleName(){}
function setMiddleName($middleName, $userID){
    $middleName = fixSql($middleName);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_MIDDLE = '$middleName' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getLastName(){}
function setLastName($lastName, $userID){
    $lastName = fixSql($lastName);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_LNAME = '$lastName' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getEmail(){}
function setEmail($email, $userID){
    $email = fixSql($email);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE EMAIL SET EMA_ADDRESS = '$email' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;}
function getPassword(){}
function setPassword($pass, $userID){
    $pass = fixSql($pass);
    if (checkPass($pass)){
        $pass = md5($pass);
        //      *** Establish a connection to the database  ***
        $link = dbConnect();

//      *** Database Query's  ***
        $qry = "UPDATE ACCOUNT SET ACC_PASS = '$pass' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
        mysqli_query($link, $qry);

//      ***     Close Connection    ***
        $link->close();
        return true;

    }else return false;
}
function getAccountType(){}
function setAccountType($accountType, $userID){
    $accountType = fixSql($accountType);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_TYPE = '$accountType' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getSchoolName(){}
function setSchoolName($schoolName, $userID){
    $schoolName = fixSql($schoolName);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_SCHOOLNAME = '$schoolName' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getPrefix(){}
function setPrefix($prefix, $userID){
    $prefix = fixSql($prefix);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_PREFIX = '$prefix' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getSuffix(){}
function setSuffix($suffix,$userID){
    $suffix = fixSql($suffix);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_SUFFIX = '$suffix' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getBirthday(){}
function setBirthday($month, $day, $year, $userID){
    $month = fixSql($month);
    $day = fixSql($day);
    $year = fixSql($year);

    $birthdaySuit = $year . "-" . $month . "-" . $day;

//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_DOB = '$birthdaySuit' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
}

function getSchoolID(){}
function setSchoolID($schoolID, $userID){
    $schoolID = fixSql($schoolID);
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_SCHOOLID = '$schoolID' WHERE ACC_USERNAME = '$userID'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    return true;
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