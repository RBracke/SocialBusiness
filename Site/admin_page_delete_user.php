<?php

session_start();

include("functions.php");

$link = connecteren();
if(isset($_SESSION['logged_in']) && isset($_SESSION["admin"]) && ($_SESSION["admin"] == 1) && isset($_GET["id"]))
{
	$id = strip($_GET["id"]);

	$query_function = "DELETE FROM user WHERE user.user_id = " .$id;

	mysqli_query($link, $query_function) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_function\"");


	mysqli_close($link);

	header( "Location: admin_page_manage.php" );
}
else
{
	header( "Location: index.php" );
}


?>