<html>
<head>
	<title>Pokemon Survey</title>
	<link href = "surveyCSS.css" rel = "stylesheet" type = "text/css" />
</head>

<body>
	<form method = "POST" action = "recordData.php">
	<p>What is your favorite starter?</p>
		<input type = "radio" value = "Charmander" name = "lead"/>Charmander<br />
		<input type = "radio" value = "Squirtle" name = "lead"/>Squirtle<br />
		<input type = "radio" value = "Bulbasaur" name = "lead"/>Bulbasaur<br />
		<input type = "radio" value = "Pikachu" name = "lead"/>Pikachu<br />
		<br />
		<input type = "submit" value = "Submit Response" />
	</form>
</body>

</html>