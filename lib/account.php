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
    private $tempPass;
    private $tempPassReset;

    // Constructor
    public function Account($loginEmail) {
        $this->email = $loginEmail;
        $this->getAccountInfo($loginEmail);
    }

    public function getEmail() { return $this->email; }
    public function getFirstName() { return $this->fName; }
    public function getLastName() { return $this->lName; }
    public function getAccountType() { return $this->accountType; }
    public function getTempPass(){ return $this->tempPass;}
    public function setAccountType($accountType){$this->accountType = $accountType;}
    public function setTempPass($tempPass = null){$this->tempPass = $tempPass;}
    public function setTempPassReset($tempPassReset = null){$this->tempPassReset = $tempPassReset;}

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
    public function createTemporaryPassword(){
        $randomString = random_str(14);
        $temporaryPassword = $randomString;
        $md5_temp_pass = md5($randomString);
        //      *** Establish a connection to the database  ***
        $link = dbConnect();
        $email = $this->email;

        //      *** Database Query's  ***
        $qry = "UPDATE ACCOUNT SET ACC_TEMP_PASS = '$md5_temp_pass', ACC_TEMP_PASS_EXPIRES= NOW() + INTERVAL 1 HOUR WHERE ACC_EMAIL = '$email'";

        //      *** Implement Query's   ***
        if(mysqli_query($link, $qry)) {
            $this->tempPass = $temporaryPassword;
            //      ***     Close Connection    ***
            $link->close();
            return $temporaryPassword;
        }else {
            echo "Error: " . $qry . "<br>" . mysqli_error($link);
            $link->close();
            return false;
        }

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

        if($result = mysqli_query($link,$qry)) {                // Implement the query
            if (mysqli_num_rows($result) == 1) {                // There can only be 1 entry for email no duplicates.
                $res = mysqli_fetch_assoc($result);             // Put the result into an array
                $this->fName = $res['ACC_FNAME'];
                $this->lName = $res{'ACC_LNAME'};
                $this->accountType = $res['ACC_TYPE'];
                $this->tempPass = $res['ACC_TEMP_PASS'];
                $this->tempPassReset = $res['ACC_TEMP_PASS_EXPIRES'];
                $link->close();
            }
        }else {             // Query Failed - Error Messages Not shown !!!!
            echo "Error: " . $qry . "<br>" . mysqli_error($link);
            $link->close();
        }
    }
}