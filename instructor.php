<?php

/**
 * Created by PhpStorm.
 * User: mikey
 * Date: 3/22/2017
 * Time: 1:01 AM
 */
class Instructor extends Account
{
    public function Instructor($loginEmail) {
        Account::Account($loginEmail);
        $this->setAccountType("INSTRUCTOR");
    }

    public function createClass($className, $startDate, $endDate, $maxEnrollment) {
        $className = fixSql($className);
        $startDate = fixSql($startDate);
        $endDate = fixSql($endDate);
        $maxEnrollment = fixSql($maxEnrollment);

        //      *** Establish a connection to the database  ***
        $link = dbConnect();
        $email = $this->getEmail();
        //      *** Create random integer for class ID
        $classID = rand(10000,32767);

        //      *** Database Query's  ***
        $qry = "INSERT INTO CLASS (CLS_ID, CLS_NAME, ACC_EMAIL, CLS_SDATE, CLS_EDATE, CLS_MAXENROLLMENT) VALUES ('$classID', '$className','$email','$startDate','$endDate','$maxEnrollment')";

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