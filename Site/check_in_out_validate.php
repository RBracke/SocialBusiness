<?php
session_start();
include("functions.php");

if (isset($_SESSION["logged_in"]))
{
	fill_session($_SESSION["user_id"]);

	if ($_SESSION["in_building"] == 1)
	{
		user_out_building();
		echo "out";
	}
	else
	{
		user_in_building();
		echo "in";
	}

}
else
{
	header("Location: index.php");
}

?>