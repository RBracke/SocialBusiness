<?php
session_start();
include("functions.php");

if(isset($_SESSION['logged_in']))
{
	$naam = $_SESSION['name'];
	user_offline();
	session_unset();
	session_destroy();
	header( "Location: index.php?logout=true&naam=" .$naam );
}
else
{
	header( "Location: index.php" );
}
?>