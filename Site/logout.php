<?php
	session_start();
	
	if(isset($_SESSION['logged_in']))
	{
		$naam = $_SESSION['naam'];
		session_unset();
		session_destroy();
		header( "Location: index.php?logout=true&naam=" .$naam );
	}
	else
	{
		header( "Location: index.php" );
	}
?>