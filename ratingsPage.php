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
      <h1 id = "SiteLogo"><em><a href = 'rateMyGroup.php'>Rate My Group</a></em></h1> 
      <a style = "float:right;" href = "logout.php">logout</a>
   </div>
   <div class = "contentWrapper">

      <div id = "ratingsWrapper">
         <?php
            echo "<table>";            
            $vanityLimit = 3;
            
            $uID = $_GET['uId'];
            $index = -1; 
            
            $bgColor =  "#222222";
            $textColor = "#FFFFFF";
            
            echo "<tr style = 'background-color:" . $bgColor . "; '>";
            foreach ($db->query("SELECT * FROM student WHERE userId != $uID ORDER BY displayName") as $row)
            {
               $index++;
               
               if($index == $vanityLimit)
               {
                  if ($bgColor == "#222222")
                  {
                     $bgColor = "#CCCCCC";
                     $textColor = "#000000";
                  }
                  else
                  {
                     $bgColor = "#222222";
                     $textColor = "#FFFFFF";
                  }

                  echo "</td></tr><tr style = 'background-color:" . $bgColor . "; color:" . $textColor .";'>";;
                  $index = 0;
               }
               
               echo "<td width=200>";
               echo $row['displayName'] . " - <a style = 'col" . $textColor . ";' href = '../ratePage.php?name=" . $row['displayName'] . "&uId=" . $uID . "'>Rate Me!</a><br />";      
               echo "</td>";
            }
         
            echo "</tr></table>";
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