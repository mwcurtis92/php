//functions controlling ball movement
var direction = "left";
var upwardSpeed = 0;

//the box the game is in, must be universally accessible
var gameFrame;

//the coordinates of the game panel
var x;
var y;

//used to ensure that the message is not displayed during a game
var gameGoing;

//makes sure that the message is only displayed once to the screen.
var messageUp = false;

/* Displays a message to the users of the basic controls of the game
 */
function displayMessage()
{
   if(gameGoing != true && messageUp == false)
   {
      var messageFrame;
	  messageFrame = document.createElement('div');
	  messageFrame.setAttribute("id", "message");
	  messageFrame.style.position = "relative";
	  messageFrame.style.backgroundColor = "black";
	  messageFrame.style.color = "white";
	  messageFrame.style.height = "150px";
	  messageFrame.style.border = "1px solid white";
	  
	  messageFrame.innerHTML = "<h3 style = 'text-align:center;'><em>Click to play!</em></h3>" + 
			"<p style = 'margin-left:15px;'><b>Controls:</b><br />Right Player: x and s <br />" + 
			"Left Player: Arrow Keys<br />Press space bar to pause.</p>";
      gmpl = document.getElementById("gameFrame");
	  gmpl.insertBefore(messageFrame, gmpl.firstChild);
	  messageUp = true;
	}
}

/* Remove the message with the directions on how to play the game 
 * from the screen when the game is begun.
 */
function removeMessage()
{
   if(gameGoing != true)
   {
      var gmpl = document.getElementById("gameFrame");
      var toRemove = document.getElementById("message");
      gmpl.removeChild(document.getElementById("message"));
	  messageUp = false;
   }
}


/* This builds the frame of the around the game, this allows the game
 * to be a little more portable to different web pages.
*/
function Frame(x, y)
{
   this.height = 300;
   this.width = 300;
   this.xCoord = x;
   this.yCoord = y;
   this.rightEdge = this.xCoord + 300;
}

/* This function gets the location of the box, this is what allows the 
 * game frame to be moved around the screen and still have the ball know
 * where the walls and paddles are.
 */
function getPosition() 
{
   var element = document.getElementById("gameFrame");
   var xPosition = 0;
   var yPosition = 0;
	
   while(element) {
      xPosition += (element.offsetLeft - element.scrollLeft + element.clientLeft);
      yPosition += (element.offsetTop - element.scrollTop + element.clientTop);
      element = element.offsetParent;
   }
   x = xPosition;
   y = yPosition;
}

/* This function starts the game, including initiating all of the 
 * important game variables and locations. It gets the ball rolling...
 * literally ba-dum psh...
 */
function init()
{
   removeMessage();
   gameGoing = true;
   getPosition();
   gameFrame = new Frame(x, y);
   var player1 = document.getElementById("player1");
   var player2 = document.getElementById("player2");
   var ball = document.getElementById("ball");
	
   ball.style.top = 125 + "px";
   ball.style.left = 125 + "px";
   player1.style.top = 0 + "px";
   player2.style.top = 0 + "px";
   document.onkeydown = keyPressListener;
   upwardSpeed = 0;
   moveBall();
}

/* This  function listens for user input. An alert is commented out, 
 * this way, if more buttons want to be added, it just needs to be 
 * uncommented and the page will alert the keyCode for any key pressed.
 */
function keyPressListener(e)
{
	//alert(e.keyCode);
	
	//Basic commands and their keys (used below):
	//38 = up arrow
	//40 = down arrow
	//83 = s = up for player 2
	//88 = x = down for player 2

   if(e.keyCode == 38)
   {
      movePlayerUp(1);
   }
   else if(e.keyCode == 40)
   {
      movePlayerDown(1);
   }
   else if(e.keyCode == 83)
   {
      movePlayerUp(2);
   }
   else if(e.keyCode == 88)
   {
      movePlayerDown(2);
   }
   else if(e.keyCode == 32)
   {
      alert("Game paused. Press OK to continue...");
   }
	
}

/* Moves up the player corresponding to which key is pressed. The player
 * to be moved is passed into the function for better re-usability.
 */
function movePlayerUp(player)
{
   if(player === 1)
   {
      if(parseInt(player1.style.top) >= 0)
      {
         player1.style.top = parseInt(player1.style.top) - 8 + 'px';
      }
   }
   else if(player === 2)
   {
      if(parseInt(player2.style.top) >= 0)
      {
         player2.style.top = parseInt(player2.style.top) - 8 + 'px';
      }
   }
}

/* This function moves the player down, it is possible to combine all 
 * player movements into one function, but they were divided to improve
 * readability and modularity.
 */
function movePlayerDown(player)
{
   if(player === 1)
   {
      if(parseInt(player1.style.top) <= 270)
      {
         player1.style.top = parseInt(player1.style.top) + 8 + 'px';
      }
   }
   else if(player === 2)
   {
      if(parseInt(player2.style.top) <= 270)
      {
         player2.style.top = parseInt(player2.style.top) + 8 + 'px';
      }
   }
}

/* This is a recursive function that calls the ballMovement function
 * every 30 milliseconds. This function does not 'move' the ball, but 
 * it prevents the stacking movement effect that increases the ball 
 * movement speed (quite quickly), that occurs when the movement 
 * function itself is recursive.
 */
function moveBall()
{
   ballMovement();
   if(!collision())
   {
      setTimeout(function(){moveBall();}, 20);
   }
}

/* This is the function that moves the ball. How much up or down the 
 * ball movement includes (as well as the speed of the movement) is 
 * determined by the upwardSpeed variable. This variable is assigned 
 * after every collision in the generateUpwardsBall function.
 */
function ballMovement()
{
   if(direction === "left")
   {
      ball.style.left = parseInt(ball.style.left) + 2 + "px";
      ball.style.top = parseInt(ball.style.top) + upwardSpeed + "px";
   }
   else if (direction === "right")
   {
      ball.style.left = parseInt(ball.style.left) - 2 + "px";
      ball.style.top = parseInt(ball.style.top) + upwardSpeed + "px";
   }
}

/* This function randomly generates the speed and upwards or downwards
 * direction that the ball moves after a collision. This function is 
 * called in the collision function. 
 *
 * Possible improvement, when hitting off of a paddle, make the 
 * direction dependent upon where on the paddle it hits.
 */
function generateUpwardsBall(topOrBottom)
{
   var posOrNeg = Math.random();
   if(topOrBottom == false)
   {
      if(posOrNeg > .5)
      {
         upwardSpeed = Math.floor((Math.random() * 2));
      }
      else
      {
         upwardSpeed = (Math.floor((Math.random() * 2))) * -1;
      }
   }
   else
   {
      upwardSpeed = upwardSpeed * -1
   }
}

/* This function is called each ball movement to detect if it has hit
 * a wall/paddle. If it has, the horizontal movement is reversed and 
 * a new upwards movement is generated in the generateUpwardsBall
 * function.
 */
function collision()
{
   if(parseInt(ball.style.left) > 265 && parseInt(ball.style.left) < 280 &&
      parseInt(ball.style.top) >= parseInt(player2.style.top) - 30 &&
      parseInt(ball.style.top) <= (parseInt(player2.style.top)))
   {
      direction = "right";
      generateUpwardsBall(false);
   }
   else if(parseInt(ball.style.left) > -15 && parseInt(ball.style.left) < -5 &&
      parseInt(ball.style.top) >= parseInt(player1.style.top) - 30 &&
      parseInt(ball.style.top) <= (parseInt(player1.style.top)))
   {
      generateUpwardsBall(false);
      direction = "left";
   }
   else if(parseInt(ball.style.left) >= 280 || parseInt(ball.style.left) < -20)
   {
      if(parseInt(ball.style.left) >= 280)
         incrementCounter(1);
      else
         incrementCounter(2);
      return true;
   }
   else if(parseInt(ball.style.top) <= -25)
   {
      generateUpwardsBall(true);
   }
   else if(parseInt(ball.style.top) >= 280)
   {
      generateUpwardsBall(true);
   }
   return false;
}

/* Increments the player's scores. The player to be incremented is 
 * passed in as a variable for the sake of re-usability.
 */ 
function incrementCounter(player)
{
   var gameOver = false;
   var winner = "";
   if(player === 1)
   {
      scoreBoard = document.getElementById("player1Score");
	  currentScore = scoreBoard.innerHTML;
	  scoreBoard.innerHTML = "";
	  scoreBoard.innerHTML = parseInt(currentScore) + 1;
	  if((parseInt(currentScore) + 1)=== 10)
	  {
         gameOver = true;
		 winner = "player one";
      }
   }
   else
   {
      scoreBoard = document.getElementById("player2Score");
	  currentScore = scoreBoard.innerHTML;
	  scoreBoard.innerHTML = "";
	  scoreBoard.innerHTML = parseInt(currentScore) + 1;
	  if((parseInt(currentScore) + 1)=== 10)
	  {
         gameOver = true;
         winner = "player two";
      }
   }
	
   if(!gameOver)
   {
      init();
   }
   else
   {
      winnersSequence(winner);
   }
}

/* This game alerts the users when one has won the game, and asks if 
 * they would like to play again. If they do, the scores are reset and
 * the game is re initiated.
 */
function winnersSequence(winner)
{
   alert("Congratulations " + winner + " you have won!");
   var again = confirm("Would you like to play again?");
   if (again === true)
   {
      resetScores();
      init();
   }	
}

/* This function simply resets the scores of both players to zero.
 */
function resetScores()
{
   scoreBoard = document.getElementById("player1Score");
   scoreBoard.innerHTML = "0";
   scoreBoard = document.getElementById("player2Score");
   scoreBoard.innerHTML = "0";
}