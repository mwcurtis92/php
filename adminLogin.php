<?php
   require 'credentials.php';

      #sets a cookie for the admin login information.
   if(isset($_POST['adminId']) && isset($_POST['classNum']))
   {
      $aId = $_POST['adminId'];
      $qury = "SELECT * FROM admin WHERE adminId=" . $aId;
      $privledges = false;
      
      echo $privledges;
      
      foreach ($db->query($qury) as $row)
      {
         if($row['classNum'] == $_POST['classNum'])
         {
            $privledges = true;
         }
      }

      if($privledges == true)
      {
         setcookie('classNum', $_POST['classNum'], time() +1800);
         header( 'Location: addStudent.php' );
      }
	   die();
   }
?>

<html>
   <head>
      <title>Admin Login Page</title>
      <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
   </head>
   
   <body>
      <div id = "header">
         <h1 id = "SiteLogo"><em><a href = 'rateMyGroup.php'>Rate My Group</a><em></h1> 
         <a style = "float:right;" href = "logout.php">logout</a>
      </div>
      <div class = "contentWrapper">   
         <p>Please enter your administrative ID and class number to add a student</p>
         <form method = 'POST' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            Admin ID Num <input type = 'text' name = 'adminId' /><br />
            Class Number <input type = 'text' name = 'classNum' /><br /><br />
            <input type = "submit" value = "Login" />
         </form>
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