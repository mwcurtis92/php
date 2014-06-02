<?php
/*
   Connect to the data base.
*/
   $dbHost = "";
   $dbPort = "";
   $dbUser = "";
   $dbPassword = "";
$db = "";
   $dbName = "students";

	$openShiftVar = getenv('OPENSHIFT_MYSQL_DB_HOST');

   if($openShiftVar === null || $openShiftVar == "")
   {
      try
      {
         $user = "php";
         $password = "Jordin656";
         //$host = getenv ('OpenShift')
      
         $db = new PDO("mysql:host=localhost;dbname=students", $user, $password);
      }
      catch (PDOException $ex)
      {
         echo "Error!: ";
         die();
      }
   }
   else{
      $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
      $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
      $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
      $dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
      $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
   }  
?>

<html>
<head>
</head>
<body>
   <?php
   /*
      Insert the new rating into the data base.
   */
      $rating = 0; 
   if("" != trim($_POST['one']) && "" != trim($_POST['two']) && "" != trim($_POST['three']) )
   {      
      //set the authorId 
      $uId = $_GET['uId'];
      echo $uId;
      $authorId = $uId;
      
      //compute the new rating
      $rating += $_POST["one"];
      $rating += $_POST["two"];
      $rating += $_POST["three"];
      $score = $rating;

      //determine and set the userId (the one who is getting rated)
      echo "<p>Rating: $rating</p>";
      $rateeName = $_GET['name'];
      $userId = 0;
      foreach ($db->query('SELECT * FROM student') as $row)
      {
         if($row['displayName'] == $rateeName)
         {
            $userId = $row['userId'];
            echo $userId . " = " . $row['displayName'];
            break;
         }
      }

      //add the rating into the database. 
      if($userId != 0)
      {
         $db->query("INSERT INTO ratings (userId, authorId, score) VALUES ($authorId, $userId,$score)");
      }
      //tell the user that the submission was successful.
      echo "<h3>Thank you, your rating has been submitted. To return to the home page, click the 
         following link:</h3>";
   }
  else
  {
      //tell the user that the submission was unsuccessful
      echo "<h3>Error, one or more data fields was not filled out correctly, please click the 
      following link to return to the home page.</h3>";
  }
   ?>
    <a href = "../testingUsers.php"> Home</a>
</body>
</html>