<?php
require_once('functionlib.php');

class Account {
   public $email;
   public $password;
   public $fName;
   public $lName;
   public $accountType;

   public function Account($loginEmail, $password, $fName, $lName) {
      $this->email = $loginEmail;
      $this->password = $password;
      $this->fName = $fName;
      $this->lName = $lName;
   }

   public function getPassword() { return $this->password; }
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
           $this->password = $pass;
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
      $lastName = fixSql($lastName);
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
//      *** Establish a connection to the database  ***
    $link = dbConnect();

//      *** Database Query's  ***
    $qry = "UPDATE ACCOUNT SET ACC_TYPE = '$accountType' WHERE ACC_USERNAME = '$this->email'";

//      *** Implement Query's   ***
    mysqli_query($link, $qry);

//      ***     Close Connection    ***
    $link->close();
    $this->accountType = $accountType;
    return true;
}
}

class Student extends Account {
   public function Student($loginEmail, $pass, $fName, $lName) {
      Account::Account($loginEmail, $pass, $fName, $lName);
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
   public function Instructor($loginEmail, $pass, $fName, $lName) {
      Account::Account($loginEmail, $pass, $fName, $lName);
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
      $classID = rand(10000,32767);

      //      *** Database Query's  ***
      $qry = "INSERT INTO CLASS (CLS_ID, CLS_NAME, ACC_EMAIL, CLS_SDATE, CLS_EDATE, CLS_MAXENROLLMENT) VALUES ('$classID', '$className','$this->email','$startDate','$endDate','$maxEnrollment')";

      //      *** Implement Query   ***
      if(mysqli_query($link,$qry)) {
         //      ***     Close Connection    ***
         $link->close();
         return true;
         } else {
            //      ***     Close Connection    ***
            echo "Error: " . $qry . "<br>" . mysqli_error($link);
            $link->close();
            return false;
         }
      }
}

?>