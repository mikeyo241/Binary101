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
         $searchResults = searchClasses($classID);
         $notEmpty = "inline-block";
         $isEmpty = "none";
         $_SESSION['classID'] = $classID;
      }
      else if (!empty($_POST['classIDInput'])) {
         $notEmpty = "none";
         $isEmpty = "block";
      }
      if (isset($_POST['enrollSubmit']) && isset($_POST['classID'])) {
          enrollStudent($user->getEmail(), $_POST['classID']);
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
     <p style="display: $isEmpty">No results.</p>
     <table border="4" style="display: $notEmpty">
      <thead>
         <td>Class ID</td><td>Class Name</td><td>Instructor Name</td><td>Action</td>
      </thead>
HTML;
        $searchResults = searchClasses($classID);
        if ($searchResults != null) {
            while ($row = $searchResults->fetch_assoc()) {
                $CLS_ID = $row['CLS_ID'];
                echo '<tr id=' . $CLS_ID . '>';
                echo "<td>" . $row['CLS_ID'] . "</td>";
                echo "<td>" . $row['CLS_NAME'] . "</td>";
                echo "<td>" . $row['INSTRUCT_FNAME'] . " " . $row['INSTRUCT_LNAME'] . "</td>";
                echo <<< HTML
                <td><form action="$PHP_SELF" method="post" name="enrollSubmit">
                <input type="submit" name="enrollSubmit" value="Enroll"></input>
                <input type="hidden" name="classID" value="$CLS_ID"/>
                </form></td>
HTML;
                echo "</tr>";
            }
        }

echo <<< HTML
     </table>
     <h2>Your Enrollments</h2>
   <table border="4">
      <thead>
         <td>Class ID</td><td>Class Name</td><td>Instructor Name</td><td>Grade</td>
      </thead>
HTML;
      if ($user->getEnrollments() != null) {
         $classes = $user->getEnrollments();
         while ($row = $classes->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $key => $keyValue) {
                echo "<td>$keyValue</td>";
            }
            $grade = $user->getGradeByClass($row['CLS_ID']);
            if ($grade <= 0)
                $grade = "-";
            echo "<td>" . $grade . "</td>";
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

