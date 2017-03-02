<?php

/* 
Function cleanit
	Last modified: 10/28/16
	Parameters:		$txt - Text input
	Returns:		$txt - Sanitized output
	Description:	Sanitizes input 
*/
function cleanit($txt) {
	$txt = trim($txt);
	$txt = stripslashes($txt);
	$txt = htmlspecialchars($txt);
	$txt = preg_replace('/[^A-Za-z0-9\.-]/', '', $txt);
	return $txt;
}

/* 
Function db_connect
	Last modified: 10/28/16
	Parameters:		$database - Database to use
	Returns:
	Description:	Connects to CIT MySQL server given a datbase to use
*/
function dbConnect($servername = "localhost", $username = "CIT", $password = "CPT283", $database = "php2016") {
	// Create connection
	$GLOBALS['conn'] = new mysqli($servername, $username, $password, $database);
	// Check connection
	if ($GLOBALS['conn']->connect_error) {
		die("Connection failed: " . $GLOBALS['conn']->connect_error);
	}
}

/* 
Function dbClose
	Last modified: 10/28/16
	Parameters:		
	Returns:
	Description:	Ends the MySQL connection
*/
function dbClose() {
	$GLOBALS['conn']->close();
}


/* 
Function checkpword
	Last modified: 10/28/16
	Parameters:		$txt - Password to check
	Returns:		True if password is okay, false if else
	Description:	Checks if a password is valid
*/
function checkPword($txt) {
	if (strlen($txt) < 8) {	// Password is too short
		echo "Password too short.<br>";
		return (false);
	}
	return (true);
}

/* 
Function checkname
	Last modified: 10/28/16
	Parameters:		$txt - Username to check
	Returns:		True if username is okay, false if else
	Description:	Checks if a username is valid
*/
function checkUser($txt) {
	if (cleanit($txt) != $txt) {	// Username has special characters; do not accept
		echo "Username cannot contain special characters.<br>";
		return (false);
	}
	elseif (strlen($txt) < 4) {	// Username is too short
		echo "Username too short.<br>";
		return (false);
	}
	else
		return (true);
}

function checkLogin($un, $pw) {
	if (checkUser($un) AND checkPword($pw)) {
		$pw = md5($pw);
		$sql = "SELECT * FROM RCW_user WHERE Username='$un' AND Pword='$pw'";
		$result = $GLOBALS['conn']->query($sql);
		$num_rows = mysqli_num_rows($result);
		if ($num_rows > 0) {
			echo "Login successful.<br>";
			$sql = "SELECT UserID, FName FROM RCW_user WHERE Username='$un' AND Pword='$pw'";
			$result = $GLOBALS['conn']->query($sql);
			$row = $result->fetch_assoc();
			$_SESSION['userID'] = $row['UserID'];
			$_SESSION['fname'] = $row['FName'];
			return (true);
		}
		else {
			echo "Username or password incorrect.<br>";
			return (false);
		}
	}
	else {
		echo "Username or password incorrect.<br>";
		return (false);
	}
}

function checkNewAccount($un, $pw) {
	if (checkUser($un)) {
		$sql = "SELECT * FROM RCW_user WHERE Username='$un'";
		$result = $GLOBALS['conn']->query($sql);
		$num_rows = mysqli_num_rows($result);
		if ($num_rows > 0) {
			echo "Username already taken.<br>";
			return (false);
		}
		return (checkPword($pw));
	}
	else {
		echo "Username or password entered are invalid.<br>";
		return (false);
	}
}

/* 
Function addAccount
	Last modified: 10/28/16
	Parameters:		$un - Username to add
					$pw - Password to add
	Returns:		
	Description:	Adds a user to the database
*/
function addAccount($un, $pw) {	
	$date = getdate();		// Get current date
	$year = $date["year"];
	$month = $date["mon"];
	$day = $date["mday"];
	$pw = md5($pw);			// Encrypt password
	
	// Insert new record into database
	$sql = "insert into RCW_user (Username, Pword, Creation) values (
			'$un', 
			'$pw',
			'$year-$month-$day'
			)";
	if ($GLOBALS['conn']->query($sql) === TRUE) 
		echo "Successfully added account.<br>";
	elseif (strpos($GLOBALS['conn']->error, 'Duplicate') !== false)
		echo "Username already exists, try again.<br>";
	else
		echo "Failed to create account: " . $GLOBALS['conn']->error;
}


function loginForm() {
		?>
	<html>
	<link href="../styles/styles.css" rel="stylesheet" type="text/css" />
	<body>
			<form id='login' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post' accept-charset='UTF-8'>
				<fieldset style="width: 63%; margin-left: auto; margin-right: auto;">
				<legend>Login</legend>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				 
				<label for='username' >Username:</label>
				<input type='text' name='var10' id='var10'  maxlength="20" style='width: 250px' />
				<label for='password' >Password:  </label>
				<input type='password' name='var20' id='var20' maxlength="20" style='width: 250px' />
				 
				<input type='submit' name='Login' value='Submit' style='display: inline;' />
				 
				</fieldset>
			</form>
	</body>
	</html>

<?php
	$error=''; // Variable To Store Error Message
	if (!(empty($_POST['var10'])) || !(empty($_POST['var20']))) {
		// Define $username and $password
		$username=$_POST['var10'];
		$password=$_POST['var20'];
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		// echo "Username: " . $username . "<br>Password: " . $password . "<br>";
		// echo "md5 Password: " . md5($password) . "<br>";
		return (checkLogin($username, $password));
	}

}

function createAccountForm() {
?>
	<html>
	<link href="../styles/styles.css" rel="stylesheet" type="text/css" />
	<body>
		<section>
			<form id='login' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post' accept-charset='UTF-8'>
				<fieldset >
				<legend>Create Account</legend>
				<input type='hidden' name='submitted' id='submitted' value='1'/>
				 
				<label for='username' >Username:</label>
				<input type='text' name='var10' id='var10'  maxlength="50" />
				<br><br>
				<label for='password' >Password:  </label>
				<input type='password' name='var20' id='var20' maxlength="50" />
				<br><br>
				<label for='password2' >Confirm password:  </label>
				<input type='password' name='var21' id='var21' maxlength="50" style="width: 357px;" />
				 
				<input type='submit' name='Submit' value='Submit' />
				 
				</fieldset>
			</form>
	</body>
	</html>
	
	<?php
	$error=''; // Variable To Store Error Message
	if (!(empty($_POST['var10'])) && !(empty($_POST['var20'])) && !(empty($_POST['var21']))) {
		if ($_POST['var20'] != $_POST['var21'])	// Passwords don't match
			return (false);
		// Define $username and $password
		$username=$_POST['var10'];
		$password=$_POST['var20'];
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		// echo "Username: " . $username . "<br>Password: " . $password . "<br>";
		// echo "md5 Password: " . md5($password) . "<br>";
		// if (checkUser($username) AND checkPword($password))
		if (checkNewAccount($username, $password)) {
			addAccount($username, $password);
			return (true);
		}
		else
			return (false);
	}
}

function getUsername($userID) {
	dbConnect();
	$sql = "SELECT Username FROM RCW_user WHERE UserID='$userID'";
	$result = $GLOBALS['conn']->query($sql);
	$row = $result->fetch_assoc();
	$username = $row['Username'];
	return ($username);
}

function getCreateDate($userID) {
	dbConnect();
	$sql = "SELECT Creation FROM RCW_user WHERE UserID='$userID'";
	$result = $GLOBALS['conn']->query($sql);
	$row = $result->fetch_assoc();
	$creation = $row['Creation'];
	return ($creation);
}

function setFName($userID, $fname) {
	dbConnect();
	echo "Setting FName as $fname";
	$sql = "UPDATE RCW_user SET FName='$fname' WHERE UserID='$userID'";
	$result = $GLOBALS['conn']->query($sql);
	return ($result);
}

function setLName($userID, $lname) {
	dbConnect();
	$sql = "UPDATE RCW_user SET LName='$lname' WHERE UserID='$userID'";
	$result = $GLOBALS['conn']->query($sql);
	return ($result);
}

function getFName($userID) {
	dbConnect();
	$sql = "SELECT FName FROM RCW_user WHERE UserID='$userID'";
	$result = $GLOBALS['conn']->query($sql);
	return ($result->fetch_assoc()["FName"]);
}

function getLName($userID) {
	dbConnect();
	$sql = "SELECT LName FROM RCW_user WHERE UserID='$userID'";
	$result = $GLOBALS['conn']->query($sql);
	return ($result->fetch_assoc()["LName"]);}

function logout() {
	session_destroy();
	header("Location: index.php");
}

	
?>