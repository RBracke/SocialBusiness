<?php

session_start();

include("functions.php");

$link = connecteren();
if(isset($_SESSION['logged_in']) && isset($_SESSION["admin"]) && ($_SESSION["admin"] == 1) && isset($_GET["id"]))
{
	$id = strip($_GET["id"]);

	$query0 = "SELECT name FROM user WHERE user_id =" .$id;
	$result_name = mysqli_query($link, $query0) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query0\"");
	$rij = mysqli_fetch_array($result_name);

	$query1 = "DELETE FROM message WHERE message.receipant and message.sender = " .$id;
	mysqli_query($link, $query1) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query1\"");

	$query2 = "DELETE FROM in_building WHERE in_building.user_id = " .$id;
	mysqli_query($link, $query2) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query2\"");

	$query3 = "DELETE FROM user WHERE user.user_id = " .$id;
	mysqli_query($link, $query3) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query3\"");


	mysqli_close($link);

	header( "Location: admin_page_manage.php?delete=" .$rij["name"] );
}
else
{
	header( "Location: index.php" );
}


?>