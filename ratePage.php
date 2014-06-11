<?php
  require 'credentials.php';
?>

<!--
   This page contains the form for the students to use to rate another student. Once 
   the form is submitted, the user is redirected to the updateDB page where the
   rating is either confirmed and entered into the database, or rejected. 
-->

<html>
<head>
   <title>Rate My Group | Rating Form</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>

<body>
    <div id = "header">
      <h1 id = "SiteLogo"><em><a href = 'rateMyGroup.php'>Rate My Group</a><em></h1> 
   </div>
   <div class = "contentWrapper">
      <h3><em><u>Instructions</u></em></h3>
      <p style = 'padding-left:5px;'>
         For each of the three questions below, give your group member a rating between 1 and 5, 
         five being the highest score (for exceptional performance), and 1 being the lowest (for 
         inadequate performance). <br />
      </p>
   
      <?php
         $link = "../updateDB.php?uId=" . $_GET['uId'] . "&name=" . $_GET['name'];
   
         echo "<form id = 'ratingsForm' action = '" . $link . "' Method = 'post'>
                  How hard working was this group member? 
                  <input type = 'radio' id = 'one' name = 'one' type = 'text' value = '1' />1
                  <input type = 'radio' id = 'one' name = 'one' type = 'text'  value = '2' />2
                  <input type = 'radio' id = 'one' name = 'one' type = 'text'  value = '3' />3
                  <input type = 'radio' id = 'one' name = 'one' type = 'text' value = '4' />4
                  <input type = 'radio' id = 'one' name = 'one' type = 'text' value = '5' />5<br />
                  How friendly was this group member?
                  <input type = 'radio' id = 'one' name = 'two' type = 'text' value = '1'  />1
                  <input type = 'radio' id = 'one' name = 'two' type = 'text' value = '2' />2
                  <input type = 'radio' id = 'one' name = 'two' type = 'text' value = '3' />3
                  <input type = 'radio' id = 'one' name = 'two' type = 'text' value = '4' />4
                  <input type = 'radio' id = 'one' name = 'two' type = 'text' value = '5' />5<br />
                  How well did this group member understand the material?
                  <input type = 'radio' id = 'one' name = 'three' type = 'text' value = '1'  />1
                  <input type = 'radio' id = 'one' name = 'three' type = 'text' value = '2' />2
                  <input type = 'radio' id = 'one' name = 'three' type = 'text' value = '3' />3
                  <input type = 'radio' id = 'one' name = 'three' type = 'text' value = '4'/>4
                  <input type = 'radio' id = 'one' name = 'three' type = 'text' value = '5' />5<br />
                  <input type = 'submit' value = 'Submit Rating'/>
                  </form>";
         
             /*  How hard working was this group member? <input id = 'one' name = 'one' type = 'text' /><br />
               How friendly was this group member? <input id = 'two' name = 'two' type = 'text' /><br />
               How well did this group member understand the material? <input id = 'three' name = 'three' type = 'text'/><br />
               <input type = 'submit' value = 'Submit Rating'/>
            </form>";*/
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