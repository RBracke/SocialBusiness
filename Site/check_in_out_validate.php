<?php
session_start();
include("functions.php");

if (isset($_SESSION["logged_in"]))
{
	fill_session($_SESSION["user_id"]);
	$link = connecteren();
	$query = "SELECT in_building_now FROM in_building WHERE user_id = '" .$_SESSION["user_id"]. "' ORDER BY time_check DESC";
  	$result= mysqli_query($link, $query) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query\"");
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if($row["in_building_now"] == 1)
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
  mysqli_close($link);

?>