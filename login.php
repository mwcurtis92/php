<?php
   require 'credentials.php';
   $invalid = false;

   //sets a cookie for the user login information.
   if(isset($_POST['userID']) && isset($_POST['classNum']))
   {
      $invalid = true;
      if(is_numeric($_POST['userID']) == false || is_numeric($_POST['classNum']) == false ||
         $_POST['userID'] == "" || $_POST['classNum'] == "" )
      {
         $invalid = true;
      }
      else
      {
         $uID = $_POST['userID'];
         $qury = "SELECT * FROM student WHERE userId=" . $uID;
      
         foreach ($db->query($qury) as $row)
         {
            if($row['classNum'] == $_POST['classNum'])
            {
               $invalid = false;
            }
         }
      }
   
      if($invalid == false)
      {
         setcookie('uID', $_POST['userID'], time()+3600);
         setcookie('classNum', $_POST['classNum'], time() +3600);
         header( 'Location: rateMyGroup.php' );
      }
   }
?>

<!--
This is where the users log into the system.
-->

<html>
<head>
   <title>Rate My Group | Login Page</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>

<body>
   <div id = "header">
      <h2>Welcome to RateMyGroup!</h2>
   </div>
   <div class = "contentWrapperLogin">
      <p>
         To continue, please enter your ID and class number in the fields below:
      </p>
      
      <?php
         if($invalid == true)
         {
            echo "<p style = 'color:red'>Invalid id or class</p>";
         }
      ?>
      
      <form method = 'post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
         User Id: <input type = 'text' name = 'userID' /><br />
         Class Number: <input type = 'text' name = 'classNum' />
         <input type = "submit" value = "Login" />
      </form>
   </div>
</body>
</html>

