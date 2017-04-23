<?php

session_start();

include("functions.php");

if(isset($_SESSION['logged_in']) && isset($_POST["nin"]) && isset($_POST["dob"]) && isset($_POST["gender"]) && isset($_POST["address"]) && isset($_POST["martial"]) && isset($_POST["email"]) && isset($_POST["phone_number"]))
{
	$link = connecteren();

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

					mysqli_query($link, $query_password) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_password\"");
					$goto_url = $goto_url . "&new_password=ok";
				}
				else
				{
					$goto_url = $goto_url . "&new_password=error";
				}
			}

			if (isset($_FILES["picture"]["name"]) && $_FILES["picture"]["name"] != NULL && false != getimagesize($_FILES["picture"]["tmp_name"]))
			{
				$temp = explode(".", $_FILES["picture"]["name"]);
				$newfilename = $_SESSION["user_id"] . '.' . end($temp);
				move_uploaded_file($_FILES["picture"]["tmp_name"], "IMG/users/" . $newfilename);

				$query_picture = "UPDATE user SET profile_picture ='" .$newfilename. "' WHERE user_id = " .$id;

				mysqli_query($link, $query_picture) or die("Er is een fout opgetreden bij het uitvoeren van de query: \"$query_picture\"");
				$goto_url = $goto_url . "&picture=ok";
			}
			else
			{
				$goto_url = $goto_url . "&picture=error";
			}

			mysqli_close($link);

			header( "Location: " .$goto_url );

		}
		else
		{
			header( "Location: settings_page.php?password=error" );
		}
	}
	else
	{
		header( "Location: settings_page.php?password=error" );
	}
}
else 
{
	header( "Location: index.php" );
}




?>