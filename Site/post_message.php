<?php
session_start();
include("functions.php");
$link = connecteren();
if (isset($_SESSION["logged_in"]) && isset($_POST["message"]))
{

	$id = $_SESSION['user_id'];
	$message = strip($_POST["message"]);
	$topic = strip($_POST["topic"]);
	$receipant = strip($_POST["receipant"]);
	$date = date("Y-m-d H:i:s");

	if ($topic != NULL && $topic != "" && $topic != " ")
	{
		$query = "SET foreign_key_checks = 0";
		mysqli_query($link, $query);

		$query = "INSERT INTO `message` (`topic`, `content`, `date_time`, `receipant`, `sender`) VALUES ('" .$topic. "', '" .$message. "', '" .$date. "', '" .$receipant. "', '" .$id. "')";

		if ($link->query($query) === TRUE) {
			header("Location: colleague_page.php?id=".$receipant."&msended='1'");
		} else {
			echo "Error: " . $query. "<br>" . $link->error;
		}


		if (isset($_FILES["file_message"]["name"]) && $_FILES["file_message"]["name"] != NULL)
		{
			$message_id = mysqli_insert_id($link);
			$temp = explode(".", $_FILES["file_message"]["name"]);
			$newfilename = $message_id . '.' . end($temp);
			move_uploaded_file($_FILES["file_message"]["tmp_name"], "Files/" . $newfilename);

			$query_file = "UPDATE message SET file ='" .$newfilename. "' WHERE message_id = " .$message_id;

			mysqli_query($link, $query_file) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_file\"");
		}



		$query = "SET foreign_key_checks = 1";
		mysqli_query($link, $query);
	}
	else
	{
		header("Location: colleague_page.php?id=" .$receipant. "&topic_error=error");
	}

	
}
mysqli_close($link);

?>