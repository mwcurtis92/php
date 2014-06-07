<?php
  require 'credentials.php';
?>

<!--
   This page inserts the rating into the database, informing the user if the rating
   was inserted or rejected. Either way, the student is then presented with a link
   that will return them to the home page or to the class list page where they can 
   rate another student.
-->

<html>
<head>
   <title>Rate My Group | Successful Rating</title>
   <link href = "313ProjectCSS.css" rel = "stylesheet" type = "text/css" />
</head>
<body>
   <div id = "header">
      <h1 id = "SiteLogo"><em>Rate My Group<em></h1> 
   </div>
   <div class = "contentWrapper">
   <?php
   /*
      Insert the new rating into the data base.
   */
      $rating = 0; 
      //make sure that none of the fields were blank.
      if("" != trim($_POST['one']) && "" != trim($_POST['two']) && "" != trim($_POST['three']) )
      {      
         //make sure that the values entered into the range were correct.
         if(!($_POST["one"] > 5 || $_POST["one"] < 1 || $_POST["two"] > 5 || $_POST["two"] < 1 || 
            $_POST["three"] > 5 || $_POST["three"] < 1))
         {
            //set the authorId 
            $uId = $_GET['uId'];
            $authorId = $uId;
      
            //compute the new rating
            $score = $_POST["one"] + $_POST["two"] + $_POST["three"];

            //determine and set the userId (the one who is getting rated)
            $rateeName = $_GET['name'];
         
            $qry = "SELECT * FROM student WHERE displayName='" . $rateeName . "'";        
      
            $uId = $db->query($qry);
            $uId = $uId->fetch(PDO::FETCH_ASSOC);
            $userId = $uId['userId'];
         
            //add the rating into the database. 
            if($userId != 0)
            {
               $db->query("INSERT INTO ratings (userId, authorId, score) VALUES ($userId, $authorId,$score)");
               echo "<h3>Thank you, your rating has been submitted. To return to the home page, click the 
                  following link:</h3>";
            }
         }
         else
         {
            echo "Error! The data entered was not in the available range (1-5). To return to the home page, click the 
               following link: <br />";
         }
      }
      else
      {
            //tell the user that the submission was unsuccessful
            echo "<h3>Error! One or more data fields was not filled out correctly, please click the 
               following link to return to the home page.</h3>";
      }
   ?>
   
   <a href = "../rateMyGroup.php" class = "linkTextFormat"> Home</a>
   <p>To rate another student, click the following link</p>
   <a href = "ratingsPage.php?uId=<?php echo $_GET['uId'];?>" class = "linkTextFormat">Class List</a>
   </div>
</body>
</html>