<?php
	$user = 'root';
	$pass = '';
	$db = 'initialDataBase';
	
	$db = new mysqli('localhost', $user, $pass, $db) or die("unable to connect");
	

	echo "Great work!!!";
	
?>