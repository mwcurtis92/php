<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
   <title>mwbodily's webpage</title>
   <link href = "homeStyle.css" type = "text/css" rel = "stylesheet" />
   <script src = "homeJS.js"></script>
</head>
<body>
   <!--This section defines the Page Header-->
   <div id = "headerWrapper">
      <div id = "header">
         <h2><em>Home.</em></h2>
         <a href = "assignments.html">CS312 assignments</a>
      </div>
   </div>
	
   <!--This section defines the page body-->
   <div class = "content">
   <!--This section defines the game section of the page-->
      <div id = "game" onmouseover = "displayMessage()">
         <div id = "gameFrame" onmouseover = "displayMessage()" onclick = "init()">
            <div onmouseover = "displayMessage()" id = "player1"></div>
            <div onmouseover = "displayMessage()" id = "player2"></div>
            <div onmouseover = "displayMessage()" id = "ball"></div>
         </div>
         <div id = "playerScores">
            <div id = "player1Container"><b><em>Player One</em></b><br /><p id = "player1Score">0</span></div>
            <div id = "player2Container"><b><em>Player Two</b></em><br /><p id = "player2Score">0</span></div>
         </div>
      </div>  

	<!--This section defines the information section of the page-->
      <div class = "aboutMe">
         <h3><em>About the Dev</em></h3>
         <hr />
         <p><b>Name:</b> Mackenzie Bodily</p>
         <p><b>Height:</b> 5'2</p>
         <p>
            <b>Interests and Hobbies:</b> Reading, Writing, Video games,
            Movies, Programming,<br />Electronics, and Art
         </p>
      </div>
   </div>
</body>
</html>
