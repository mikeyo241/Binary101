<?php
    require('../vendor/paragonie/random_compat/psalm-autoload.php');
   require('../lib/functionlib.php');
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
       reDir('../index.php');
   }
   $user = $_SESSION['user'];
   $fName = $user->getFirstName();
   $lName = $user->getLastName();
   if ($_SERVER['REQUEST_METHOD']=='POST') {
      if (!empty($_POST['logOutSubmit'])) {
         session_destroy();
         reDir('../index.php');
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
        <meta name="author" content="Group 6" />
        <meta name="owner" content="Michael Gardner, Nathaniel Merck, Christian Cook, Cory Wilson" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- All Links, Meta data, scripts, and css goes inside the <head> tags.  -->
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="studentAssets/styles/student.css"/>
        
   </head>
   
   <body>
       <header>           
          <a href="/index.php"><img id="logo" src="../assets/img/logo.PNG" alt="Website Logo" align="top-left"></a>
                
          <h1 id="welcome">Welcome $fName !!!  </h1>
          <img id="icon" src="../assets/img/icon.png" align="top-left">
        </header>
        
        <div id="line">
              <!-- simply for aesthetics  -->
        </div>
        
        
        <section>
          
          <div id="space">
                <!--   for separating other divs    -->
            </div>
            
         <h2 id="enrollH2">Enroll in a Class</h2>
         
         <form id="classID" action="$PHP_SELF" method="post">
               <input type="text" placeholder="Class ID or Instructor" id="classIDInput" name="classIDInput" />
                <br>
               <input type="submit" id="classIDSubmit" name="classIDSubmit" />
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
                <input type="submit" name="enrollSubmit" value="Enroll">Enroll</input>
                <input type="hidden" name="classID" value="$CLS_ID"/>
                </form></td>
HTML;
        echo "</tr>";
    }
}

echo <<< HTML
         </table>
         
         <div id="space">
                <!--   for separating other divs    -->
            </div>
            
         <h2 id="yourEnrollment">Your Enrollments</h2>
         
       <table id="enrolledTable" border="4">
              <thead>
                 <td>Class Name</td><td>Instructor Name</td><td>Grade</td>
              </thead>
HTML;
if ($user->getEnrollments() != null) {
    $classes = $user->getEnrollments();
    while ($row = $classes->fetch_assoc()) {
        echo "<tr>";
        $CLS_ID = $row['CLS_ID'];
        $link = "../course/course.php?CLS_ID=".$row['CLS_ID'];
        echo '<tr id=' . $CLS_ID . '>';
        echo "<td><a href='".$link."'>" . $row['CLS_NAME'] . "</a></td>";
        echo "<td>" . $row['INSTRUCT_NAME'] . "</td>";
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
        
            <div id="space">
                <!--   for separating other divs    -->
            </div>
        
        <form id="signOutForm" action="$PHP_SELF" method="post">
            <input type="submit" value="Log Out" id="logOutSubmit" name="logOutSubmit">
        </form>
        
        <div id="space1">
                <!--   for separating other divs    -->
            </div>
        
    </section>
    
    <div id="bottomLineRelative">
        <!--   simply for aesthetics   -->
    </div>

    <footer id="posRelative">
        <a href="/about.html" style="color: white"> About Us </a>
        | <a href="/privacy.html" style="color: white;"> Privacy Policy </a>
    </footer>
         
</body>

</html>

HTML;

