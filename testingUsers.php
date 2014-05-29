<?php
   try
   {
      $user = "php";
      $password = "Jordin656";
      $db = new PDO("mysql:host=localhost;dbname=students", $user, $password);
   }
   catch (PDOException $ex)
   {
      echo "Error!: " . $ex->getMessage();
      die();
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
  $db = new PDO("mysql:host=localhost; dbname=students", $user, $password);
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

?>
<div id = "link">
<a href = "ratingsPage.php" id = "rateLink"> Rate My Group Members!</a>
</div>
</div>
</body>
</html>