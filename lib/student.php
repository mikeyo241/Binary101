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
    $qry = "SELECT CLS_ID, CLS_NAME, CONCAT(INSTRUCT_FNAME, ' ', INSTRUCT_LNAME) AS INSTRUCT_NAME
            FROM VIEW_STUDENT_CLASSES WHERE STUD_EMAIL='$email'";
    $result = sqlQuery($qry);
    return $result;
    }

    /** Function:       getStudentGradeByClass
     * Last Modified:   21 March 2017
     * @param           $studentEmail - Email address of student
     * @param           $classID - ID of class
     * @return          int class average of student
     * Description:     This function returns the grade average given a student and class.
     */
    public function getGradeByClass($classID) {
        // Establish a connection to the database
        $link = dbConnect();
        $gradeSum = 0.0;
        $email = $this->getEmail();
        // Database Query
        $qry = "SELECT COM_SCORE FROM VIEW_GRADEBOOK WHERE CLS_ID = '$classID' AND STUD_EMAIL='$email'";
        $result = sqlQuery($qry);
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
                return 0;
            return number_format(( $gradeSum / $classTotal ), 1);
        }
        else {     // Query Failed - Error Messages Not shown !!!!
            echo "Error: " . $qry . "<br>" . mysqli_error($link);
            $link->close();
            return null;
        }
}



}