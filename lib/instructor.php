<?php

/******************************************************
 ***              Instructor Class                  ***
 ***                                                ***
 ***    Created by:         Group6 - Cory Wilson    ***
 ***    Updated:            22 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***    Document:           instructor.php          ***
 ***    CSS:                none                    ***
 ***    jQuery:             none                    ***
 ***                                                ***
 ******************************************************/
class Instructor extends Account
{
    public function Instructor($loginEmail) {
        Account::Account($loginEmail);
        $this->setAccountType("INSTRUCTOR");
    }

    public function createClass($className, $instructorEmail, $startDate, $endDate, $maxEnrollment ) {
        $className = fixSql($className);    $instructorEmail = fixSql($instructorEmail);    $startDate = fixSql($startDate);
        $endDate = fixSql($endDate);    $maxEnrollment = fixSql($maxEnrollment);

//      *** Establish a connection to the database  ***
        $link = dbConnect();
        do{
            $classID = random_str(20);
        }while(!checkClassID($classID));
//      *** Database Query's  ***
        $qry = "INSERT INTO CLASS VALUES ('$classID','$className','$instructorEmail','$startDate','$endDate','$maxEnrollment')";

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