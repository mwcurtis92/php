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
      <h1 id = "SiteLogo"><em><a href = 'rateMyGroup.php'>Rate My Group</a><em></h1> 
      <a style = "float:right;" href = "logout.php">logout</a>
   </div>
   <div class = "contentWrapper">
   <?php
   /*
      Insert the new rating into the data base.
   */
  
      $failure = "<h3>Error, student could not be added.</h3>";
   
      //check t make sure the displayName is unique before adding it to the database
      $newDN  = trim(ucwords($_POST['sName']));
      $class = $_COOKIE['classNum'];
      $add = true;
      
      if($class == "" || $class == 0)
      {
         $add = false;
      }
      
     $qury = "SELECT * FROM student WHERE classNum=" . $class;
      
      foreach ($db->query($qury) as $row)
      {
         if($row['displayName'] == $newDN)
         {
            $add = false;
            $failure = "<h3>A student with that name already exists. Student was not added.</h3>";
         }
      }
      
      if("" != trim($_POST['sName']) && $add == true)
      {        
         $q = $db->prepare("INSERT INTO student (displayName, class) VALUES (?,?)") or die("ERROR! Contact your system admin");
         $q->bindParam(1, trim(ucwords($_POST['sName'])));
         $q->bindParam(2, $class);
         
         $q->execute();

         //tell the user that the submission was successful.
         echo "<h3>Thank you, your student has been added to the database. To return to the home page, click the 
            following link:</h3>";
      }
      else
      {
         //tell the user that the submission was unsuccessful
         echo $failure;
      }
   ?>
   
   <a href = "../rateMyGroup.php" class = "linkTextFormat"> Home</a>
   
   <p>To add another student, click the following link</p>
   <a href = "../addStudent.php" class = "linkTextFormat">Add Student</a>
   </div>
   
    <div id = "links">
   <a class = "barLinkLink" href = "rateMyGroup.php" class = "linkTextFormat">
      <div class = "barLinkDiv">Home</div>
   </a>
   
   <a class = "barLinkLink"<?php echo "href = 'ratingsPage.php?uId=" . $_COOKIE['uID'] . "'";?> class = "linkTextFormat">
      <div class = "barLinkDiv">Rate My Group Members!</div>
   </a>
   
   <a class = "barLinkLink" href = "adminLogin.php" class = "linkTextFormat">
      <div class = "barLinkDiv">Register student</div>
   </a>
   
 </div>
</body>
</html>