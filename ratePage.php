<?php
  
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
   <title>Rate My Group</title>
</head>

<body>
<div id = "contentWrapper">
   <h3><em><u>Instructions</u></em></h3>
   <p style = 'padding-left:5px;'>
      For each of the three questions below, give your group member a rating between 1 and 5, <br />
      five being the highest score (for exceptional performance), and 1 being the lowest (for <br />
      inadequate performance). <br />
   </p>
   <form id = "ratingsForm">
      How hard working was this group member? <input type = "text" /><br />
      How friendly was this group member? <input type = "text" /><br />
      How well did this group member understand the material? <input type = "text"/><br />
   
   </form>
</div>
</body>
</html>