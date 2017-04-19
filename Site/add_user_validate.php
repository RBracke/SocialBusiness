<?php

session_start();

include("functions.php");

$link = connecteren();
if(isset($_SESSION['logged_in']) && isset($_SESSION["admin"]) && ($_SESSION["admin"] == 1) && isset($_POST["name"]) && isset($_POST["function"]) && isset($_POST["admin_radio"]))
{
	$name = strip($_POST["name"]);
	$function = strip($_POST["function"]);
	$admin = strip($_POST["admin_radio"]);

	if (isset($_POST["rights_checkbox_info"])){
		$rights_info = 4;
	}else{$rights_info = 0;}
	if (isset($_POST["rights_checkbox_time"])){
		$rights_time = 2;
	}else{$rights_time = 0;}
	if (isset($_POST["rights_checkbox_message"])){
		$rights_message = 1;
	}else{$rights_message = 0;}

	$rights_id = $rights_info + $rights_time + $rights_message + 1;

	if (isset($_POST["nin"]))
	{
		$nin = strip($_POST["nin"]);
	} else{$nin = NULL;}

	if (isset($_POST["dob"]))
	{
		$dob = strip($_POST["dob"]);
	} else{$dob = NULL;}

	if (isset($_POST["gender"]))
	{
		$gender = strip($_POST["gender"]);
	} else{$gender = NULL;}

	if (isset($_POST["home_address"]))
	{
		$home_address = strip($_POST["home_address"]);
	} else{$home_address = NULL;}

	if (isset($_POST["martial_status"]))
	{
		$martial_status = strip($_POST["martial_status"]);
	} else{$martial_status = NULL;}

	if (isset($_POST["email"]))
	{
		$email = strip($_POST["email"]);
	} else{$email = NULL;}

	if (isset($_POST["phone_number"]))
	{
		$phone = strip($_POST["phone_number"]);
	} else{$phone = NULL;}

	if (isset($_POST["password"]) && isset($_POST["repassword"]) && ($_POST["password"] == $_POST["repassword"]))
	{
		$password = strip($_POST["password"]);
		$password_md5 = md5(htmlspecialchars($_POST["password"]));

	} else{$password_md5 = "21232f297a57a5a743894a0e4a801fc3";}

	$date = date("Y-m-d");

	$query = "SET foreign_key_checks = 0";
	mysqli_query($link, $query);
	$goto_url = "settings_page.php?";
	$query = "INSERT INTO `user` (`name`, `nin`, `address`, `gender`, `email`, `date_of_birth`, `martial_status`, `password`, `phone_number`, `function`, `rights_id`, `admin`, `start_date`) VALUES ('" .$name. "', '" .$nin. "', '" .$home_address. "', '" .$gender. "', '" .$email. "', '" .$dob. "', '" .$martial_status. "', '" .$password_md5. "', '" .$phone. "', '" .$function. "', '" .$rights_id. "', '" .$admin. "', '" .$date. "')";

	if ($link->query($query) === TRUE) {
    echo "New record created successfully";
	} else {
    echo "Error: " . $query. "<br>" . $link->error;
	}
	$query="SET foreign_key_checks = 1";
	mysqli_query($link, $query);
}

mysqli_close($link);

//header( "Location: admin_page_add.php" );

?>