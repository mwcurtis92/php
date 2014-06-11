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
      
         $db = new PDO("mysql:host=localhost;dbname=students", $user, $password);
      }
      catch (PDOException $ex)
      {
        
         echo "Error! Please contact your system administrator. ";
         die();
      }
   }
   else
   {
      try
      {
      $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
      $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
      $dbUser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
      //$dbPassword = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
      $dbPassword = "Jordin656";
      $db = new PDO("mysql:host=$dbHost:$dbPort;dbname=$dbName", $dbUser, $dbPassword);
      }
      catch (PDOException $ex)
      {
         echo "Error! Please contact your system administrator. ";
         var_dump($ex);
         die();
      }
   }     
?>