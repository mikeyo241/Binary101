<?php
   require ('../functionlib.php');
   /******************************************************
   ***               Private Profile                  ***
   ***                                                ***
   ***    Created by:         Michael A Gardner       ***
   ***                        Cory Wilson             ***
   ***    Updated:            7 March 2017            ***
   ***    Class:              CPT - 264-002           ***
   ***    Document:           studentProfile.php      ***
   ***    CSS:                styles.css              ***
   ***    jQuery:             None                    ***
   ***                                                ***
   ******************************************************/
   if (!(isset($classID)))
      $classID = "";
   $className = "";
   $instructFName = "";
   $instructLName = ""; 
   $notEmpty = "none";
   $isEmpty = "none";

   if ($_SESSION['isLogged'] != 'TuIlI' ||
       !$_SESSION['LOGCHECK']) {  // Make sure the user is logged in!!! This is a private page!!
       session_destroy();
       reDir('../main.php');
   }
   $user = $_SESSION['user'];
   $fName = $user->getFirstName();
   $lName = $user->getLastName();
   if ($_SERVER['REQUEST_METHOD']=='POST') {
      if (!empty($_POST['logOutSubmit'])) {
         session_destroy();
         reDir('../main.php');
      }
      // If ClassID search returns a result
      if (!empty($_POST['classIDInput']) && searchClasses($_POST['classIDInput']) != null) {
         $classID = $_POST['classIDInput'];
         $searchResult = searchClasses($classID);
         var_dump($searchResult);
         //$searchResult = $searchResult->fetch_assoc();
         $classID = $searchResult['CLS_ID'];
         $className = $searchResult['CLS_NAME'];
         $instructFName = $searchResult['INSTRUCT_FNAME'];
         $instructLName = $searchResult['INSTRUCT_LNAME'];
         $notEmpty = "inline-block";
         $isEmpty = "none";
         $_SESSION['classID'] = $classID;
      }
      else if (!empty($_POST['classIDInput'])) {
         $notEmpty = "none";
         $isEmpty = "block";
      }
      if (isset($_POST['enrollSubmit'])) {
         enrollStudent($user->getEmail(), $_SESSION['classID']);
         $_POST['enrollSubmit'] = null;
      }
   }
   $user = $_SESSION['user'];
   echo <<< HTML
   <html>
   <head>
       <title>$fName $lName</title>

   </head>
   <body>
   <h1>Welcome $fName !!!</h1>
     <form id="signOutForm" action="$PHP_SELF" method="post" >
      <input type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit">
     </form>
     <h2>Enroll in a Class</h2>
     <form id="classID" action="$PHP_SELF" method="post">
       <input type="text" placeholder="Class ID" id="classIDInput" name="classIDInput"></input>
       <input type="submit" id="classIDSubmit" name="classIDSubmit"></input>
     </form>
     <p style="display: $isEmpty">
         No results
      </p>
     <table border="4" style="display: $notEmpty">
      <thead>
         <td>Class ID</td><td>Class Name</td><td>Instructor Name</td><td>Enrollment</td>
      </thead>
      <tr>
      <td>$classID</td> <td>$className</td> <td>$instructFName $instructLName</td>
      <form action="$PHP_SELF" method="post"><td><input type="submit" id="enrollSubmit" name="enrollSubmit" value="Enroll" ></input></td></form>
      </tr>
     </table>
     <h2>Your Enrollments</h2>
   <table border="4">
      <thead>
         <td>Class ID</td><td>Class Name</td><td>Instructor Name</td><td>Grade</td>
      </thead>
HTML;
      if ($user->getEnrollments() != null) {
         $classes = $user->getEnrollments();
         for ($i = 0; $i < count($classes); $i++) {
            echo "<tr>";
            foreach ($classes[$i] as $key => $keyValue) {
                if ($keyValue == -1)    // If no grade, insert hyphen character
                    $keyValue = " - ";
                echo "<td>$keyValue</td>";
            }
            echo "</tr>";
         }
      }
      else
         echo "No enrollments.";

   echo <<< HTML
      </table>
   </body>
   </html>

HTML;

