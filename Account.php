<?php

/**
 * Created by PhpStorm.
 * User: mikey
 * Date: 3/22/2017
 * Time: 12:57 AM
 */

class Account {
<<<<<<< HEAD
    private $email;
    private $fName;
    private $lName;
    private $accountType;

    public function Account($loginEmail) {
        $this->email = $loginEmail;
        $this->getAccountInfo($loginEmail);

    }

    public function getPassword() { return $this->password; }
    public function getEmail() { return $this->email; }
    public function getFirstName() { return $this->fName; }
    public function getLastName() { return $this->lName; }
    public function getAccountType() { return $this->accountType; }
    public function setAccountType($accountType){$this->accountType = $accountType;}


    public function changePassword($pass){
        $pass = fixSql($pass);
        if (checkPass($pass)){
            $pass = md5($pass);
            $email = $this->email;
            //      *** Establish a connection to the database  ***
            $link = dbConnect();

            //      *** Database Query's  ***
            $qry = "UPDATE ACCOUNT SET ACC_PASS = '$pass' WHERE ACC_EMAIL = '$email'";

            //      *** Implement Query's   ***
            mysqli_query($link, $qry);

            //      ***     Close Connection    ***
            $link->close();
            $this->password = $pass;
            return true;

        }else return false;
    }

    public function changeFName($fName){
        $fName = fixSql($fName);
        //      *** Establish a connection to the database  ***
        $link = dbConnect();
        $email = $this->email;

        //      *** Database Query's  ***
        $qry = "UPDATE ACCOUNT SET ACC_FNAME = '$fName' WHERE ACC_EMAIL = '$email'";

        //      *** Implement Query's   ***
        mysqli_query($link, $qry);
        $this->fName = $fName;
        //      ***     Close Connection    ***
        $link->close();
        return true;
    }

    public function changeLName($lName){
        $lastName = fixSql($lName);
        //      *** Establish a connection to the database  ***
        $link = dbConnect();
        $email = $this->email;

        //      *** Database Query's  ***
        $qry = "UPDATE ACCOUNT SET ACC_LNAME = '$lastName' WHERE ACC_EMAIL = '$email'";

        //      *** Implement Query's   ***
        mysqli_query($link, $qry);
        $this->lName = $lName;
        //      ***     Close Connection    ***
        $link->close();
        return true;
    }
    function createAccountType($accountType){    // This also needs to drop the email from the original and put it in the new account type!
        $accountType = fixSql($accountType);
=======
   private $email;
   private $fName;
   private $lName;
   private $accountType;

   public function Account($loginEmail, $fName, $lName) {
      $this->email = $loginEmail;
      $this->fName = $fName;
      $this->lName = $lName;
   }

   public function getEmail() { return $this->email; }
   public function getFirstName() { return $this->fName; }
   public function getLastName() { return $this->lName; }
   public function getAccountType() { return $this->accountType; }

   public function setPassword($pass){
       $pass = fixSql($pass);
       if (checkPass($pass)){
           $pass = md5($pass);
           //      *** Establish a connection to the database  ***
           $link = dbConnect();

   //      *** Database Query's  ***
           $qry = "UPDATE ACCOUNT SET ACC_PASS = '$pass' WHERE ACC_EMAIL = '$this->email'";

   //      *** Implement Query's   ***
           mysqli_query($link, $qry);

   //      ***     Close Connection    ***
           $link->close();
           return true;

       }else return false;
   }

   public function setFirstName($fName){
      $fName = fixSql($fName);
      //      *** Establish a connection to the database  ***
      $link = dbConnect();

      //      *** Database Query's  ***
      $qry = "UPDATE ACCOUNT SET ACC_FNAME = '$fName' WHERE ACC_EMAIL = '$this->email'";

      //      *** Implement Query's   ***
      mysqli_query($link, $qry);
      $this->fName = $fName;
      //      ***     Close Connection    ***
      $link->close();
      return true;
   }

   public function setLastName($lName){
      $lastName = fixSql($lName);
      //      *** Establish a connection to the database  ***
      $link = dbConnect();

      //      *** Database Query's  ***
      $qry = "UPDATE ACCOUNT SET ACC_LNAME = '$lastName' WHERE ACC_EMAIL = '$this->email'";

      //      *** Implement Query's   ***
      mysqli_query($link, $qry);
      $this->lName = $lName;
      //      ***     Close Connection    ***
      $link->close();
      return true;
   }

   function setAccountType($accountType){
    $accountType = fixSql($accountType);
>>>>>>> origin/master
//      *** Establish a connection to the database  ***
        $link = dbConnect();

//      *** Database Query's  ***
        $qry = "UPDATE ACCOUNT SET ACC_TYPE = '$accountType' WHERE ACC_USERNAME = '$this->email'";

//      *** Implement Query's   ***
        mysqli_query($link, $qry);

//      ***     Close Connection    ***
<<<<<<< HEAD
        $link->close();
        $this->accountType = $accountType;
        return true;
    }

    function getAccountInfo($email){
//      ** Check input for database exploits **
        $id = fixSql($email);

//      *** Establish a connection to the database  ***
        $link = dbConnect();

//      *** Database Query's    ***
        $qry = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = '$email'";

        if($result = mysqli_query($link,$qry)) {                // Implement the query
            if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
                $res = mysqli_fetch_assoc($result);             // Put the result into an array
                $this->fName = $res['ACC_FNAME'];
                $this->lName = $res{'ACC_LNAME'};
                $this->accountType = $res['ACC_TYPE'];

            }
        }else {             // Query Failed - Error Messages Not shown !!!!
=======
    $link->close();
    $this->accountType = $accountType;
    return true;
}
}

class Student extends Account {
   public function Student($loginEmail, $fName, $lName) {
      Account::Account($loginEmail, $fName, $lName);
      $this->accountType = "STUDENT";
   }

   /** Function:       getStudentEnrollments
    * Last Modified:   21 March 2017
    * @param           $studentEmai - Student's email address
    * @return          Array of classes the student is enrolled in, OR false if no enrollments.
    * Description:     This function returns all the enrollments pertaining to a student.
    */
    public function getEnrollments() {
       // Establish a connection to the database
       $link = dbConnect();

       // Database Query 
       $qry = "SELECT * FROM VIEW_STUDENT_CLASSES WHERE STUD_EMAIL='$this->email'";

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


}

class Instructor extends Account {
   public function Instructor($loginEmail, $fName, $lName) {
      Account::Account($loginEmail, $fName, $lName);
      $this->accountType = "INSTRUCTOR";
   }

   public function createClass($className, $startDate, $endDate, $maxEnrollment) {
      $className = fixSql($className);     
      $startDate = fixSql($startDate);
      $endDate = fixSql($endDate);    
      $maxEnrollment = fixSql($maxEnrollment);

      //      *** Establish a connection to the database  ***
      $link = dbConnect();

      //      *** Create random integer for class ID
      $classID = rand(111111111,999999999);

      //      *** Database Query's  ***
      $qry = "INSERT INTO CLASS (CLS_ID, CLS_NAME, ACC_EMAIL, CLS_SDATE, CLS_EDATE, CLS_MAXENROLLMENT) VALUES ('$classID', '$className','$this->email','$startDate','$endDate','$maxEnrollment')";

      //      *** Implement Query   ***
      if(mysqli_query($link,$qry)) {
         //      ***     Close Connection    ***
         $link->close();
         return true;
         } else {
            //      ***     Close Connection    ***
>>>>>>> origin/master
            echo "Error: " . $qry . "<br>" . mysqli_error($link);
            $link->close();
            return null;
        }
        return null;
    }

}