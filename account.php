<?php

/******************************************************
 ***              Account Class                     ***
 ***                                                ***
 ***    Created by:         Group6 - Cory Wilson    ***
 ***    Updated:            22 March 2017           ***
 ***    Class:              CPT - 264-002           ***
 ***    Document:           account.php             ***
 ***    CSS:                none                    ***
 ***    jQuery:             none                    ***
 ***                                                ***
 ******************************************************/
class account
{
    // Private Variables
    private $email;
    private $fName;
    private $lName;
    private $accountType;
    private $resetLink;
    private $resetExpires;

    // Constructor
    public function Account($loginEmail) {
        $this->email = $loginEmail;
        $this->getAccountInfo($loginEmail);
    }

    public function getEmail() { return $this->email; }
    public function getFirstName() { return $this->fName; }
    public function getLastName() { return $this->lName; }
    public function getAccountType() { return $this->accountType; }
    public function getResetLink(){ return $this->resetLink;}
    public function setAccountType($accountType){$this->accountType = $accountType;}
    public function setResetLink($resetLink = null){$this->resetLink = $resetLink;}


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
    public function createResetLink(){
        $randomString = random_str(25);
        $resetLink = "http://".$_SERVER['HTTP_HOST']."/~mgardne1/Group6/Binary101/forgotPassword/CNP56r.php?tRiD45=".$randomString;
        $resetLink = fixSql($resetLink);
        //      *** Establish a connection to the database  ***
        $link = dbConnect();
        $email = $this->email;

        //      *** Database Query's  ***
        $qry = "UPDATE ACCOUNT SET ACC_RESET_LINK = '$resetLink', ACC_RESET_EXPIRES= NOW() + INTERVAL 8 HOUR WHERE ACC_EMAIL = '$email'";

        //      *** Implement Query's   ***
        mysqli_query($link, $qry);
        $this->resetLink = $resetLink;
        //      ***     Close Connection    ***
        $link->close();
        return $resetLink;
    }
    function createAccountType($accountType){    // This also needs to drop the email from the original and put it in the new account type!
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

    function getAccountInfo($email){
//      ** Check input for database exploits **
        $id = fixSql($email);

//      *** Establish a connection to the database  ***
        $link = dbConnect();

//      *** Database Query's    ***
        $qry = "SELECT * FROM ACCOUNT WHERE ACC_EMAIL = '$email'";
        // Make sure that there isn't any password reset keys in the database!
        $qry2 = "UPDATE ACCOUNT SET ACC_RESET_LINK = NULL , ACC_RESET_EXPIRES= NULL WHERE ACC_RESET_EXPIRES < NOW()";
        mysqli_query($link, $qry2);
        if($result = mysqli_query($link,$qry)) {                // Implement the query
            if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
                $res = mysqli_fetch_assoc($result);             // Put the result into an array
                $this->fName = $res['ACC_FNAME'];
                $this->lName = $res{'ACC_LNAME'};
                $this->accountType = $res['ACC_TYPE'];
                $this->resetLink = $res['ACC_RESET_LINK'];
                $this->resetExpires = $res['ACC_RESET_EXPIRES'];
                $link->close();
            }
        }else {             // Query Failed - Error Messages Not shown !!!!
            echo "Error: " . $qry . "<br>" . mysqli_error($link);
            $link->close();
        }
    }
}