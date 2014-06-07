<?php
  require 'credentials.php';
?>

<!--
   This page is where each of the students (except the one rating) are shown by name
   along with a link. Clicking on a student's link will allow the student to rate the 
   selected student by taking them to ratePage.php where they will be presented
   with a form.
-->

<html>
<head>
   <title>Rate My Group | Class List </title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>

<body>
   <div id = "header">
      <h1 id = "SiteLogo"><em>Rate My Group<em></h1> 
   </div>
   <div class = "contentWrapper">
      <h3><u>Class List<u></h3>
      <div id = "ratingsWrapper">
         <?php
            $countQ  = $db->query("SELECT COUNT(*) FROM student");
            $countVal = $countQ->fetch(PDO::FETCH_NUM);
            $count = $countVal[0];
            
            $vanityLimit = round($count/3);
            
            $uID = $_GET['uId'];
            $index = 0; 
            $divNum = 1;
            
            echo "<div class = 'column" . $divNum . "'>";
            
            foreach ($db->query("SELECT * FROM student WHERE userId != $uID ORDER BY displayName") as $row)
            {
               if($index == $vanityLimit)
               {
                  echo "</div>";
                  $divNum++;
                  echo "<div class = 'column" . $divNum . "'>";
                  $index = 0;
               }
               
               echo $row['displayName'] . " - <a style = 'color:white;' href = '../ratePage.php?name=" . $row['displayName'] . "&uId=" . $uID . "'>Rate Me!</a><br />";      
               $index++;
         }
         
            echo "</div>";
         ?>
      </div>
   </div>
</body>
</html>