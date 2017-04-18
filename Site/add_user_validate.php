<?php

session_start();

include("functions.php");

if(isset($_SESSION['logged_in']) && isset($_SESSION["admin"]) && ($_SESSION["admin"] == 1) && isset($_POST["name"]) && isset($_POST["function"]) && isset($_POST["admin"]) && isset($_POST["rights"]))
{
	echo "here";
	$link = connecteren();

	$name = strip($_POST["name"]);
	$function = strip($_POST["function"]);
	$admin = strip($_POST["admin"]);
	$rights = strip($_POST["rights"]);

	if (isset($_POST["nin"]))
	{
		$nin = strip($_POST["nin"]);
	}

	if (isset($_POST["dob"]))
	{
		$dob = strip($_POST["dob"]);
	}

	if (isset($_POST["gender"]))
	{
		$gender = strip($_POST["gender"]);
	}

	if (isset($_POST["home_address"]))
	{
		$home_address = strip($_POST["home_address"]);
	}

	if (isset($_POST["martial_status"]))
	{
		$martial_status = strip($_POST["martial_status"]);
	}

	if (isset($_POST["email"]))
	{
		$email = strip($_POST["email"]);
	}

	if (isset($_POST["phone_number"]))
	{
		$phone = strip($_POST["phone_number"]);
	}

	if (isset($_POST["password"])&&isset($_POST["repassword"]))
	{
		$password = strip($_POST["password"]);
		$repassword = strip($_POST["repassword"]);
	}

	if (isset($_POST["password"]))
	{
		$id = $_SESSION['user_id'];
		$nin = strip($_POST["nin"]);
		$dob = strip($_POST["dob"]);
		$gender = strip($_POST["gender"]);
		$address = strip($_POST["address"]);
		$martial = strip($_POST["martial"]);
		$email = strip(strtolower($_POST["email"]));
		$phone_number = strip($_POST["phone_number"]);
		$password = htmlspecialchars($_POST["password"]);
		$password_md5 = md5(htmlspecialchars($_POST["password"]));

		$goto_url = "settings_page.php?";
		

		$query = "SELECT password FROM user WHERE user_id = " .$id;

		$result = mysqli_query($link, $query) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query\"");

		$result = mysqli_fetch_array($result);

		if ($result["password"] == $password_md5)
		{
			if ($nin != NULL && $nin != "" && strlen($nin)>5)
			{
				$query_nin = "UPDATE user SET nin ='" .$nin. "' WHERE user_id = " .$id;

				mysqli_query($link, $query_nin) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_nin\"");
				$goto_url = $goto_url . "nin=ok";
			}
			else
			{
				$goto_url = $goto_url . "nin=error";
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

					mysqli_query($link, $query_password) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_phone_number\"");
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
			header( "Location: settings_page.php?error=password" );
		}
	}
	else
	{
		header( "Location: settings_page.php?error=password" );
	}
}
else 
{
	header( "Location: index.php" );
}




?>