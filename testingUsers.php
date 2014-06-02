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
<script>
/*
The point of this prompt is to get the user ID, because, obviously, these ID's aren't 
really a secret., I have them passed on the query string. I might change this to a post, 
but that would only be if I found a way to make the ID's a secret. As it is, someone can 
just enter someone else's ID and rate themselves.

This then dynamically creates the link in the link id div with the query string.
*/

   function addLink()
   {
      var id = prompt("Please enter your ID");
      var queryString = "../ratingsPage.php?uId=" + id;
      var linkDiv = document.getElementById("link");
      linkDiv.innerHTML = "<a style = 'color:white;' href = '" + queryString + "'>Rate My Group</a>";
   }

</script>
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
  $db = new PDO("mysql:host=localhost;dbname=students", $user, $password);
   echo "<div id = 'studentData'>";
 
   foreach ($db->query('SELECT * FROM student') as $row)
   {
      $userId = $row['userId'];
      echo $userId . " score: ";
            
      $stmt = $db->prepare("SELECT * FROM ratings WHERE userId = :userId");
      $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
      $stmt->execute();
      
      $result = $stmt->fetchAll();
      $count = 0;
      $totalScore = 0;
      foreach($result as $values)
      {
         $totalScore += $values['score'];
         $count += 1;
      }
      $totalScore /= $count;
      echo $totalScore . "<br />";
   }

   echo "</div>";

?>
<div id = "link">
</div>
<script>
   addLink();
</script>

</div>
</body>
</html>