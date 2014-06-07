 <?php 
   //if credentials are not supplied via cookie, redirect them back to the login.
   if (!isset($_COOKIE["uID"]))
   {   
      header( 'Location: login.php' );
      die();
   }

   //the credentials file, required on all php documents.
   require 'credentials.php';
 ?>
 
 <!--
   This lists the student id's and their score. It is actually because of this page that I
   didn't feel that it was worth it to add any security verification in terms of the login 
   page. Once the student logs in the first time, they can then go in and see all of the
   student id's and just log back in with one of theirs. 
 -->
 
 <html>
 <head>

   <title>Rate My Group | Home</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
 </head>
 <body>
   <div id = "header">
      <h1 id = "SiteLogo"><em>Rate My Group<em></h1> 
   </div>
 <div class = "contentWrapper">
  
 <h3 class = 'headerStudent'>Student ID</h3><h3 class = 'headerScore'> Score</h3>
 <?php
 
   echo "<div id = 'studentData'>";
   
   foreach ($db->query('SELECT * FROM student') as $row)
   {
      $userId = $row['userId'];
      echo $userId . "<div class = 'score'> ";
            
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
      echo round($totalScore) . "</div><br />";
   }

   echo "</div>";
?>

 <div id = "links">
   <a <?php echo "href = 'ratingsPage.php?uId=" . $_COOKIE['uID'] . "'";?> class = "linkTextFormat">Rate My Group Members!</a><br />
   <a href = "addStudent.php" class = "linkTextFormat">Add students</a>
 </div>
 </div>
 </body>
 </html>