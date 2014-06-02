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
         $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }

?>

<html>
<head>

   <script>
   
   function getQueryStrings() { 
  var assoc  = {};
  var decode = function (s) { return decodeURIComponent(s.replace(/\+/g, " ")); };
  var queryString = location.search.substring(1); 
  var keyValues = queryString.split('&'); 

  for(var i in keyValues) { 
    var key = keyValues[i].split('=');
    if (key.length > 1) {
      assoc[decode(key[0])] = decode(key[1]);
    }
  } 

  return assoc; 
} 

         function returnQString()
      {
         var queries = getQueryStrings();
         userID = queries["uId"];
         alert(userID);
         return "../updateDB.php?uId=" +  userID;
      }
   </script>
   <title>Rate My Group</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>

<body>
<div id = "contentWrapper">
   <h3><em><u>Instructions</u></em></h3>
   <p style = 'padding-left:5px;'>
      For each of the three questions below, give your group member a rating between 1 and 5, <br />
      five being the highest score (for exceptional performance), and 1 being the lowest (for <br />
      inadequate performance). <br />
   </p>
   <?php
      $link = "../updateDB.php?uId=" . $_GET['uId'] . "&name=" . $_GET['name'];
   
   echo "<form id = 'ratingsForm' action = '" . $link . "' Method = 'post'>
      How hard working was this group member? <input id = 'one' name = 'one' type = 'text' /><br />
      How friendly was this group member? <input id = 'two' name = 'two' type = 'text' /><br />
      How well did this group member understand the material? <input id = 'three' name = 'three' type = 'text'/><br />
      <input type = 'submit' value = 'Submit Rating'/>
   </form>";
   ?>
  
</div>
</body>
</html>