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
<link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>

<body>

<h1 id = "SiteLogo"><em>Rate My Group<em></h1>

<div id = "contentWrapper">
<div id = "header">
   <div id = "Id">
      <h3>Student Id</h3>
   </div>
   <div id = "score">
      <h3>Student Score</h3>
   </div>
</div>

<?php
  //$db = new PDO("mysql:host=localhost; dbname=students", $user, $password);
   echo "<div id = 'studentData'>";
 
   foreach ($db->query('SELECT * FROM student') as $row)
   {
      $userId = $row['userId'];
      echo $userId . " score: ";
            
      $stmt = $db->prepare("SELECT * FROM ratings WHERE userId = :userId");
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
      $stmt->execute();
      
      $result = $stmt->fetchAll();

      foreach($result as $values)
      {
         echo $values['score'] . "<br />";
      }
      
   }

   echo "</div>";
   echo "This is a test";
   
?>
<div id = "link">
<a href = "ratingsPage.php" id = "rateLink"> Rate My Group Members!</a>
</div>
</div>
</body>
</html>