<?php

	function connecteren() 
	{
		$host 		= "localhost";
		$user		= "sobu";
		$password	= "r0628842!1S";
		$database	= "sobu";

		$link = mysqli_connect($host, $user, $password) or die("Er kan geen connectie gelegd worden met $host");
		mysqli_select_db($link, $database) or die("databank $database niet beschikbaar");

		return $link;
	}

	function strip($string)
	{
		$link = connecteren();
		$result = mysqli_real_escape_string($link,htmlspecialchars($string));
		mysqli_close($link);
		return $result;
	}

	function check_email_exists($email)
	{
		$link = connecteren();


		$email_login = strip($email);

		$query_email = "SELECT user.email AS email FROM user WHERE email='" . $email . "'";

		$result_email = mysqli_query($link, $query_email) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_email\"");

		if (mysqli_num_rows($result_email) == 1) 
		{
		    $result = "email_ok";
		} 
		elseif (mysqli_num_rows($result_email) > 1) 
		{
		    $result = "error";
		}
		else
		{
			$result = "no_match";
		}

		mysqli_close($link);

		return $result;

	}

	function user_login($email, $password)
	{
		$link = connecteren();


  		$email_login = strip($email);
  		$password_login = md5(strip($password));

		$query_login = "SELECT user.email AS email FROM user WHERE email='" . $email_login . "' && password='" . $password_login . "'";

		$result_login = mysqli_query($link, $query_login) or die("FOUT: er is een fout opgetreden bij het uitvoeren van de query \"$query_login\"");

		if (mysqli_num_rows($result_login) == 1) 
		{
		    $result = "email_ok";
		} 
		elseif (mysqli_num_rows($result_login) > 1) 
		{
		    $result = "error";
		}
		else
		{
			$result = "no_match";
		}

		mysqli_close($link);

		return $result;
	}


	
?>