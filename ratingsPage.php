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
   <div id = "ratingsWrapper">
<?php
  $db = new PDO("mysql:host=localhost;dbname=students", $user, $password);
   echo "<div id = 'studentData'>";
 
   foreach ($db->query('SELECT * FROM student') as $row)
   {
      echo $row['displayName'] . " - <a style = 'color:white;' href = 'ratePage.php/?name=" . $row['displayName'] . "'>Rate Me!</a><br />";      
   }

   echo "</div>";

?>
   </div>

</div>
</body>
</html>