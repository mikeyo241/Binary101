<?php

/******************************************************
 ***              Student Class                     ***
 ***                                                ***
 ***    Created by:         Group6 - Cory Wilson    ***
 ***    Updated:            11 April 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***    Document:           classroom.php             ***
 ***    CSS:                none                    ***
 ***    jQuery:             none                    ***
 ***                                                ***
 ******************************************************/
class Classroom {

    private $CLS_ID;
    private $CLS_NAME;
    private $CLS_MAXENROLLMENT;
    private $INSTRUCT_FNAME;
    private $INSTRUCT_LNAME;
    private $INSTRUCT_NAME;

    public function Classroom($classID) {
        // Database Query
        $qry = "SELECT CLS_ID, CLS_NAME, CLS_MAXENROLLMENT, INSTRUCT_FNAME, INSTRUCT_LNAME FROM VIEW_CLASSES WHERE CLS_ID LIKE '$classID'";
        $result = sqlSelect($qry)->fetch_assoc();
        if ($result != null) {
            $this->CLS_ID = $result['CLS_ID'];
            $this->CLS_NAME = $result['CLS_NAME'];
            $this->CLS_MAXENROLLMENT = $result['CLS_MAXENROLLMENT'];
            $this->INSTRUCT_FNAME = $result['INSTRUCT_FNAME'];
            $this->INSTRUCT_LNAME = $result['INSTRUCT_LNAME'];
            $this->INSTRUCT_NAME = "" . $result['INSTRUCT_LNAME'] . ", " . $result['INSTRUCT_FNAME'];
        }
        else
            return null;
    }

    public function getCLS_ID() {
        return $this->CLS_ID;
    }
    public function getCLS_NAME() {
        return $this->CLS_NAME;
    }
    public function getCLS_MAXENROLLMENT() {
        return $this->CLS_MAXENROLLMENT;
    }
    public function getINSTRUCT_FNAME() {
        return $this->INSTRUCT_FNAME;
    }
    public function getINSTRUCT_LNAME() {
        return $this->INSTRUCT_LNAME;
    }
    public function getINSTRUCT_NAME() {
        return $this->INSTRUCT_NAME;
    }


    public function getStudentEnrollment() {
        $classID = $this->getCLS_ID();
//      *** Database Query **
        $qry = "SELECT * FROM ENROLLMENT WHERE CLS_ID = '$classID'";
        $result = sqlSelect($qry);
        if($result != null) {       // Implement query
            $studentsEnrolled = mysqli_num_rows($result);
            return $studentsEnrolled;
        }
        return 0;   // No enrollment
    }

    public function getClassAverage($classID) {

        $gradeSum = 0.0;
        $classID = $this->getCLS_ID();

//      *** Database Query **
        $qry = "SELECT COM_SCORE FROM VIEW_CLASS_GRADES WHERE CLS_ID = '$classID'";
        $result = sqlSelect($qry);
        if($result != null) {       // Implement query
            $classTotal = mysqli_num_rows($result);
            if(mysqli_num_rows($result) == 0) {
                return -1;
            }else {
                while ($row = $result->fetch_assoc()) {
                    $gradeSum = $gradeSum + $row['COM_SCORE'];
                }
            }
            return ( $gradeSum / $classTotal );
        }
        else
            return null;
    }





}