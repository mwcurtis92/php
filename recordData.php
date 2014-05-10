<?php
session_start();

if(isset($_SESSION["votes"]))
{
	header( 'Location: nope.php' );
	die();
}
else
{
	$_SESSION["votes"] = 1;
}
?>

<html>
<head>
<title>Surve Results</title>
<link href = "surveyCSS.css" rel = "stylesheet" type = "text/css" />

</head>

<body id = "resultsBody">
	<?php
		$size = $_POST['lead'];
		
		$size = htmlspecialchars($size);
		
		echo "Your selected: $size<br />"; 
		
		$theFile = fopen("surveyRecords.txt", "r+") or exit ("Unable to get results");
		$currentVal = fread($theFile, filesize("surveyRecords.txt"));
		
		
		$fileArray = preg_split("/[\s,]+/", $currentVal);
		 
		 switch($size){
		 case "Charmander":
			$fileArray[0] += 1;
			$fileArray[4] += 1;
			echo "$fileArray[0] out of $fileArray[4] selected this pokemon.";
			break;
		case "Squirtle":
			$fileArray[1] += 1;
			$fileArray[4] += 1;
			echo "$fileArray[1] out of $fileArray[4] selected this pokemon.";
			break;
		case "Bulbasaur":
			$fileArray[2] += 1;
			$fileArray[4] += 1;
			echo "$fileArray[2] out of $fileArray[4] selected this pokemon.";
			break;
		case "Pikachu":
			$fileArray[3] += 1;
			$fileArray[4] += 1;
			echo "$fileArray[3] out of $fileArray[4] selected this pokemon.";
			break;
		 }
		
		file_put_contents("surveyRecords.txt", "$fileArray[0] $fileArray[1] $fileArray[2] $fileArray[3] $fileArray[4]");
		
		fclose($theFile);
	?>
</body>
</html>