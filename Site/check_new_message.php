<?php
session_start();
include("functions.php");

if (isset($_SESSION["user_id"]))
{
	$link = connecteren();

	$query_aantal = "SELECT * FROM message WHERE receipant = " .$_SESSION["user_id"]. " && gelezen = 0";

	$result_aantal = mysqli_query($link, $query_aantal) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_aantal\"");

	echo mysqli_num_rows($result_aantal);


	mysqli_close($link);
}
else
{
	header("Location: index.php");
}

?>