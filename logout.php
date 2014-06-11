<?php
      setcookie('uID', $_POST['userID'], time() - 3600);
      setcookie('classNum', $_POST['classNum'], time() - 3600);
      header( 'Location: ../home.html' );
	   die();
?>