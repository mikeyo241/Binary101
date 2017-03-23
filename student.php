<?php

/******************************************************
 ***              Student Class                     ***
 ***                                                ***
 ***    Created by:         Group6 - Cory Wilson    ***
 ***    Updated:            22 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***    Document:           student.php             ***
 ***    CSS:                none                    ***
 ***    jQuery:             none                    ***
 ***                                                ***
 ******************************************************/
class Student extends Account
{

    public function Student($loginEmail) {
        Account::Account($loginEmail);
        $this->setAccountType("STUDENT");
    }

    /** Function:       getStudentEnrollments
     * Last Modified:   21 March 2017
     * @param           $studentEmail - Student's email address
     * @return          array of classes the student is enrolled in, OR false if no enrollments.
     * Description:     This function returns all the enrollments pertaining to a student.
*/
    public function getEnrollments() {
    // Establish a connection to the database
    $link = dbConnect();
    $email = $this->getEmail();
    // Database Query
    $qry = "SELECT * FROM VIEW_STUDENT_CLASSES WHERE STUD_EMAIL='rwilso16@tctc.edu'";

    if($result = mysqli_query($link,$qry)) {       // Implement query
    if (mysqli_num_rows($result) >= 1) {       // If there is 1 or more classes  return all
        $classes = array();
        $i = 0;
        while ($row = $result->fetch_assoc()) { // Create array of class arrays
            $classes[$i]["CLS_ID"] = $row["CLS_ID"];
            $classes[$i]["CLS_NAME"] = $row["CLS_NAME"];
            $classes[$i]["INSTRUCT_NAME"] = "" . $row["INSTRUCT_FNAME"] . $row["INSTRUCT_LNAME"];
            $classes[$i]["GRADE"] = getStudentGradeByClass($email, $row["CLS_ID"]);
            $i++;
        }
        $link->close();
        return $classes;
        }
        else {
            $link->close();
            return null;
        }
    }
    else {     // Query Failed - Error Messages Not shown !!!!
        echo "Error: " . $qry . "<br>" . mysqli_error($link);
        $link->close();
        return null;
    }
    }



}