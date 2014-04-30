//window.onload = init;
var direction = "left";
var upwardSpeed = 0;
var gameFrame;
var x;
var y;
var messageFrame; 
var gameGoing;
var messageUp = false;

function displayMessage()
{
	if(gameGoing != true && messageUp == false)
	{
		messageFrame = document.createElement('div');
		messageFrame.setAttribute("id", "message");
		messageFrame.style.position = "relative";
		messageFrame.style.backgroundColor = "black";
		messageFrame.style.color = "white";
		messageFrame.style.height = "150px";
	
		messageFrame.innerHTML = "<h3 style = 'text-align:center;'><em>Click to play!</em></h3>" + 
			"<p style = 'margin-left:15px;'><b>Controls:</b><br />Right Player: x and s <br />" + 
			"Left Player: Arrow Keys<br />Press space bar to pause.</p>";
		gmpl = document.getElementById("gameFrame");
		gmpl.insertBefore(messageFrame, gmpl.firstChild);
		messageUp = true;
	}
}

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

function Frame(x, y)
{
	//alert("here");
	this.height = 300;
	this.width = 300;
	this.xCoord = x;
	this.yCoord = y;
	this.rightEdge = this.xCoord + 300;
	//alert("here2");
}

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

function keyPressListener(e)
{
	//alert(e.keyCode);
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

function movePlayerUp(player)
{
	if(player === 1)
	{
		if(parseInt(player1.style.top) >= 0)
		{
			player1.style.top = parseInt(player1.style.top) - 4 + 'px';
		}
	}
	else if(player === 2)
	{
		if(parseInt(player2.style.top) >= 0)
		{
			player2.style.top = parseInt(player2.style.top) - 4 + 'px';
		}
	}
}

function movePlayerDown(player)
{
	if(player === 1)
	{
		if(parseInt(player1.style.top) <= 270)
		{
			player1.style.top = parseInt(player1.style.top) + 3 + 'px';
		}
	}
	else if(player === 2)
	{
		if(parseInt(player2.style.top) <= 270)
		{
			player2.style.top = parseInt(player2.style.top) + 3 + 'px';
		}
	}
}

function moveBall()
{
	ballMovement();
	if(!collision())
	{
		setTimeout(function(){moveBall();}, 20);
	}
}

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

function resetScores()
{
	scoreBoard = document.getElementById("player1Score");
	scoreBoard.innerHTML = "0";
	scoreBoard = document.getElementById("player2Score");
	scoreBoard.innerHTML = "0";
}