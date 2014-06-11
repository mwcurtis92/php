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
      <h1 id = "SiteLogo"><em><a href = 'rateMyGroup.php'>Rate My Group</a><em></h1> 
      <a style = "float:right;" href = "logout.php">logout</a>
   </div>
   <div class = "contentWrapper">

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