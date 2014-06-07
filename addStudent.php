<?php
  require 'credentials.php';
?>

<!--
   This page allows users to add more students to the database. It just contains a form, 
   the addition is actually completed in addStudentToDB.php.
-->

<html>
<head>
   <title>Rate My Group | Insert Student</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>

<body>
   <div id = "header">
      <h1 id = "SiteLogo"><em>Rate My Group<em></h1> 
   </div>
   <div class = "contentWrapper">
   <p>This is the page where students are added to the database.</p>
   <?php
      $link = "../addStudentToDB.php";
      echo "<form id = 'ratingsForm' action = '" . $link . "' Method = 'post'>
            Student Name: <input type = 'text' name = 'sName' />
            <input type = 'submit' value = 'Add Student' />
         </form>";
   ?>
   </div>
</body>
</html>