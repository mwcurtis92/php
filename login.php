<?php

   #sets a cookie for the user login information.
   if(isset($_POST['userID']))
   {
      setcookie('uID', $_POST['userID'], time()+3600);
      header( 'Location: rateMyGroup.php' );
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
   <div class = "contentWrapper">
      <p>
         To continue, please enter your ID number: (Users are automatically logged out of the system after one hour)
      </p>
   
      <form method = 'post' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
         User Id: <input type = 'text' name = 'userID' />
         <input type = "submit" value = "Login" />
      </form>
   </div>
</body>
</html>

