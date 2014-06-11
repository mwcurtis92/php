<?php

   #sets a cookie for the user login information.
   if(isset($_POST['userID']) && isset($_POST['classNum']))
   {
      setcookie('uID', $_POST['userID'], time()+3600);
      setcookie('classNum', $_POST['classNum'], time() +3600);
      header( 'Location: ../rateMyGroup.php' );
	   die();
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
   
      <form method = 'post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
         User Id: <input type = 'text' name = 'userID' /><br />
         Class Number: <input type = 'text' name = 'classNum' />
         <input type = "submit" value = "Login" />
      </form>
   </div>
</body>
</html>

