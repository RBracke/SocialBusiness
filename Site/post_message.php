<?php
session_start();
include("functions.php");
$link = connecteren();
if (isset($_SESSION["logged_in"]))
{

	$id = $_SESSION['user_id'];
	$message = strip($_POST["message"]);
	$topic = strip($_POST["topic"]);
	$receipant = strip($_POST["receipant"]);
	$date = date("Y-m-d H:i:s");

	$query = "SET foreign_key_checks = 0";
	mysqli_query($link, $query);
	$query = "INSERT INTO `message` (`topic`, `content`, `date_time`, `receipant`, `sender`) VALUES ('" .$topic. "', '" .$message. "', '" .$date. "', '" .$receipant. "', '" .$id. "')";

	if ($link->query($query) === TRUE) {
    echo "Message sended";
	} else {
    echo "Error: " . $query. "<br>" . $link->error;
	}

	$query = "SET foreign_key_checks = 1";
	mysqli_query($link, $query);
}
mysqli_close($link);

?>