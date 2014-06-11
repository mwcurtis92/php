 <?php 
   //if credentials are not supplied via cookie, redirect them back to the login.
echo "This is a test";
   if (!isset($_COOKIE["uID"]))
   {   
      header( 'Location: login.php' );
      die();
   }
echo "this is the second test";
   //the credentials file, required on all php documents.
   require '../credentials.php';
echo "this is the third test";
 ?>
 
 <!--
   This lists the student names and their score.
 -->
 
 <html>
 <head>

   <title>Rate My Group | Home</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
 </head>
 <body>
   <div id = "header">
      <h1 id = "SiteLogo"><em><a href = 'rateMyGroup.php'>Rate My Group</a><em></h1> 
      <a style = "float:right;" href = "logout.php">logout</a>
   </div>
 <div class = "contentWrapper">
  
 <?php
 
   echo "<div id = 'studentData'><table style = 'display:inline-block;'><tr><th>Student</th><th>Score</th></tr>";
   
   $allStudentsScores = 0;
   $totalStudents = 0;
   $bgColor =  "#222222";
   $textColor = "#BBBBBB";
   $classNumber = $_COOKIE['classNum'];
   
   
   $qury = "SELECT * FROM student WHERE classNum=". $classNumber . " ORDER BY displayName ";

   foreach ($db->query($qury) as $row)
   {
      if($bgColor == "#222222")
      {
         $bgColor = "#AAAAAA";
         $textColor = "#000000";
      }
      else
      {
         $bgColor = "#222222";
         $textColor = "#FFFFFF";
      }
      
      echo "<tr style = 'background-color:" . $bgColor . "; color:" . $textColor .";'><td width='225px'>";
      $userId = $row['userId'];
      echo $row['displayName'];
      echo "</td><td width = '75px'>";
      $stmt = $db->prepare("SELECT * FROM ratings WHERE userId = :userId");
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
      $stmt->execute();
      
      $result = $stmt->fetchAll();
      $count = 0;
      $totalScore = 0;
      foreach($result as $values)
      {
         $totalScore += $values['score'];
         $count += 1;
      }
      if($count != 0)
      {
         $totalScore /= $count;
      }
      echo round($totalScore) ;
      $allStudentsScores += $totalScore;
      if($totalScore != 0)
      {
         $totalStudents += 1;
      }
      echo "</td></tr>";
   }
   
   if($totalStudents != 0)
   {
      echo "<tr style = 'background-color:white;color:black;text-align:center;'><td><b>Average Score:</b></td><td>" . round($allStudentsScores/$totalStudents, 2) . "</td></tr>";
   }
   echo "</table></div>";
?>
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