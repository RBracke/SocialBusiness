<?php

session_start();

include("functions.php");

$link = connecteren();
if(isset($_SESSION['logged_in']) && isset($_SESSION["admin"]) && ($_SESSION["admin"] == 1) && isset($_POST["name"]) && isset($_POST["function"]) && isset($_POST["admin_radio"]))
{

	$id = strip($_POST["id"]);
	$name = strip($_POST["name"]);
	$function = strip($_POST["function"]);
	$nin = strip($_POST["nin"]);
	$dob = strip($_POST["dob"]);
	$gender = strip($_POST["gender"]);
	$address = strip($_POST["address"]);
	$martial = strip($_POST["martial"]);
	$email = strip(strtolower($_POST["email"]));
	$phone_number = strip($_POST["phone_number"]);
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

	$goto_url = "admin_page_edit_user.php?id=" .$id;


	if ($name != NULL && $name != '')
	{
		$query_name = "UPDATE user SET name ='" .$name. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_name) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_name\"");
		$goto_url = $goto_url . "&name=ok";
	}
	else
	{
		$goto_url = $goto_url . "&name=error";
	}

	if ($function != NULL && $function != '')
	{
		$query_function = "UPDATE user SET function ='" .$function. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_function) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_function\"");
		$goto_url = $goto_url . "&function=ok";
	}
	else
	{
		$goto_url = $goto_url . "&function=error";
	}


	$query_admin = "UPDATE user SET admin ='" .$admin. "' WHERE user_id = " .$id;

	mysqli_query($link, $query_admin) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_admin\"");
	$goto_url = $goto_url . "&admin=ok";


	$query_rights_id = "UPDATE user SET rights_id ='" .$rights_id. "' WHERE user_id = " .$id;

	mysqli_query($link, $query_rights_id) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_rights_id\"");
	$goto_url = $goto_url . "&rights=ok";


	if ($nin != NULL && $nin != "" && strlen($nin)>5)
	{
		$query_nin = "UPDATE user SET nin ='" .$nin. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_nin) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_nin\"");
		$goto_url = $goto_url . "&nin=ok";
	}
	else
	{
		$goto_url = $goto_url . "&nin=error";
	}

	if (valideerDatum($dob))
	{
		$query_dob = "UPDATE user SET date_of_birth ='" .$dob. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_dob) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_dob\"");
		$goto_url = $goto_url . "&dob=ok";
	}
	else
	{
		$goto_url = $goto_url . "&dob=error";
	}

	if ($gender == 'm' || $gender == 'f')
	{
		if ($gender == 'm')
		{
			$query_gender = "UPDATE user SET gender = 1 WHERE user_id = " .$id;

			mysqli_query($link, $query_gender) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_gender\"");
		}
		else
		{
			$query_gender = "UPDATE user SET gender = 0 WHERE user_id = " .$id;

			mysqli_query($link, $query_gender) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_gender\"");
		}
		$goto_url = $goto_url . "&gender=ok";
	}
	else
	{
		$goto_url = $goto_url . "&gender=error";
	}

	if ($address != NULL && $address != '')
	{
		$query_address = "UPDATE user SET address ='" .$address. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_address) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_address\"");
		$goto_url = $goto_url . "&address=ok";
	}
	else
	{
		$goto_url = $goto_url . "&address=error";
	}

	if ($martial != NULL && $martial != '')
	{
		$query_martial = "UPDATE user SET martial_status ='" .$martial. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_martial) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_martial\"");
		$goto_url = $goto_url . "&martial=ok";
	}
	else
	{
		$goto_url = $goto_url . "&martial=error";
	}

	if ($email != NULL && $email != '')
	{
		$query_email = "UPDATE user SET email ='" .$email. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_email) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_email\"");
		$goto_url = $goto_url . "&email=ok";
	}
	else
	{
		$goto_url = $goto_url . "&email=error";
	}

	if ($phone_number != NULL && $phone_number != '')
	{
		$query_phone_number = "UPDATE user SET phone_number ='" .$phone_number. "' WHERE user_id = " .$id;

		mysqli_query($link, $query_phone_number) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_phone_number\"");
		$goto_url = $goto_url . "&phone_number=ok";
	}
	else
	{
		$goto_url = $goto_url . "&phone_number=error";
	}

	if (isset($_POST["newpassword"]) && isset($_POST["repassword"]) && $_POST["newpassword"] != NULL && $_POST["newpassword"] != '')
	{
		$newpassword = htmlspecialchars($_POST["newpassword"]);
		$repassword = htmlspecialchars($_POST["repassword"]);
		$newpassword_md5 = md5($repassword);

		if ($newpassword != NULL && $newpassword != '' && $newpassword == $repassword)
		{
			$query_password = "UPDATE user SET password ='" .$newpassword_md5. "' WHERE user_id = " .$id;

			mysqli_query($link, $query_password) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_password\"");
			$goto_url = $goto_url . "&new_password=ok";
		}
		else
		{
			$goto_url = $goto_url . "&new_password=error";
		}
	}

	mysqli_close($link);

	header( "Location: " .$goto_url );

}
else
{
	header( "Location: index.php" );
}


?>