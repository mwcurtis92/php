<?php
  require 'credentials.php';
?>

<!--
   This page takes the student that has been added to the database, and adds it - so 
   long as the field is not blank. It also reformats the student name, capitalizing it, etc.
   If it is unsuccessful, an error message is displayed, if it is successful, then a 
   confirmation message is displayed. Either way, the user has the ability to return 
   to the main ratings page with the student ID's or to add another student. 
-->

<html>
<head>
   <title>Rate My Group | Successful Addition</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>
<body>
   <div id = "header">
      <h1 id = "SiteLogo"><em>Rate My Group<em></h1> 
   </div>
   <div class = "contentWrapper">
   <?php
   /*
      Insert the new rating into the data base.
   */
      if("" != trim($_POST['sName']))
      {        
         $q = $db->prepare("INSERT INTO student (displayName) VALUES (?)") or die("ERROR! Contact your system admin");
         $q->bindParam(1, trim(ucwords($_POST['sName'])));
         $q->execute();

         //tell the user that the submission was successful.
         echo "<h3>Thank you, your student has been added to the database. To return to the home page, click the 
            following link:</h3>";
      }
      else
      {
         //tell the user that the submission was unsuccessful
         echo "<h3>Error, student could not be added.</h3>";
      }
   ?>
   
   <a href = "../rateMyGroup.php" class = "linkTextFormat"> Home</a>
   
   <p>To add another student, click the following link</p>
   <a href = "../addStudent.php" class = "linkTextFormat">Add Student</a>
   </div>
</body>
</html>